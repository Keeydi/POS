<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Services\AuditService;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = BusinessSetting::getSettings();
        return view('settings.index', compact('settings'));
    }

    public function updateBusiness(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string',
            'address' => 'nullable|string',
            'contact' => 'nullable|string',
            'receipt_footer_note' => 'nullable|string',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'service_charge_rate' => 'required|numeric|min:0|max:100',
            'service_charge_mode' => 'required|in:percent,fixed',
            'service_charge_fixed' => 'required|numeric|min:0',
        ]);

        $settings = BusinessSetting::getSettings();
        $oldValues = $settings->toArray();
        $settings->update($validated);

        AuditService::log('edit_order', 'BusinessSetting', $settings->id, 'Business settings updated', $oldValues, $settings->toArray());

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
    }
}
