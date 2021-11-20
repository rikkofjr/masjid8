<?php 

namespace App\Repositories;
use Carbon\Carbon;


class DateRepository {

    public function hijriDateNow(){
        $hijriDateNow = \GeniusTS\HijriDate\Date::today()->format('j F, Y');
        return $hijriDateNow;
    }
    public function hijriYearNow() {
        $hijriYearNow = \GeniusTS\HijriDate\Date::today()->format('Y');
        return $hijriYearNow;
    }
    public function masehiDateNow(){
        $masehiDateNow = Carbon::format('j F, Y');
        return $masehiDateNow;
    }

}