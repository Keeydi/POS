# Rabbit Alley POS - System Roles Analysis & Consolidation Plan

## Executive Summary

This document analyzes the current 8-role system and proposes consolidation into 4 comprehensive roles that maintain all functionality while simplifying user management.

---

## Current System Analysis (8 Roles)

### 1. SuperAdmin
**Purpose:** Full system access and administration

**Functions & Permissions:**
- ✅ All permissions (full access)
- ✅ System configuration
- ✅ User management
- ✅ Database administration
- ✅ All operational functions

**Primary Jobs:**
- System setup and configuration
- User account management
- Emergency access and troubleshooting
- System maintenance

---

### 2. Manager
**Purpose:** Day-to-day operations management and approvals

**Functions & Permissions:**
- ✅ Manage products (add/edit/delete products)
- ✅ Manage staff (add/edit staff records)
- ✅ Manage commission rules
- ✅ View reports (sales, payroll, analytics)
- ✅ Approve voids (two-person approval system)
- ✅ Approve discounts (two-person approval system)
- ✅ View payroll (access to payroll reports)
- ✅ Finalize end of day (close daily operations)
- ✅ Edit orders after send (modify orders sent to departments)
- ✅ Manage payroll (adjust payouts, compute daily payouts)
- ✅ Adjust payouts (make adjustments to staff payouts)
- ✅ View audit logs (monitor system activity)
- ✅ Manage settings (business settings, configuration)

**Primary Jobs:**
- Approve void requests from cashiers
- Approve discount requests
- Manage product catalog
- Manage staff records and commission rules
- Review and finalize daily operations
- Adjust staff payouts when needed
- Monitor system through audit logs
- Configure business settings

---

### 3. Cashier
**Purpose:** Front-end order processing and payment handling

**Functions & Permissions:**
- ✅ Create orders (new table orders)
- ✅ Edit orders before send (modify draft orders)
- ✅ Send to departments (submit orders to kitchen/bar)
- ✅ Accept payments (process customer payments)
- ✅ Print receipts (generate customer receipts)
- ✅ Request voids (initiate void requests - requires approval)
- ✅ Request discounts (initiate discount requests - requires approval)
- ✅ View orders (access order history)
- ✅ View payments (access payment records)

**Primary Jobs:**
- Take customer orders at tables
- Add/remove items from orders
- Send orders to kitchen/bar departments
- Process payments (cash, card, etc.)
- Print receipts for customers
- Request voids for incorrect items (requires manager approval)
- Request discounts for customers (requires manager approval)
- View order and payment history

---

### 4. Waitress
**Purpose:** Order taking and LD sales assignment

**Functions & Permissions:**
- ✅ Create orders (new table orders)
- ✅ Assign LD sales to staff (assign commissionable LD items to staff)
- ✅ View own sales (view personal sales records)

**Primary Jobs:**
- Take orders from customers
- Assign LD (Ladies Drink) sales to specific staff members for commission tracking
- View personal sales performance

**Note:** Limited role - primarily for order entry and commission assignment

---

### 5. Bartender
**Purpose:** Bar department operations

**Functions & Permissions:**
- ✅ View bar queue (see pending bar orders)
- ✅ Mark bar items done (complete bar items)
- ✅ Reprint bar ticket (reprint bar order tickets)

**Primary Jobs:**
- View pending bar orders
- Prepare and complete bar drinks
- Mark items as ready/served
- Reprint order tickets if needed

**Note:** Department-specific role for bar operations only

---

### 6. Kitchen Staff
**Purpose:** Kitchen department operations

**Functions & Permissions:**
- ✅ View kitchen queue (see pending kitchen orders)
- ✅ Mark kitchen items done (complete kitchen items)
- ✅ Reprint kitchen ticket (reprint kitchen order tickets)

**Primary Jobs:**
- View pending kitchen orders
- Prepare and complete food items
- Mark items as ready/served
- Reprint order tickets if needed

**Note:** Department-specific role for kitchen operations only

---

### 7. LD Manager
**Purpose:** Ladies Drink management and payroll computation

**Functions & Permissions:**
- ✅ Manage LD staff (manage ladies drink staff)
- ✅ View LD sales (view ladies drink sales)
- ✅ Adjust LD credit with audit (adjust LD credits with audit trail)
- ✅ Compute daily payouts (calculate daily staff payouts)
- ✅ View payroll (access payroll reports)

**Primary Jobs:**
- Manage LD (Ladies Drink) staff records
- Monitor LD sales performance
- Adjust LD credits when needed (with audit trail)
- Compute daily payouts for staff
- View payroll reports

**Note:** Specialized role for LD operations and payroll computation

---

