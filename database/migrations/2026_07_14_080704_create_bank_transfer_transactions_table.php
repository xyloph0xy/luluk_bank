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
        Schema::create('bank_transfer_transactions', function (Blueprint $table) {
            $table->id(); 

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

    
            $table->string('reference_no')->unique();

    
            $table->string('source_bank_code', 10);
            $table->string('source_account_number', 30);

            
            $table->string('destination_bank_code', 10);
            $table->string('destination_account_number', 30);
            $table->string('destination_account_name');

          
            $table->decimal('amount', 15, 2);
            $table->decimal('admin_fee', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);

           
            $table->string('remark')->nullable();

         
            $table->string('transaction_id')->nullable()->unique();
            $table->string('external_reference')->nullable();

       
            $table->enum('status', [
                'PENDING',
                'SUCCESS',
                'FAILED',
                'CANCELLED',
            ])->default('PENDING');

        
            $table->string('response_code')->nullable();
            $table->string('response_message')->nullable();

            $table->timestamp('processed_at')->nullable();

            $table->json('response_payload')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('transaction_id');
            $table->index('reference_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transfer_transactions');
    }
};
