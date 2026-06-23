<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE email_logs MODIFY COLUMN email_type ENUM('welcome_credentials', 'policy_issued', 'policy_reminder', 'custom', 'policy_download') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE email_logs MODIFY COLUMN email_type ENUM('welcome_credentials', 'policy_issued', 'policy_reminder', 'custom') NOT NULL");
    }
};