### 8. Auditor
**Purpose:** System auditing and reporting

**Functions & Permissions:**
- ✅ View audit logs (access system audit trail)
- ✅ View reports (access all reports)
- ✅ Export reports (export reports to PDF/CSV)

**Primary Jobs:**
- Review system audit logs
- Generate and view reports
- Export reports for external analysis
- Monitor system compliance

**Note:** Read-only role for compliance and reporting

---

## Proposed 4-Role Consolidation

### Rationale
The current 8 roles can be logically consolidated into 4 comprehensive roles that:
1. Maintain all functionality
2. Reduce complexity
3. Improve operational efficiency
4. Simplify user management

---

## NEW ROLE 1: Administrator
**Consolidates:** SuperAdmin + Manager

**Employee ID:** EMP001

**Purpose:** Complete system administration and operations management

**All Functions & Permissions:**
- ✅ **System Management:**
  - Full system access
  - User account management
  - System configuration
  - Database administration

- ✅ **Operations Management:**
  - Manage products (add/edit/delete products)
  - Manage staff (add/edit staff records)
  - Manage commission rules
  - View all reports (sales, payroll, analytics)
  - Export reports (PDF/CSV export)

- ✅ **Approvals:**
  - Approve voids (two-person approval system)
  - Approve discounts (two-person approval system)
  - Approve payout adjustments

- ✅ **Order Management:**
  - Create orders
  - Edit orders before send
  - Edit orders after send (override capability)
  - Send to departments
  - View all orders

- ✅ **Payment & Receipts:**
  - Accept payments
  - Print receipts
  - View all payments

- ✅ **Payroll Management:**
  - Manage payroll
  - Compute daily payouts
  - Adjust payouts
  - View payroll reports
  - Finalize end of day

- ✅ **LD Management:**
  - Manage LD staff
  - View LD sales
  - Adjust LD credit with audit

- ✅ **Department Operations:**
  - View bar queue
  - View kitchen queue
  - Mark bar items done
  - Mark kitchen items done
  - Reprint tickets

- ✅ **Audit & Compliance:**
  - View audit logs
  - View all reports
  - Export reports

- ✅ **Settings:**
  - Manage all business settings
  - Configure system parameters

**Primary Jobs:**
1. **System Administration:**
   - Set up and configure the POS system
   - Manage user accounts and roles
   - System maintenance and troubleshooting

2. **Operations Oversight:**
   - Approve void and discount requests
   - Monitor daily operations
   - Finalize end of day procedures

3. **Product & Staff Management:**
   - Manage product catalog (add/edit/delete)
   - Manage staff records
   - Configure commission rules

4. **Payroll Management:**
   - Compute daily payouts
   - Adjust payouts when needed
   - Review payroll reports

5. **LD Operations:**
   - Manage LD staff
   - Monitor LD sales
   - Adjust LD credits

6. **Reporting & Compliance:**
   - Generate and export reports
   - Review audit logs
   - Ensure system compliance

**Use Cases:**
- System setup and configuration
- Daily operations management
- Approving voids/discounts
- Managing products and staff
- Computing and adjusting payroll
- Generating reports for management
- System troubleshooting

---

## NEW ROLE 2: Operations Staff
**Consolidates:** Cashier + Waitress + Bartender + Kitchen

**Employee ID:** EMP002

**Purpose:** All front-end and department operations

**All Functions & Permissions:**
- ✅ **Order Processing:**
  - Create orders (new table orders)
  - Edit orders before send (modify draft orders)
  - Send to departments (submit orders to kitchen/bar)
  - View orders (access order history)

- ✅ **Payment Processing:**
  - Accept payments (process customer payments)
  - Print receipts (generate customer receipts)
  - View payments (access payment records)

- ✅ **Void & Discount Requests:**
  - Request voids (initiate void requests - requires approval)
  - Request discounts (initiate discount requests - requires approval)
  - View voids and discounts

- ✅ **LD Sales Assignment:**
  - Assign LD sales to staff (assign commissionable LD items to staff)
  - View own sales (view personal sales records)

- ✅ **Department Operations:**
  - View bar queue (see pending bar orders)
  - View kitchen queue (see pending kitchen orders)
  - Mark bar items done (complete bar items)
  - Mark kitchen items done (complete kitchen items)
  - Reprint bar ticket (reprint bar order tickets)
  - Reprint kitchen ticket (reprint kitchen order tickets)

**Primary Jobs:**
1. **Order Taking:**
   - Take customer orders at tables
   - Add/remove items from orders
   - Send orders to appropriate departments

2. **Payment Processing:**
   - Process customer payments (cash, card, etc.)
   - Print receipts for customers
   - Handle payment transactions

