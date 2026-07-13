<?php

namespace App\Baseapp;

use Livewire\Component as LivewireComponent;

abstract class Component extends LivewireComponent
{
    /**
     * Validator class.
     */
    protected string $validator;

    protected function rules(): array
    {
        return $this->validator::rules();
    }

    protected function messages(): array
    {
        return $this->validator::messages();
    }

    protected function validationAttributes(): array
    {
        return $this->validator::attributes();
    }
}