<?php

namespace App\Livewire\Pocket;

use App\Baseapp\AppException;
use App\Domains\Pocket\Service\PocketService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $balance_pocket = 0;
    public $goal_amount;
    public $achivement_date_goal;
    public $mainAccountBalance;

    public function mount(PocketService $service)
    {
        $this->mainAccountBalance = $service->getMainBalance(Auth::user()->id);
    }

    public function save(PocketService $service)
    {
        try {
            DB::beginTransaction();
            $userID = Auth::user()->id;
            $service->addPocket(
                $userID,
                $this->name,
                $this->balance_pocket,
                $this->goal_amount,
                $this->achivement_date_goal
            );

            DB::commit();
            return redirect()->route('pocket.index');
        } catch (AppException $e) {

            DB::rollBack();
            $field = $e->field ?: 'general';

            $this->addError($field, $e->getMessage());
        } catch (\Throwable $e) {

            DB::rollBack();
            report($e);

            $this->addError(
                'general',
                'Ada kesalahan di server. Silakan coba lagi nanti.'
            );
        }
    }

    public function render()
    {
        return view('livewire.pocket.create');
    }
}
