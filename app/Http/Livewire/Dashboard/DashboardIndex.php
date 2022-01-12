<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Zis;

class DashboardIndex extends Component
{
    public function date(){
        $nowHijri =\GeniusTS\HijriDate\Date::today()->format('j F, Y');
        $nowMasehi = Carbon::today()->format('j F, Y');
    }
    public function render()
    {
        return view('livewire.dashboard.dashboard-index');
    }
}
