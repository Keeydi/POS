<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Products
            'manage_products',
            'view_products',
            
            // Staff
            'manage_staff',
            'view_staff',
            
            // Orders
            'create_orders',
            'edit_orders_before_send',
            'edit_orders_after_send',
            'send_to_departments',
            'view_orders',
            
            // Payments
            'accept_payments',
            'view_payments',
            
            // Receipts
            'print_receipts',
            
            // Voids
            'request_voids',
            'approve_voids',
            'view_voids',
            
            // Discounts
            'request_discounts',
            'approve_discounts',
            'view_discounts',
            
            // Commission
            'manage_commission_rules',
            'view_commission_rules',
            'assign_ld_sales_to_staff',
            'view_own_sales',
            
            // Payroll
            'manage_payroll',
            'view_payroll',
            'compute_daily_payouts',
            'adjust_payouts',
            
            // Reports
            'view_reports',
            'export_reports',
            
            // Department queues
            'view_bar_queue',
            'view_kitchen_queue',
            'mark_bar_items_done',
            'mark_kitchen_items_done',
            'reprint_bar_ticket',
            'reprint_kitchen_ticket',
            
            // LD Management
            'manage_ld_staff',
            'view_ld_sales',
            'adjust_ld_credit_with_audit',
            
            // End of day
            'finalize_end_of_day',
            
            // Audit
            'view_audit_logs',
            
            // Settings
            'manage_settings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions
        $superAdmin = Role::create(['name' => 'SuperAdmin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        $manager = Role::create(['name' => 'Manager', 'guard_name' => 'web']);
        $manager->givePermissionTo([
            'manage_products',
            'manage_staff',
            'manage_commission_rules',
            'view_reports',
            'approve_voids',
            'approve_discounts',
            'view_payroll',
            'finalize_end_of_day',
            'edit_orders_after_send',
            'manage_payroll',
            'adjust_payouts',
            'view_audit_logs',
            'manage_settings',
        ]);

        $cashier = Role::create(['name' => 'Cashier', 'guard_name' => 'web']);
        $cashier->givePermissionTo([
            'create_orders',
            'edit_orders_before_send',
            'send_to_departments',
            'accept_payments',
            'print_receipts',
            'request_voids',
            'request_discounts',
            'view_orders',
            'view_payments',
        ]);

        $waitress = Role::create(['name' => 'Waitress', 'guard_name' => 'web']);
        $waitress->givePermissionTo([
            'create_orders',
            'assign_ld_sales_to_staff',
            'view_own_sales',
        ]);

        $bartender = Role::create(['name' => 'Bartender', 'guard_name' => 'web']);
        $bartender->givePermissionTo([
            'view_bar_queue',
            'mark_bar_items_done',
            'reprint_bar_ticket',
        ]);

        $kitchen = Role::create(['name' => 'Kitchen', 'guard_name' => 'web']);
        $kitchen->givePermissionTo([
            'view_kitchen_queue',
            'mark_kitchen_items_done',
            'reprint_kitchen_ticket',
        ]);

        $ldManager = Role::create(['name' => 'LD_Manager', 'guard_name' => 'web']);
        $ldManager->givePermissionTo([
            'manage_ld_staff',
            'view_ld_sales',
            'adjust_ld_credit_with_audit',
            'compute_daily_payouts',
            'view_payroll',
        ]);

        $auditor = Role::create(['name' => 'Auditor', 'guard_name' => 'web']);
        $auditor->givePermissionTo([
            'view_audit_logs',
            'view_reports',
            'export_reports',
        ]);
    }
}
