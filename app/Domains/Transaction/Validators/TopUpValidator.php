<?php

namespace App\Domains\Transaction\Validators;

use App\Baseapp\Validator;

class TopUpValidator extends Validator
{

    public static function rules():array
    {
        return [
            'selectedBank' => 'required',
            'amount' => 'required|numeric|min:10000',
        ];
    }

    public static function messages():array
    {
        return [
            'selectedBank.required' => 'Silakan pilih metode transfer bank terlebih dahulu.',
            'amount.required' => 'Nominal top up wajib diisi.',
            'amount.numeric' => 'Nominal harus berupa angka.',
            'amount.min' => 'Nominal minimal top up adalah Rp 10.000.',
        ];
    }
}
