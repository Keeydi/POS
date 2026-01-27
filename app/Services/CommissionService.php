<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\CommissionRule;
use App\Models\Staff;
use Illuminate\Support\Collection;

class CommissionService
{
    public function calculateCommission(OrderItem $orderItem): float
    {
        if (!$orderItem->product->is_commissionable || !$orderItem->staff_id) {
            return 0;
        }

        $staff = Staff::find($orderItem->staff_id);
        $rules = $this->getApplicableRules($orderItem, $staff);

        if ($rules->isEmpty()) {
            return 0;
        }

        $commission = 0;
        foreach ($rules as $rule) {
            $commission += $this->applyRule($rule, $orderItem);
        }

        return round($commission, 2);
    }

    protected function getApplicableRules(OrderItem $orderItem, Staff $staff): Collection
    {
        return CommissionRule::where('active', true)
            ->where('valid_from', '<=', now())
            ->where(function ($query) {
                $query->whereNull('valid_to')
                    ->orWhere('valid_to', '>=', now());
            })
            ->where(function ($query) use ($orderItem, $staff) {
                $query->where(function ($q) use ($orderItem) {
                    $q->where('product_id', $orderItem->product_id)
                        ->orWhere('category_id', $orderItem->product->category_id);
                })
                ->where(function ($q) use ($staff) {
                    $q->whereJsonContains('staff_type_applicability', $staff->staff_type)
                        ->orWhereNull('staff_type_applicability');
                });
            })
            ->get();
    }

    protected function applyRule(CommissionRule $rule, OrderItem $orderItem): float
    {
        $netAmount = $orderItem->subtotal - $orderItem->discount_amount;

        return match ($rule->commission_model) {
            'per_item_fixed' => $rule->value * $orderItem->quantity,
            'percentage_of_sales' => $netAmount * ($rule->value / 100),
            'tiered_by_quantity' => $this->calculateTieredCommission($rule, $orderItem->quantity),
            default => 0,
        };
    }

    protected function calculateTieredCommission(CommissionRule $rule, int $quantity): float
    {
        if (empty($rule->tiers)) {
            return 0;
        }

        $commission = 0;
        $remaining = $quantity;

        foreach ($rule->tiers as $tier) {
            $min = $tier['min'] ?? 0;
            $max = $tier['max'] ?? PHP_INT_MAX;
            $value = $tier['value'] ?? 0;

            if ($remaining <= 0) {
                break;
            }

            $tierQuantity = min($remaining, $max - $min + 1);
            $commission += $tierQuantity * $value;
            $remaining -= $tierQuantity;
        }

        return $commission;
    }

    public function computeDailyPayout(int $staffId, string $date): array
    {
        $staff = Staff::findOrFail($staffId);
        $shift = $staff->shifts()->where('shift_date', $date)->first();

        $orderItems = OrderItem::whereHas('order', function ($query) use ($date) {
            $query->whereDate('created_at', $date)
                ->whereIn('status', ['paid', 'closed']);
        })
        ->where('staff_id', $staffId)
        ->where('is_voided', false)
        ->get();

        $commission = 0;
        foreach ($orderItems as $item) {
            $commission += $this->calculateCommission($item);
        }

        $allowance = $shift && $shift->attendance_met ? $staff->default_allowance : 0;

        return [
            'staff_id' => $staffId,
            'payout_date' => $date,
            'shift_id' => $shift?->id,
            'allowance' => $allowance,
            'commission' => round($commission, 2),
            'adjustments' => 0,
            'deductions' => 0,
            'net_payout' => round($allowance + $commission, 2),
        ];
    }
}
