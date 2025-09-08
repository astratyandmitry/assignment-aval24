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
        Schema::create('clients', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('pin', 16)->unique()->index();
            $table->string('full_name', 200);
            $table->date('birth_date');
            $table->string('location_region', 2);
            $table->string('location_city', 40);
            $table->string('contact_phone', 14)->unique()->index();
            $table->string('contact_email')->unique()->index();
            $table->integer('credit_score');
            $table->float('monthly_income_usd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
