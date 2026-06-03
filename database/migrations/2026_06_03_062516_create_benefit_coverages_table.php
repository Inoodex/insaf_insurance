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
        Schema::create('benefit_coverages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('insurance_applications')->onDelete('cascade');
            $table->enum('benefit_type', [
                'medical_cover',
                'sea_mountain_rescue',
                'emergency_evacuation',
                'medical_repatriation',
                'repatriation_mortal_remains',
                'luggage',
                'accidental_death',
                'accidental_disability',
                'third_party_liability',
            ]);
            $table->decimal('max_amount', 10, 2);
            $table->char('currency', 3)->default('EUR');
            $table->string('delivery_note')->nullable();
            $table->string('deductible_note')->nullable();
            $table->timestamps();

            $table->unique(['application_id', 'benefit_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit_coverages');
    }
};
