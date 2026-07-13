<?php

namespace App\Validators\Auth;

use App\Validators\Validator;

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
                'regex:/^(08|\+628)[0-9]+$/',
            ],

            'password' => [
                'required',
                'min:8',
                'max:100',
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
            'phone.regex' => 'Format nomor HP tidak valid.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 100 karakter.',
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