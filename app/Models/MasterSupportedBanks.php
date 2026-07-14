<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterSupportedBanks extends Model
{
    protected $table = 'master_supported_banks';

    protected $fillable = [
        'bank_code',
        'bank_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Bank Accounts
     */
    public function bankAccounts(): HasMany
    {
        return $this->hasMany(
            BankAccounts::class,
            'bank_code',
            'bank_code'
        );
    }
}