3. **Department Operations:**
   - **If assigned to Bar:** View bar queue, prepare drinks, mark items done
   - **If assigned to Kitchen:** View kitchen queue, prepare food, mark items done
   - Reprint tickets when needed

4. **LD Sales Management:**
   - Assign LD (Ladies Drink) sales to staff for commission tracking
   - View personal sales performance

5. **Request Approvals:**
   - Request voids for incorrect items (requires Administrator approval)
   - Request discounts for customers (requires Administrator approval)

**Use Cases:**
- Taking orders from customers
- Processing payments
- Preparing drinks (if bartender)
- Preparing food (if kitchen staff)
- Assigning LD sales to staff
- Requesting voids/discounts
- Viewing personal sales

**Note:** This role can perform all operational tasks. Staff members can be assigned to specific departments (Bar/Kitchen) based on their physical location, but they have access to all operational functions.

---

## NEW ROLE 3: Finance Manager
**Consolidates:** LD_Manager + Auditor

**Employee ID:** EMP003

**Purpose:** Financial operations, payroll, and compliance

**All Functions & Permissions:**
- ✅ **Payroll Management:**
  - Compute daily payouts (calculate daily staff payouts)
  - View payroll (access payroll reports)
  - Export payroll reports

- ✅ **LD Management:**
  - Manage LD staff (manage ladies drink staff)
  - View LD sales (view ladies drink sales)
  - Adjust LD credit with audit (adjust LD credits with audit trail)

- ✅ **Reporting:**
  - View reports (access all reports - sales, payroll, etc.)
  - Export reports (export reports to PDF/CSV)

- ✅ **Audit & Compliance:**
  - View audit logs (access system audit trail)
  - Monitor system compliance
  - Review financial transactions

**Primary Jobs:**
1. **Payroll Operations:**
   - Compute daily payouts for all staff
   - Review payroll reports
   - Export payroll data for accounting

2. **LD Operations:**
   - Manage LD (Ladies Drink) staff records
   - Monitor LD sales performance
   - Adjust LD credits when needed (with full audit trail)

3. **Financial Reporting:**
   - Generate sales reports
   - Generate payroll reports
   - Export reports for external analysis (accounting, management)

4. **Compliance & Auditing:**
   - Review system audit logs
   - Monitor financial transactions
   - Ensure compliance with business policies
   - Prepare reports for management/accounting

**Use Cases:**
- Computing daily staff payouts
- Managing LD staff and sales
- Generating financial reports
- Exporting data for accounting
- Reviewing audit logs for compliance
- Adjusting LD credits with proper documentation

**Note:** This role focuses on financial operations and compliance. They do NOT have approval authority for voids/discounts (that's Administrator's role).

---

## NEW ROLE 4: Supervisor
**Consolidates:** Manager (partial) + Operations oversight

**Employee ID:** EMP004

**Purpose:** Day-to-day supervision, approvals, and operational support

**All Functions & Permissions:**
- ✅ **Approvals:**
  - Approve voids (two-person approval system)
  - Approve discounts (two-person approval system)

- ✅ **Operations Support:**
  - Create orders (can assist with orders)
  - Edit orders after send (modify orders sent to departments)
  - View all orders
  - Accept payments (can process payments)
  - Print receipts

- ✅ **Monitoring:**
  - View reports (access sales and operational reports)
  - View audit logs (monitor system activity)
  - View payroll (view payroll reports - read-only)

- ✅ **Department Oversight:**
  - View bar queue
  - View kitchen queue
  - Mark items done (can assist departments)

- ✅ **Settings (Limited):**
  - View settings (read-only access to settings)

**Primary Jobs:**
1. **Approval Authority:**
   - Approve void requests from Operations Staff
   - Approve discount requests from Operations Staff

2. **Operational Support:**
   - Assist with order taking when needed
   - Process payments when cashier is busy
   - Modify orders after they've been sent (emergency corrections)

3. **Department Oversight:**
   - Monitor bar and kitchen queues
   - Assist departments when needed
   - Ensure smooth operations

4. **Monitoring & Reporting:**
   - Monitor daily operations through reports
   - Review audit logs for operational issues
   - View payroll (for operational planning)

**Use Cases:**
- Approving voids/discounts during busy periods
- Assisting with orders when staff is busy
- Monitoring department queues
- Reviewing operational reports
- Handling emergency order corrections

**Note:** This role provides operational oversight and approval authority without full administrative access. Perfect for shift supervisors or floor managers.

---

## Permission Mapping: Current → New Roles

### Administrator (EMP001) Gets:
- All SuperAdmin permissions ✅
- All Manager permissions ✅
- All Cashier permissions ✅
- All Waitress permissions ✅
- All Bartender permissions ✅
- All Kitchen permissions ✅
- All LD_Manager permissions ✅
- All Auditor permissions ✅

