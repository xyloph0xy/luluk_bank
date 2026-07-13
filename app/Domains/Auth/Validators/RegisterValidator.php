<?php

namespace App\Domains\Auth\Validators;

use App\Baseapp\Validator;

class RegisterValidator extends Validator
{
    /**
     * Validation Rules
     */
    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],

            'nickname' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],

            'phone' => [
                'required',
                'digits_between:10,13',
                'regex:/^(08|\+628)[0-9]+$/',
                'unique:users,phone_number',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'max:100',
                'confirmed',
            ],
        ];
    }

    /**
     * Validation Messages
     */
    public static function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal 3 karakter.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',

            'nickname.required' => 'Nama panggilan wajib diisi.',
            'nickname.min' => 'Nama panggilan minimal 3 karakter.',
            'nickname.max' => 'Nama panggilan maksimal 50 karakter.',

            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.digits_between' => 'Nomor HP harus terdiri dari 10 sampai 13 digit.',
            'phone.regex' => 'Format nomor HP tidak valid, gunakan formati 08xxx.',
            'phone.unique' => 'Nomor HP sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.max' => 'Password maksimal 100 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ];
    }

    /**
     * Attribute Names
     */
    public static function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'nickname' => 'Nama Panggilan',
            'phone' => 'Nomor HP',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
        ];
    }
}