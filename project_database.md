# Insurance Management — Database Design

> Admin-panel-only system where admins create student insurance applications and send login credentials via email.
> The `admins` table is **not included** — authentication uses the existing `users`, `roles`, `privileges`, and `user_roles` tables already in the project.

---

## Table of Contents

1. [Overview](#overview)
2. [Entity Relationship Summary](#entity-relationship-summary)
3. [Tables](#tables)
   - [students](#1-students)
   - [insurance_plans](#2-insurance_plans)
   - [insurance_applications](#3-insurance_applications)
   - [benefit_coverages](#4-benefit_coverages)
   - [email_logs](#5-email_logs)
4. [Migration Order](#migration-order)
5. [Status Flows](#status-flows)
6. [Key Design Decisions](#key-design-decisions)

---

## Overview

The system allows admin users to:

- Register students (name, passport, DOB, nationality, institute, etc.)
- Create insurance applications on behalf of students by selecting a plan
- Auto-generate a temporary password and send a welcome email to the student
- Track every email sent (credentials, policy confirmation, reminders)
- Maintain a reusable plan/benefit template so amounts are not re-entered every time

---

## Entity Relationship Summary

```
users (existing)
  └── has many → insurance_applications  (as creator/admin)
  └── has many → email_logs              (as sender)

students
  └── has many → insurance_applications
  └── has many → email_logs

insurance_plans
  └── has many → insurance_applications

insurance_applications
  └── belongs to → students
  └── belongs to → users (admin)
  └── belongs to → insurance_plans
  └── has many  → benefit_coverages
  └── has many  → email_logs

benefit_coverages
  └── belongs to → insurance_applications

email_logs
  └── belongs to → students
  └── belongs to → users (admin)
  └── belongs to → insurance_applications (nullable)
```

---

## Tables

---

### 1. `students`

Stores all student data pre-populated by the admin. The student later logs in using the temporary credentials emailed to them.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | bigint (PK) | No | auto | Primary key |
| `full_name` | string | No | — | e.g. `SUNOY BARUA` |
| `email` | string (unique) | No | — | Login email & correspondence |
| `passport_number` | string (unique) | No | — | e.g. `A07303864` |
| `date_of_birth` | date | No | — | e.g. `1993-05-27` |
| `gender` | enum | No | — | `male`, `female`, `other` |
| `nationality` | string | No | — | e.g. `Bangladesh` |
| `country_of_origin` | string | No | — | e.g. `Bangladesh` |
| `phone_number` | string | Yes | NULL | e.g. `+35677775386` |
| `institute_name` | string | No | — | e.g. `International Institute by Malta` |
| `institute_address` | text | No | — | Full address block |
| `password` | string | No | — | Bcrypt hashed password |
| `temporary_password` | string | Yes | NULL | Plain-text temp password, cleared after first login |
| `password_changed` | boolean | No | `false` | Flips to `true` after student resets password |
| `remember_token` | string | Yes | NULL | Laravel remember-me token |
| `created_at` | timestamp | Yes | NULL | — |
| `updated_at` | timestamp | Yes | NULL | — |
| `deleted_at` | timestamp | Yes | NULL | Soft delete |

**Notes:**
- `temporary_password` should be set to `null` once `password_changed` becomes `true`.
- `email` is the student's login identifier on the student-facing portal.

---

### 2. `insurance_plans`

Reusable plan templates. Admin picks a plan when creating an application — no need to re-enter benefit amounts each time.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | bigint (PK) | No | auto | Primary key |
| `plan_name` | string | No | — | e.g. `Standard` |
| `plan_level` | string | No | — | e.g. `Standard`, `Premium` |
| `description` | text | Yes | NULL | Optional internal notes |
| `medical_cover_max` | decimal(10,2) | No | `0.00` | Max medical cover in EUR |
| `sea_mountain_rescue_max` | decimal(10,2) | No | `0.00` | Max sea & mountain rescue |
| `emergency_evacuation_max` | decimal(10,2) | No | `0.00` | Max emergency evacuation |
| `medical_repatriation_max` | decimal(10,2) | No | `0.00` | Max medical repatriation |
| `repatriation_mortal_remains_max` | decimal(10,2) | No | `0.00` | Max repatriation of mortal remains |
| `luggage_max` | decimal(10,2) | No | `0.00` | Max luggage cover |
| `luggage_deductible` | decimal(10,2) | No | `0.00` | Deductible per luggage claim |
| `accidental_death_max` | decimal(10,2) | No | `0.00` | Lump sum for accidental death |
| `accidental_disability_max` | decimal(10,2) | No | `0.00` | Lump sum for accidental disability |
| `third_party_liability_max` | decimal(10,2) | No | `0.00` | Max third-party liability |
| `no_deductible_medical` | boolean | No | `true` | No deductible/excess on medical |
| `no_waiting_period` | boolean | No | `true` | No waiting periods applied |
| `schengen_included` | boolean | No | `true` | Schengen countries included |
| `territories` | string | Yes | NULL | e.g. `Worldwide excluding US, Canada and country of origin` |
| `is_active` | boolean | No | `true` | Hide retired plans from selection |
| `created_at` | timestamp | Yes | NULL | — |
| `updated_at` | timestamp | Yes | NULL | — |
| `deleted_at` | timestamp | Yes | NULL | Soft delete |

**Example row (from PDF):**

| Field | Value |
|---|---|
| plan_name | Standard |
| medical_cover_max | 50,000.00 |
| emergency_evacuation_max | 150,000.00 |
| medical_repatriation_max | 50,000.00 |
| sea_mountain_rescue_max | 30,000.00 |
| repatriation_mortal_remains_max | 30,000.00 |
| luggage_max | 1,000.00 |
| luggage_deductible | 250.00 |
| accidental_death_max | 25,000.00 |
| accidental_disability_max | 50,000.00 |
| third_party_liability_max | 500,000.00 |

---

### 3. `insurance_applications`

The core table. Links a student, an admin (from `users`), and a plan together into a single policy record.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | bigint (PK) | No | auto | Primary key |
| `student_id` | bigint (FK) | No | — | → `students.id` |
| `user_id` | bigint (FK) | No | — | → `users.id` (admin who created it) |
| `plan_id` | bigint (FK) | No | — | → `insurance_plans.id` |
| `policy_number` | string (unique) | Yes | NULL | e.g. `ISIE-684185`, assigned after submission |
| `gic_reference` | string | Yes | NULL | e.g. `ISIE-GIC-012026` |
| `first_destination` | string | No | — | e.g. `Malta` |
| `territories` | string | Yes | NULL | Override plan default if needed |
| `start_date` | date | No | — | e.g. `2026-07-26` |
| `end_date` | date | No | — | e.g. `2027-01-23` |
| `duration_days` | smallint unsigned | No | — | e.g. `182` |
| `premium_amount` | decimal(10,2) | No | — | e.g. `98.30` |
| `currency` | char(3) | No | `EUR` | ISO currency code |
| `paid_on` | date | Yes | NULL | e.g. `2026-04-21` |
| `status` | enum | No | `draft` | See [status flow](#application-status-flow) below |
| `notes` | text | Yes | NULL | Internal admin notes |
| `created_at` | timestamp | Yes | NULL | — |
| `updated_at` | timestamp | Yes | NULL | — |
| `deleted_at` | timestamp | Yes | NULL | Soft delete |

**Foreign key behaviour:**
- `student_id` → `CASCADE DELETE` (application deleted if student is force-deleted)
- `user_id` → `RESTRICT DELETE` (cannot delete admin user who has applications)
- `plan_id` → `RESTRICT DELETE` (cannot delete a plan in use)

---

### 4. `benefit_coverages`

Stores per-application benefit breakdown rows — mirrors the benefits table shown on the PDF policy document. Populated automatically from the selected plan, but can be overridden per application.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | bigint (PK) | No | auto | Primary key |
| `application_id` | bigint (FK) | No | — | → `insurance_applications.id` |
| `benefit_type` | enum | No | — | See benefit types below |
| `max_amount` | decimal(10,2) | No | — | Maximum coverage amount |
| `currency` | char(3) | No | `EUR` | ISO currency code |
| `delivery_note` | string | Yes | NULL | e.g. `By air, land or sea`, `Lump sum` |
| `deductible_note` | string | Yes | NULL | e.g. `Deductible of €250.00 per claim` |
| `created_at` | timestamp | Yes | NULL | — |
| `updated_at` | timestamp | Yes | NULL | — |

**Unique constraint:** `(application_id, benefit_type)` — one row per benefit per application.

**`benefit_type` enum values:**

| Value | Label on PDF |
|---|---|
| `medical_cover` | Medical cover |
| `sea_mountain_rescue` | Sea and mountain search and rescue |
| `emergency_evacuation` | Emergency medical evacuation |
| `medical_repatriation` | Medical repatriation |
| `repatriation_mortal_remains` | Repatriation of mortal remains |
| `luggage` | Luggage |
| `accidental_death` | Accidental death |
| `accidental_disability` | Accidental disability |
| `third_party_liability` | Third party liability |

---

### 5. `email_logs`

Tracks every email sent by the system. Keeps a full audit trail for debugging and re-sending.

| Column | Type | Nullable | Default | Description |
|---|---|---|---|---|
| `id` | bigint (PK) | No | auto | Primary key |
| `student_id` | bigint (FK) | No | — | → `students.id` |
| `application_id` | bigint (FK) | Yes | NULL | → `insurance_applications.id` (nullable for welcome emails) |
| `user_id` | bigint (FK) | No | — | → `users.id` (admin who triggered the send) |
| `email_type` | enum | No | — | See email types below |
| `subject` | string | No | — | Email subject line |
| `recipient_email` | string | No | — | Snapshot of email at time of send |
| `status` | enum | No | `pending` | `pending`, `sent`, `failed` |
| `sent_at` | timestamp | Yes | NULL | When the email was actually delivered |
| `error_message` | text | Yes | NULL | Queue/SMTP error if `status = failed` |
| `created_at` | timestamp | Yes | NULL | — |
| `updated_at` | timestamp | Yes | NULL | — |

**`email_type` enum values:**

| Value | When it fires |
|---|---|
| `welcome_credentials` | Admin creates a student — sends email + temp password |
| `policy_issued` | Admin sends the completed policy to the student |
| `policy_reminder` | Automated reminder before policy expiry |
| `custom` | Any manually triggered email from admin panel |

**Foreign key behaviour:**
- `application_id` → `SET NULL` on delete (log is preserved even if application is deleted)
- `student_id` → `CASCADE DELETE`
- `user_id` → `RESTRICT DELETE`

---

## Migration Order

Run migrations in this exact order to satisfy foreign key constraints:

```
1. students
2. insurance_plans
3. insurance_applications   (depends on: students, users, insurance_plans)
4. benefit_coverages        (depends on: insurance_applications)
5. email_logs               (depends on: students, users, insurance_applications)
```

```bash
php artisan migrate
```

> `users` table is already in the project — no migration needed for it.

---

## Status Flows

### Application status flow

```
draft → sent → active → expired
                      ↘ cancelled
```

| Status | Meaning |
|---|---|
| `draft` | Admin is filling in the application details |
| `sent` | Admin clicked "Send" — student received email with policy |
| `active` | Current date is within `start_date` and `end_date` |
| `expired` | `end_date` has passed |
| `cancelled` | Manually cancelled by admin |

> Tip: use a scheduled artisan command to auto-transition `sent → active` and `active → expired` based on dates.

### Email status flow

```
pending → sent
        ↘ failed (can be retried → pending again)
```

---

## Key Design Decisions

| Decision | Reason |
|---|---|
| `admins` table excluded | Project already has `users`, `roles`, `privileges`, `user_roles` — `insurance_applications` and `email_logs` reference `users.id` instead |
| `temporary_password` stored in `students` | Admin needs to email it once; cleared after `password_changed = true` to avoid storing plain-text long-term |
| `benefit_coverages` is a separate table | Allows per-application benefit overrides without changing the plan template |
| `insurance_plans` is a reusable template | Prevents re-entering 10 benefit amounts every time a new application is created |
| `email_logs.application_id` is nullable | Welcome/credential emails are sent before any application exists |
| `recipient_email` snapshot in `email_logs` | Student email may change later; the log must reflect what was used at send time |
| Soft deletes on `students`, `plans`, `applications` | Preserves historical data and audit trail; hard deletes only via force |
| Unique constraint on `(application_id, benefit_type)` | Prevents duplicate benefit rows per application |
