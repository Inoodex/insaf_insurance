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
        Schema::table('students', function (Blueprint $table) {
            $table->string('address_2')->nullable()->after('institute_address');
            $table->string('zip_code')->nullable()->after('address_2');
            $table->string('city')->nullable()->after('zip_code');
            $table->string('country_code', 10)->nullable()->after('city');
            
            // Correspondence fields
            $table->boolean('is_company')->default(false)->after('country_code');
            $table->string('correspondence_firstname')->nullable()->after('is_company');
            $table->string('correspondence_lastname')->nullable()->after('correspondence_firstname');
            $table->string('correspondence_gender')->nullable()->after('correspondence_lastname');
            $table->string('correspondence_address_1')->nullable()->after('correspondence_gender');
            $table->string('correspondence_address_2')->nullable()->after('correspondence_address_1');
            $table->string('correspondence_country')->nullable()->after('correspondence_address_2');
            $table->string('correspondence_zip_code')->nullable()->after('correspondence_country');
            $table->string('correspondence_city')->nullable()->after('correspondence_zip_code');
            $table->string('correspondence_country_code', 10)->nullable()->after('correspondence_city');
            $table->string('correspondence_phone')->nullable()->after('correspondence_country_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'address_2', 'zip_code', 'city', 'country_code',
                'is_company', 'correspondence_firstname', 'correspondence_lastname',
                'correspondence_gender', 'correspondence_address_1', 'correspondence_address_2',
                'correspondence_country', 'correspondence_zip_code', 'correspondence_city',
                'correspondence_country_code', 'correspondence_phone'
            ]);
        });
    }
};