### Operations Staff (EMP002) Gets:
- All Cashier permissions ✅
- All Waitress permissions ✅
- All Bartender permissions ✅
- All Kitchen permissions ✅

### Finance Manager (EMP003) Gets:
- All LD_Manager permissions ✅
- All Auditor permissions ✅
- View reports ✅
- Export reports ✅

### Supervisor (EMP004) Gets:
- Manager approval permissions (voids, discounts) ✅
- Manager order editing permissions ✅
- Manager viewing permissions (reports, audit logs) ✅
- Operations support permissions ✅
- Department oversight permissions ✅

---

## Role Comparison Matrix

| Function | Current Roles | New Roles |
|----------|--------------|-----------|
| **System Administration** | SuperAdmin | Administrator |
| **Product Management** | Manager | Administrator |
| **Staff Management** | Manager | Administrator |
| **Order Creation** | Cashier, Waitress | Operations Staff, Supervisor |
| **Payment Processing** | Cashier | Operations Staff, Supervisor |
| **Void/Discount Approval** | Manager | Administrator, Supervisor |
| **Department Operations** | Bartender, Kitchen | Operations Staff |
| **LD Management** | LD_Manager | Finance Manager |
| **Payroll Computation** | LD_Manager | Finance Manager |
| **Report Generation** | Manager, Auditor | Administrator, Finance Manager |
| **Audit Logs** | Manager, Auditor | Administrator, Finance Manager, Supervisor |
| **Settings Management** | Manager | Administrator |

---

## Implementation Benefits

### 1. Simplified User Management
- **Before:** 8 different roles to manage
- **After:** 4 comprehensive roles
- **Benefit:** Easier onboarding, fewer role assignments

### 2. Operational Flexibility
- **Operations Staff** can work in any department (bar/kitchen/cashier)
- No need to switch roles when staff moves between stations
- **Supervisor** can provide backup support anywhere

### 3. Clear Responsibility Lines
- **Administrator:** Full system control
- **Operations Staff:** All front-end operations
- **Finance Manager:** Financial operations only
- **Supervisor:** Operational oversight and approvals

### 4. Reduced Complexity
- Fewer role combinations to test
- Simpler permission management
- Easier to understand who can do what

### 5. Maintained Security
- All security features preserved
- Two-person approval still required
- Audit logging still active
- Role-based access control maintained

---

## Migration Plan

### Step 1: Update Roles Seeder
- Remove 8 old roles
- Create 4 new roles
- Assign all permissions to new roles

### Step 2: Update Users Seeder
- Consolidate 8 users into 4 users
- Assign new roles
- Update employee IDs

### Step 3: Update Permission Checks
- Review all `@can()` directives in views
- Ensure they work with new roles
- Test all permission gates

### Step 4: Documentation Update
- Update user manuals
- Update setup guides
- Create role assignment guide

### Step 5: Testing
- Test each role's access
- Verify all functions work
- Test approval workflows
- Verify audit logging

---

## Recommended User Accounts

| Role | Employee ID | Email | Password | Primary Use |
|------|-------------|-------|----------|-------------|
| **Administrator** | EMP001 | admin@pos.local | password | System admin, full access |
| **Operations Staff** | EMP002 | staff@pos.local | password | Front-end operations |
| **Finance Manager** | EMP003 | finance@pos.local | password | Payroll, reports |
| **Supervisor** | EMP004 | supervisor@pos.local | password | Approvals, oversight |

---

## Notes & Considerations

1. **Operations Staff Flexibility:** This role can perform all operational tasks. In practice, staff members will be assigned to specific stations (bar, kitchen, cashier) but have access to all functions for flexibility.

2. **Supervisor Role:** This role provides operational oversight without full administrative access. Perfect for shift supervisors who need approval authority but not system administration.

3. **Finance Manager:** Focused on financial operations. They do NOT have approval authority for voids/discounts - that remains with Administrator and Supervisor.

4. **Backward Compatibility:** All existing functionality is preserved. No features are lost in the consolidation.

5. **Future Expansion:** If needed, additional roles can be added later. The 4-role structure provides a solid foundation.

---

## Conclusion

The consolidation from 8 roles to 4 roles:
- ✅ Maintains all functionality
- ✅ Simplifies user management
- ✅ Improves operational flexibility
- ✅ Preserves security features
- ✅ Reduces complexity
- ✅ Provides clear responsibility lines

This structure is recommended for production deployment as it balances functionality, security, and usability.

---

**Document Version:** 1.0  
**Date:** January 28, 2026  
**Status:** Ready for Review
