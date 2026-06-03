<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('application_id')->constrained('insurance_applications')->onDelete('cascade');
            $table->string('claim_number')->unique();
            $table->string('claim_type'); // Illness, Accident, etc.
            $table->date('event_date');
            $table->decimal('amount', 12, 2);
            $table->char('currency', 3)->default('EUR');
            $table->boolean('is_working')->default(false);
            $table->text('description')->nullable();
            
            // Bank Details
            $table->string('bank_name')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic_swift')->nullable();
            
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected', 'paid'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
