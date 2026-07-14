<?php

namespace App\Baseapp;

abstract class Validator
{
    public static function rules(): array
    {
        return [];
    }

    public static function messages(): array
    {
        return [];
    }

    public static function attributes(): array
    {
        return [];
    }

    /**
     * Get Validator Configuration
     */
    public static function make(): array
    {
        return [
            'rules'      => static::rules(),
            'messages'   => static::messages(),
            'attributes' => static::attributes(),
        ];
    }
}
