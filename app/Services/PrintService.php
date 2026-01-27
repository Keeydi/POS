<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Printer;
use App\Models\Department;

class PrintService
{
    public function printOrderToDepartment(Order $order, string $departmentCode): void
    {
        $department = Department::where('code', $departmentCode)->first();
        if (!$department) {
            return;
        }

        $printer = Printer::where('department_id', $department->id)
            ->where('active', true)
            ->first();

        if (!$printer) {
            return;
        }

        $items = $order->items()
            ->whereHas('product.department', function ($query) use ($department) {
                $query->where('id', $department->id);
            })
            ->get();

        if ($items->isEmpty()) {
            return;
        }

        $this->sendToPrinter($printer, $order, $items);
    }

    protected function sendToPrinter(Printer $printer, Order $order, $items): void
    {
        // This would integrate with actual printer drivers
        // For now, we'll create a print job record
        // In production, this would use ESC/POS libraries or network printing
        
        $template = $this->buildTemplate($printer, $order, $items);
        
        // Log print attempt
        AuditService::log('send_to_printer', 'Order', $order->id, 
            "Order {$order->order_no} sent to {$printer->name}");
    }

    protected function buildTemplate(Printer $printer, Order $order, $items): string
    {
        $config = $printer->template_config ?? [];
        $title = $config['title'] ?? strtoupper($printer->department->name) . ' ORDER';
        
        $template = "{$title}\n";
        $template .= "Order: {$order->order_no}\n";
        $template .= "Date: {$order->created_at->format('Y-m-d H:i:s')}\n";
        $template .= "Area: {$order->area->name} | Table: {$order->table->name}\n";
        $template .= str_repeat('-', 40) . "\n";

        foreach ($items as $item) {
            $template .= "{$item->quantity}x {$item->product->name}\n";
            if ($item->modifiers) {
                $template .= "  Modifiers: {$item->modifiers}\n";
            }
            if ($item->special_instructions) {
                $template .= "  Note: {$item->special_instructions}\n";
            }
            if ($printer->department->code === 'LD' && $item->staff) {
                $template .= "  Staff: {$item->staff->full_name}\n";
            }
            $template .= "\n";
        }

        $template .= "Encoder: {$order->user->name}\n";
        $template .= str_repeat('=', 40) . "\n";

        return $template;
    }
}
