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
        Schema::create('insurance_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->string('plan_level');
            $table->text('description')->nullable();
            $table->decimal('medical_cover_max', 10, 2)->default(0.00);
            $table->decimal('sea_mountain_rescue_max', 10, 2)->default(0.00);
            $table->decimal('emergency_evacuation_max', 10, 2)->default(0.00);
            $table->decimal('medical_repatriation_max', 10, 2)->default(0.00);
            $table->decimal('repatriation_mortal_remains_max', 10, 2)->default(0.00);
            $table->decimal('luggage_max', 10, 2)->default(0.00);
            $table->decimal('luggage_deductible', 10, 2)->default(0.00);
            $table->decimal('accidental_death_max', 10, 2)->default(0.00);
            $table->decimal('accidental_disability_max', 10, 2)->default(0.00);
            $table->decimal('third_party_liability_max', 10, 2)->default(0.00);
            $table->boolean('no_deductible_medical')->default(true);
            $table->boolean('no_waiting_period')->default(true);
            $table->boolean('schengen_included')->default(true);
            $table->string('territories')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_plans');
    }
};
