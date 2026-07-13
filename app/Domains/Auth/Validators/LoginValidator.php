<?php

namespace App\Domains\Auth\Validators;

use App\Baseapp\Validator;

class LoginValidator extends Validator
{
    /**
     * Validation Rules
     */
    public static function rules(): array
    {
        return [
            'phone' => [
                'required',
                'digits_between:10,13',
                'regex:/^(08)[0-9]+$/',
            ],

            'password' => [
                'required'
            ],
        ];
    }

    /**
     * Validation Messages
     */
    public static function messages(): array
    {
        return [
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.digits_between' => 'Nomor HP harus terdiri dari 10 sampai 13 digit.',
            'phone.regex' => 'Format nomor HP tidak valid, gunakan format 08xxx.',

            'password.required' => 'Password wajib diisi.'
        ];
    }

    /**
     * Attribute Names
     */
    public static function attributes(): array
    {
        return [
            'phone' => 'Nomor HP',
            'password' => 'Password',
        ];
    }
}
