<?php

use App\Models\User;
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
        Schema::create('top_up_transaction', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class, 'user_id')
                ->constrained((new User())->getTable());
            $table->string('va_number', 50);
            $table->string('account_number', 20);
            $table->foreign('account_number')
                ->references('account_number')
                ->on('bank_accounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->decimal('nominal', 18, 2);
            $table->decimal('admin_fee', 18, 2);
            $table->decimal('total_payment',18,2);
            $table->enum('status', ['PENDING', 'PAID', 'EXPIRED', 'FAILED'])->default('PENDING');
            $table->dateTime('expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_up_transaction');
    }
};
