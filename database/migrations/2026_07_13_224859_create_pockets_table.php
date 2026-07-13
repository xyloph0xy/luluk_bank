<?php

use App\Models\BankAccounts;
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
        Schema::create('pockets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')
                ->constrained((new User())->getTable());
            $table->foreignIdFor(BankAccounts::class, 'account_id')
                ->constrained((new BankAccounts())->getTable());
            $table->string('name')->unique();
            $table->double('balance')->default(0);
            $table->double('goal_amount')->nullable();
            $table->date('achivement_date_goal')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pockets');
    }
};
