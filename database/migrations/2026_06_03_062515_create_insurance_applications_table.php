<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insurance_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('plan_id')->constrained('insurance_plans')->onDelete('restrict');
            $table->string('policy_number')->unique()->nullable();
            $table->string('gic_reference')->nullable();
            $table->string('first_destination');
            $table->string('territories')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedSmallInteger('duration_days');
            $table->decimal('premium_amount', 10, 2);
            $table->char('currency', 3)->default('EUR');
            $table->date('paid_on')->nullable();
            $table->enum('status', ['draft', 'sent', 'active', 'expired', 'cancelled'])->default('draft');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_applications');
    }
};
