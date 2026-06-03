<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\InsurancePlan;
use App\Models\InsuranceApplication;
use App\Models\BenefitCoverage;
use App\Models\Claim;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = User::first()?->id ?? 1;

        // 1. Create Insurance Plans
        $plans = [
            [
                'plan_name' => 'Standard Europe',
                'plan_level' => 'Basic',
                'description' => 'Essential coverage for students traveling to Europe.',
                'medical_cover_max' => 30000.00,
                'emergency_evacuation_max' => 50000.00,
                'medical_repatriation_max' => 50000.00,
                'sea_mountain_rescue_max' => 5000.00,
                'repatriation_mortal_remains_max' => 10000.00,
                'luggage_max' => 1000.00,
                'luggage_deductible' => 50.00,
                'accidental_death_max' => 10000.00,
                'accidental_disability_max' => 20000.00,
                'third_party_liability_max' => 100000.00,
                'territories' => 'Schengen Area',
                'is_active' => true,
            ],
            [
                'plan_name' => 'Premium Global',
                'plan_level' => 'Premium',
                'description' => 'Comprehensive global coverage with higher limits.',
                'medical_cover_max' => 100000.00,
                'emergency_evacuation_max' => 250000.00,
                'medical_repatriation_max' => 250000.00,
                'sea_mountain_rescue_max' => 20000.00,
                'repatriation_mortal_remains_max' => 50000.00,
                'luggage_max' => 3000.00,
                'luggage_deductible' => 0.00,
                'accidental_death_max' => 50000.00,
                'accidental_disability_max' => 100000.00,
                'third_party_liability_max' => 500000.00,
                'territories' => 'Worldwide',
                'is_active' => true,
            ],
        ];

        foreach ($plans as $planData) {
            InsurancePlan::create($planData);
        }

        $standardPlan = InsurancePlan::where('plan_name', 'Standard Europe')->first();
        $premiumPlan = InsurancePlan::where('plan_name', 'Premium Global')->first();

        // 2. Create Students
        $students = [
            [
                'full_name' => 'Student One',
                'email' => 'student1@example.com',
                'passport_number' => 'A12345678',
                'date_of_birth' => '2000-01-01',
                'gender' => 'male',
                'nationality' => 'Bangladeshi',
                'country_of_origin' => 'Bangladesh',
                'phone_number' => '+8801837974064',
                'institute_name' => 'International Institute by Malta',
                'institute_address' => '135 Triq Hal Luqa, Rahal Gdid PLA 1501, Malta',
                'password' => Hash::make('password'),
                'temporary_password' => null,
                'password_changed' => true,
                'correspondence_firstname' => 'Parent',
                'correspondence_lastname' => 'One',
                'correspondence_address_1' => '123 Main St',
                'correspondence_city' => 'Dhaka',
                'correspondence_country' => 'Bangladesh',
                'correspondence_phone' => '01711111111',
            ],
            [
                'full_name' => 'Student Two',
                'email' => 'student2@example.com',
                'passport_number' => 'B98765432',
                'date_of_birth' => '2001-10-15',
                'gender' => 'female',
                'nationality' => 'German',
                'country_of_origin' => 'Germany',
                'phone_number' => '+49123456789',
                'institute_name' => 'University of Malta',
                'institute_address' => 'Msida MSD 2080, Malta',
                'password' => Hash::make('password'),
                'temporary_password' => null,
                'password_changed' => true,
                'correspondence_firstname' => 'Contact',
                'correspondence_lastname' => 'Two',
                'correspondence_address_1' => '456 Berlin Ave',
                'correspondence_city' => 'Berlin',
                'correspondence_country' => 'Germany',
                'correspondence_phone' => '030123456',
            ],
        ];

        foreach ($students as $studentData) {
            $student = Student::create($studentData);

            // 3. Create Applications for each student
            $isPremium = $student->email == 'student1@example.com';
            $plan = $isPremium ? $premiumPlan : $standardPlan;
            
            $application = InsuranceApplication::create([
                'student_id' => $student->id,
                'user_id' => $adminId,
                'plan_id' => $plan->id,
                'policy_number' => 'ISIE-' . strtoupper(Str::random(6)),
                'gic_reference' => 'GIC-' . strtoupper(Str::random(5)),
                'first_destination' => 'Malta',
                'territories' => $plan->territories,
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(170),
                'duration_days' => 180,
                'premium_amount' => $isPremium ? 150.00 : 98.30,
                'currency' => 'EUR',
                'paid_on' => now()->subDays(11),
                'status' => 'active',
                'notes' => 'Test application seeded by system.',
            ]);

            // Create Benefit Coverages for the application
            $benefits = [
                'medical_cover' => $plan->medical_cover_max,
                'sea_mountain_rescue' => $plan->sea_mountain_rescue_max,
                'emergency_evacuation' => $plan->emergency_evacuation_max,
                'medical_repatriation' => $plan->medical_repatriation_max,
                'repatriation_mortal_remains' => $plan->repatriation_mortal_remains_max,
                'luggage' => $plan->luggage_max,
                'accidental_death' => $plan->accidental_death_max,
                'accidental_disability' => $plan->accidental_disability_max,
                'third_party_liability' => $plan->third_party_liability_max,
            ];

            foreach ($benefits as $type => $amount) {
                BenefitCoverage::create([
                    'application_id' => $application->id,
                    'benefit_type' => $type,
                    'max_amount' => $amount,
                    'currency' => 'EUR',
                    'deductible_note' => ($type === 'luggage' && $plan->luggage_deductible > 0) 
                        ? "Deductible of EUR {$plan->luggage_deductible} per claim" : null,
                ]);
            }

            // 4. Create a Sample Claim for Sunoy
            if ($isPremium) {
                Claim::create([
                    'student_id' => $student->id,
                    'application_id' => $application->id,
                    'claim_number' => 'CLM-' . strtoupper(Str::random(8)),
                    'claim_type' => 'Accident',
                    'event_date' => now()->subDays(2),
                    'amount' => 450.00,
                    'currency' => 'EUR',
                    'is_working' => false,
                    'description' => 'Minor sports injury during weekend activities.',
                    'bank_name' => 'Bank of Valletta',
                    'account_holder' => $student->full_name,
                    'iban' => 'MT12BOVA1234567890123456789',
                    'bic_swift' => 'BOVAMTMT',
                    'status' => 'pending',
                ]);
            }
        }
    }
}
