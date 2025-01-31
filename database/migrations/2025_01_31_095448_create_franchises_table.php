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
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->string('franchise_name');
            $table->string('contact_no')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('aadhaar_no')->unique();
            $table->string('pan_no')->unique();
            $table->string('ifsc_code');
            $table->string('account_no');
            $table->string('street');
            $table->string('city');
            $table->string('district');
            $table->string('pincode');
            $table->string('state');
            $table->string('country');
            $table->date('doc'); // Date of Creation
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchises');
    }
};
