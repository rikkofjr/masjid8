<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Auth;
use App\User;

use Carbon\Carbon;
use DataTables;
use Ramsey\Uuid\Uuid;
use PDF;
use DB;
Use Alert;

use App\Models\Qurban;
use App\Models\MasjidProfile;

class QurbanController extends Controller
{
    public function qurbanDashboard(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehiDate = Carbon::today()->format('j F, Y'); 
        
        return view('dashboard.qurban.index', compact('nowHijriDate', 'nowMasehiYear','zisType'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehiDate = Carbon::today()->format('j F, Y');
        return view('dashboard.qurban.create', compact('nowHijriYear', 'nowMasehiDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');

        $messages = [
            'atas_nama.required' => 'Atas Nama  Wajid Diisi',
            'jenis_hewan.required' => 'Jenis Hewan harap diisi',
            'alamat.required' => 'Alamat pengqurban harap diisi',
            'permintaan.required' => 'Permintaan pengqurban harap  diisi',
            'nomor_handphone.required' => 'Nomor handphone harap diisi',
        ];
        $this->validate($request, [
            'atas_nama'=>'required', 
            'permintaan'=>'required', 
            'jenis_hewan'=>'required', 
            'alamat'=>'required', 
            'nomor_handphone'=>'required', 
        ],$messages);

            $nomorHewan = Helper::qurbanNomorHewan(new Qurban, $nowHijriYear, $request->jenis_hewan);
            
            $qurban = new Qurban;
            $qurban->jenis_hewan = $request->jenis_hewan;
            $qurban->amil = Auth::user()->id;
            $qurban->atas_nama = $request->atas_nama;
            $qurban->nama_lain = $request->nama_lain;
            $qurban->alamat = $request->alamat;
            $qurban->permintaan= $request->permintaan;
            $qurban->nomor_handphone= '62'. str_replace(",", "", $request->nomor_handphone);;
            $qurban->disaksikan= $request->disaksikan;
            $qurban->hijri = \GeniusTS\HijriDate\Date::today();
            $qurban->nomor_hewan = $nomorHewan;
            $qurban->save();
            Alert::success('Berhasil Menambah Hewan Kurban', 'a/n '.$qurban->atas_nama.'');
            return redirect()->route('adminqurban.show', $qurban->id);        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $masjidProfile = MasjidProfile::first();
        $qurban = Qurban::findOrFail($id);
        $textWhatsapp = 'Assalamualaikum Wr.Wb Bapak/ibu '.$qurban->atas_nama.'%0aPerkenalkan Saya '.Auth::user()->name.' panitia qurban '.$masjidProfile->nama_masjid.' ingin mengabarkan bahwa hewan kurban '.$qurban->jenis_hewan.' dengan permintaan '.$qurban->permintaan.' akan dipotong pada hari raya idul adha, apabila ada pertanyaan silahkan hubungi kami..,%0aWasalamualaikum Wr.Wb%0aTerimakasih%0a'.Auth::user()->name.'';
        return view('dashboard.qurban.show', compact('qurban', 'textWhatsapp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehiDate = Carbon::today()->format('j F, Y');
        $qurban = Qurban::findOrFail($id);
        return view('dashboard.qurban.edit', compact('nowMasehiDate','nowHijriYear','qurban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
