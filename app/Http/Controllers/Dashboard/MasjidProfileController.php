<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasjidProfile;

class MasjidProfileController extends Controller
{
    public function editProfile(){
        $masjidProfile = MasjidProfile::first();
        return ($masjidProfile);
    }
    public function updateProfile(){
        $messages = [
            'atas_nama.required' => 'Atas Nama Formulir Wajid Diisi',
            'jumlah_jiwa.required' => 'Jumlah jiwa harap diisi',
            'zis_name.required' => 'Jenis zakat harap diisi',
        ];
        $this->validate($request, [
            'zis_name'=>'required', 
            //'amil'=>'required', 
            'atas_nama'=>'required', 
            'jumlah_jiwa'=>'required', 
        ],$messages);

        $zis = Zis::findOrFail($id);
        $zis->zis_name = $request->zis_name;
        $zis->hijri = \GeniusTS\HijriDate\Date::today();
        $zis->save();
    }
}
