<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Zis;
use App\Models\KasPenerimaan;
use App\Models\KasPengeluaran;

use DB;

class DashboardIndex extends Component
{
    
    public function render()
    {

        $nowMasehi = Carbon::today()->format('j F, Y');
        return view('livewire.dashboard.dashboard-index', compact(
            'nowMasehi'
        ));
    }
}
