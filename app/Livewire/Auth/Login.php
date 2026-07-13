<?php

namespace App\Livewire\Auth;

use App\Baseapp\AppException;
use App\Domains\Auth\Services\AuthService;
use App\Domains\Auth\Validators\LoginValidator;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Throwable;

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

    public function login(AuthService $service)
    {
        $this->resetErrorBag();
        $this->validate();
        
        try {

            $user = $service->attempt(
                $this->phone,
                $this->password
            );

            Auth::login($user);


            return redirect()->route('dashboard');
        } catch (AppException $e) {

            $field = $e->field ?: 'general';

            $this->addError($field, $e->getMessage());
        } catch (\Throwable $e) {

            report($e);

            $this->addError(
                'general',
                'Ada kesalahan di server. Silakan coba lagi nanti.'
            );
        }
    }

    public function render()
    {
        return view('livewire.auth.login.index');
    }
}
