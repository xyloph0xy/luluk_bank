<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pockets extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'name',
        'balance',
        'goal_amount',
        'achivement_date_goal',
    ];

    protected $casts = [
        'balance' => 'double',
        'goal_amount' => 'double',
        'achivement_date_goal' => 'date',
    ];

   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccounts::class, 'account_id');
    }


    public function color(): string
    {
        $colors = [
            '#0D6EFD',
            '#2563EB',
            '#3B82F6',
            '#60A5FA',
            '#FFD54F',
            '#FFE082',
            '#FBBF24',
        ];

        return $colors[$this->id % count($colors)];
    }

    public function textColor(): string
    {
        return in_array($this->color(), [
            '#FFD54F',
            '#FFE082',
            '#FBBF24',
        ]) ? '#212529' : '#FFFFFF';
    }
}
