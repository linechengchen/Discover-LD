<?php

namespace App\Http\Livewire;

use App\Models\WorkShopModel;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Teamcalendar extends Component
{
    protected $listeners = ['change'];
    public $workshop_id = 0;

    public function change()
    {
        Log::info('1234');
        $workshop = WorkShopModel::orderBy('id', 'desc')->with('values')->get();
        return view('livewire.teamcalendar', ['workshop' => $workshop, 'onlyworkshop' => $workshop[0]]);


    }

    public function render()
    {
        $workshop = WorkShopModel::orderBy('id', 'desc')->with('values')->get();
        if ($this->workshop_id == 0) {
            return view('livewire.teamcalendar', ['workshop' => $workshop, 'onlyworkshop' => $workshop[0]]);

        } else {
            return view('livewire.teamcalendar', ['workshop' => $workshop, 'onlyworkshop' => $workshop[$workshop_id]]);

        }
    }
}
