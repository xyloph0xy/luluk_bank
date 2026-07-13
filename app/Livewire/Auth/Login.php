<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Validators\Auth\LoginValidator;

class Login extends Component
{
    public string $phone = '';

    public string $password = '';

    protected function rules(): array
    {
        return LoginValidator::rules();
    }

    protected function messages(): array
    {
        return LoginValidator::messages();
    }

    protected function validationAttributes(): array
    {
        return LoginValidator::attributes();
    }

    public function login()
    {
        $validated = $this->validate();

        dd($validated);
    }

    public function render()
    {
        return view('livewire.auth.login.index');
    }
}