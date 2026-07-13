<?php

namespace App\Livewire\Auth;

use App\Baseapp\AppException;
use App\Baseapp\Component;
use App\Domains\Auth\Services\AuthService;
use App\Domains\Auth\Validators\RegisterValidator;
use Illuminate\Support\Facades\Auth;


class Register extends Component
{
    public string $name = '';
    public string $nickname = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $showPassword = false;
    public bool $showPasswordConfirmation = false;

    protected string $validator = RegisterValidator::class;


    public function render()
    {
        return view('livewire.auth.register.index');
    }


    public function register(AuthService $service)
    {
        $this->resetValidation();
        $this->validate();

        try {

            $user = $service->register(
                $this->name,
                $this->nickname,
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
}
