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
        Schema::create('master_supported_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_code', 10)->unique();
            $table->string('bank_name', 100);
            $table->boolean('is_active')->default(true);
            $table->decimal('fee')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_supported_banks');
    }
};
