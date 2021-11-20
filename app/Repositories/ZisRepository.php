<?php 

namespace App\Repositories;


class ZisRepository {

    public function zisHarian($zis_type, $nowMasehi){
        $zisHarian = Zis::select(
            DB::raw('DATE(created_at) as date'), 
            DB::raw('sum(uang) as uang_harian'), 
            DB::raw('sum(uang_infaq) as uang_infaq_harian'),
            DB::raw('sum(beras) as beras_harian'),
            DB::raw('sum(beras_infaq) as beras_infaq_harian'),
            DB::raw('sum(jumlah_jiwa) as jiwa_harian')
            )
        ->groupBy('date')
        ->where('id_zis_type', $zis_type)
        ->whereYear('created_at', $nowMasehi)
        ->get();
        return $zisHarian;
    }

}