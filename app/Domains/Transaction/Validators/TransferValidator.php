<?php

namespace App\Domains\Transaction\Validators;

use App\Baseapp\Validator;

class TransferValidator extends Validator
{

    public static function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:10000',
            'remark' => 'nullable|string|max:255'
        ];
    }

    public static function messages(): array
    {
        return [
            'amount.min' => 'Minimal transfer adalah Rp10.000.',
            'remark.max' => 'Berita transfer maksimal 255 karakter.',
        ];
    }
}
