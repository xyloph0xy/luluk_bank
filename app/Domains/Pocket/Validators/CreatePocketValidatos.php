<?php

namespace App\Domains\Pocket\Validators;

use App\Baseapp\Validator;

class CreatePocketValidatos extends Validator
{

    public static function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'exists:users,id',
            ],

            'account_id' => [
                'required',
                'exists:bank_accounts,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:pockets,name',
            ],

            'balance' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'goal_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'achivement_date_goal' => [
                'nullable',
                'date',
                'after_or_equal:today',
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            'user_id.required' => 'User wajib dipilih.',
            'user_id.exists' => 'User tidak ditemukan.',

            'account_id.required' => 'Rekening wajib dipilih.',
            'account_id.exists' => 'Rekening tidak ditemukan.',

            'name.required' => 'Nama pocket wajib diisi.',
            'name.unique' => 'Nama pocket sudah digunakan.',

            'balance.numeric' => 'Saldo harus berupa angka.',
            'balance.min' => 'Saldo tidak boleh kurang dari 0.',

            'goal_amount.numeric' => 'Target tabungan harus berupa angka.',
            'goal_amount.min' => 'Target tabungan tidak boleh kurang dari 0.',

            'achivement_date_goal.date' => 'Tanggal target tidak valid.',
            'achivement_date_goal.after_or_equal' => 'Tanggal target tidak boleh sebelum hari ini.',
        ];
    }
}
