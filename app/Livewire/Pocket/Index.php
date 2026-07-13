<?php

namespace App\Livewire\Pocket;

use App\Domains\Pocket\Service\PocketService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public bool $showBalance = true;

    public int $balance = 14630000;
    public array $pockets = [];



    public function mount(PocketService $service)
    {
        $userID = Auth::user()->id;
        $this->pockets = $service->getAllPocket($userID)->toArray();
        $this->balance = $service->getBalance($userID);
    }

    public function render()
    {
        return view('livewire.pocket.index')->layout('layouts.app');;
    }
}
