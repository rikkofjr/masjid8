<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\MasjidProfileController;
use Illuminate\Http\Request;
use App\Models\MasjidProfile;
use App\Models\DataJamaah;
use App\Models\AlamatJamaah;


class DashboardController extends Controller
{
    public function home(){
        $dataJamaah = DataJamaah::all();
        $alamatJamaah = AlamatJamaah::all();
        $masjidProfile = MasjidProfile::first();
        return view('dashboard.index', compact(
            'masjidProfile',
            'dataJamaah',
            'alamatJamaah' 
        ));
    }
    public function coba(){
        return view ('dashboard.coba');
    }
    public function updateMasjidProfile(Request $request){
        $messages = [
            'nama_masjid.required' => 'Nama Masjid Wajid Diisi',
            'alamat.required' => 'Alamat Wajib diisi diisi',
            'nomor_telepon.required' => 'Jenis zakat harap diisi',
        ];
        $this->validate($request, [
            'nama_masjid'=>'required', 
            'alamat'=>'required', 
            'nomor_telepon'=>'required', 
        ],$messages);

        $masjid = MasjidProfile::first();
        $masjid->nama_masjid = $request->nama_masjid;
        $masjid->alamat = $request->alamat;
        $masjid->nomor_telepon = $request->nomor_telepon;
        $masjid->nomor_handphone = $request->nomor_handphone;
        $masjid->email = $request->email;
        $masjid->user_update = auth()->user()->id;
        //dd($masjid);
        $masjid->save();
        return redirect()->route('adminIndex');
        //$masjid->save();
    }
}
