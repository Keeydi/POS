<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Services\AuditService;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::where('active', true)->paginate(20);
        return view('staff.index', compact('staff'));
    }

    public function show(Staff $staff)
    {
        return response()->json($staff);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_code' => 'required|string|unique:staff,staff_code',
            'full_name' => 'required|string',
            'nickname' => 'nullable|string',
            'staff_type' => 'required|in:Model,Host,Waitress,Bartender,Kitchen',
            'default_allowance' => 'required|numeric|min:0',
            'active' => 'boolean',
        ]);

        $staff = Staff::create($validated);

        AuditService::log('create_order', 'Staff', $staff->id, "Staff {$staff->full_name} created");

        return redirect()->route('staff.index')->with('success', 'Staff created successfully');
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'staff_code' => 'required|string|unique:staff,staff_code,' . $staff->id,
            'full_name' => 'required|string',
            'nickname' => 'nullable|string',
            'staff_type' => 'required|in:Model,Host,Waitress,Bartender,Kitchen',
            'default_allowance' => 'required|numeric|min:0',
            'active' => 'boolean',
        ]);

        $oldValues = $staff->toArray();
        $staff->update($validated);

        AuditService::log('edit_order', 'Staff', $staff->id, "Staff {$staff->full_name} updated", $oldValues, $staff->toArray());

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully');
    }
}
