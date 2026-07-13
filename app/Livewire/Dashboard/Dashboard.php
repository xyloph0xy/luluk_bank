<?php

namespace App\Livewire\Dashboard;

use App\Domains\Dashboard\Service\DashboardService;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public User $user;
    public bool $showBalance = false;

    public function mount(DashboardService $service)
    {
        $this->user = $service->dashboard();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
