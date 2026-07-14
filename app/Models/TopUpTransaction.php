<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopUpTransaction extends Model
{
    use HasUuids;

    protected $table = 'top_up_transaction';

    protected $fillable = [
        'user_id',
        'account_number',
        'va_number',
        'nominal',
        'admin_fee',
        'total_payment',
        'status',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'nominal' => 'integer',
    ];

    /**
     * UUID
     */
    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bank Account
     */
    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(
            BankAccounts::class,
            'account_number',
            'account_number'
        );
    }
}