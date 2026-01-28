# Rabbit Alley POS - Roles Quick Reference

## Current System: 8 Roles → Proposed: 4 Roles

---

## 📊 Current Roles Summary

| Role | Primary Function | Key Permissions |
|------|-----------------|-----------------|
| **SuperAdmin** | Full system access | All permissions |
| **Manager** | Operations management | Products, staff, approvals, reports |
| **Cashier** | Order & payment processing | Create orders, accept payments, receipts |
| **Waitress** | Order taking, LD assignment | Create orders, assign LD sales |
| **Bartender** | Bar operations | View bar queue, mark items done |
| **Kitchen** | Kitchen operations | View kitchen queue, mark items done |
| **LD_Manager** | LD & payroll | Manage LD staff, compute payouts |
| **Auditor** | Compliance & reporting | View audit logs, export reports |

---

## 🎯 Proposed 4 Roles

### 1. Administrator (EMP001)
**Consolidates:** SuperAdmin + Manager

**Can Do:**
- ✅ Everything (full system access)
- ✅ System configuration
- ✅ User management
- ✅ Approve voids/discounts
- ✅ Manage products & staff
- ✅ Compute payroll
- ✅ Generate reports
- ✅ All operations

**Cannot Do:** Nothing (full access)

---

### 2. Operations Staff (EMP002)
**Consolidates:** Cashier + Waitress + Bartender + Kitchen

**Can Do:**
- ✅ Create orders
- ✅ Process payments
- ✅ Print receipts
- ✅ Work in bar (view queue, mark done)
- ✅ Work in kitchen (view queue, mark done)
- ✅ Assign LD sales
- ✅ Request voids/discounts

**Cannot Do:**
- ❌ Approve voids/discounts
- ❌ Manage products/staff
- ❌ Compute payroll
- ❌ System settings

---

### 3. Finance Manager (EMP003)
**Consolidates:** LD_Manager + Auditor

**Can Do:**
- ✅ Compute daily payouts
- ✅ Manage LD staff
- ✅ View/export reports
- ✅ View audit logs
- ✅ Adjust LD credits

**Cannot Do:**
- ❌ Approve voids/discounts
- ❌ Manage products/staff
- ❌ System settings
- ❌ Create orders (read-only access)

---

### 4. Supervisor (EMP004)
**Consolidates:** Manager (partial) + Operations oversight

**Can Do:**
- ✅ Approve voids/discounts
- ✅ Edit orders after send
- ✅ View reports & audit logs
- ✅ Assist with orders/payments
- ✅ Monitor departments

**Cannot Do:**
- ❌ Manage products/staff
- ❌ Compute payroll
- ❌ System settings
- ❌ Full administrative access

---

## 🔄 Consolidation Map

```
SuperAdmin ──┐
             ├──> Administrator (EMP001)
Manager ─────┘

Cashier ─────┐
Waitress ────┤
Bartender ───┼──> Operations Staff (EMP002)
Kitchen ─────┘

LD_Manager ──┐
             ├──> Finance Manager (EMP003)
Auditor ─────┘

Manager (partial) ──> Supervisor (EMP004)
```

---

## ✅ Benefits

1. **Simpler:** 4 roles instead of 8
2. **Flexible:** Operations Staff can work anywhere
3. **Clear:** Each role has distinct purpose
4. **Complete:** No functionality lost
5. **Secure:** All security features preserved

---

## 📝 Default Login Credentials (After Migration)

| Role | Employee ID | Password |
|------|-------------|----------|
| Administrator | EMP001 | password |
| Operations Staff | EMP002 | password |
| Finance Manager | EMP003 | password |
| Supervisor | EMP004 | password |

---

**See `SYSTEM_ROLES_ANALYSIS.md` for detailed analysis.**
