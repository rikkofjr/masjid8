<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zis;
use App\Models\ZisType;

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

class ZisController extends Controller
{
    private $nowHijriDate;
    private $nowHijriYear;

    public function __constuct(){
        $this->nowHijriDate = \GeniusTS\HijriDate\Date::today()->format('j F, Y');
        $this->nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zisDashboard(){
        $nowHijri = \GeniusTS\HijriDate\Date::today()->format('j F, Y');
        $nowMasehi = Carbon::today()->format('j F, Y');
        $zisType = ZisType::select('id', 'zis_type')->get();
        return view('dashboard.zis.admin-zis', compact('nowMasehi', 'nowHijri','zisType'));
    }
    // public function index()
    // {
    //     $pendapatanHarian = Zis::orderBy('created_at')
    //     $nowHijri = \GeniusTS\HijriDate\Date::today()->format('j F, Y');
    //     $nowMasehi = Carbon::today()->format('j F, Y');
    //     return view('dashboard.zis.index', compact('nowHijri', 'nowMasehi'));
    // }
    public function rekapHarian($zis_type){
        $nowHijri = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehi = Carbon::today()->format('Y');
        $zisType = ZisType::where('id', $zis_type)->get();
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

        $zisTahunan = Zis::select(
            DB::raw('YEAR(hijri) as date'), 
            DB::raw('sum(uang) as uang_harian'), 
            DB::raw('sum(uang_infaq) as uang_infaq_harian'),
            DB::raw('sum(beras) as beras_harian'),
            DB::raw('sum(beras_infaq) as beras_infaq_harian'),
            DB::raw('sum(jumlah_jiwa) as jiwa_harian')
            )
        ->groupBy('date')
        ->where('id_zis_type', $zis_type)
        ->get();
        //dd($zisType);
        $jumlahUangTotal = Zis::where('id_zis_type', $zis_type)->whereYear('hijri',$nowHijri)->sum('uang');
        $jumlahUangInfaqTotal = Zis::where('id_zis_type', $zis_type)->whereYear('hijri',$nowHijri)->sum('uang_infaq');
        $jumlahBerasTotal = Zis::where('id_zis_type', $zis_type)->whereYear('hijri',$nowHijri)->sum('beras');
        $jumlahBerasInfaqTotal = Zis::where('id_zis_type', $zis_type)->whereYear('hijri',$nowHijri)->sum('beras_infaq');
        $jumlahJiwaTotal = Zis::where('id_zis_type', $zis_type)->whereYear('hijri',$nowHijri)->sum('jumlah_jiwa');
        return view('dashboard.zis.rekapan', compact('nowHijri', 
        'nowMasehi',
        'zisType',
        'jumlahUangTotal',
        'jumlahUangInfaqTotal',
        'jumlahBerasTotal',
        'jumlahBerasInfaqTotal',
        'jumlahJiwaTotal',
        'zisTahunan',
        'zisHarian')); 
    }
    public function index(){
        
        $nowHijri = $this->nowHijriDate;
        $nowMasehi = Carbon::today()->format('Y');
        $zisType = ZisType::orderBy('zis_type', 'DESC')
        ->withCount(['zis', 'zis as zis_by_year_count' =>
            function ($query){
                $query->whereYear('hijri', \GeniusTS\HijriDate\Date::today()->format('Y'));
            }])
        ->get();
        return view('dashboard.zis.index', compact('nowHijri', 'nowMasehi','zisType'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$hijri = ;
        $todayHijri =\GeniusTS\HijriDate\Date::today()->format('Y');
        $ZisType = ZisType::all()->sortBy('id')->pluck('zis_type', 'id');
        return view('dashboard.zis.create', compact('ZisType','todayHijri'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
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

        $zis = new Zis;
        $zis->id_zis_type = $request->zis_name;
        $zis->amil = Auth::user()->id;
        $zis->atas_nama = $request->atas_nama;
        $zis->nama_lain = $request->nama_lain;
        $zis->jumlah_jiwa = $request->jumlah_jiwa;
        if(isset($request->uang)){
            $zis->uang = str_replace(".", "", $request->uang);
        }
        if(isset($request->uang_infaq)){
            $zis->uang_infaq = str_replace(".", "", $request->uang_infaq);
        }

        $zis->beras = $request->beras;
        $zis->beras_infaq = $request->beras_infaq;
        $zis->hijri = \GeniusTS\HijriDate\Date::today();
        $zis->save();
        Alert::success('Berhasil Menambah ZIS', 'a/n '.$zis->atas_nama.'');
        return redirect()->route('adminzis.show', $zis->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nowHijri =\GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehi = Carbon::today()->format('j F, Y');
        $zis = Zis::findOrFail($id);
        return view('dashboard.zis.show', compact('zis', 'nowHijri', 'nowMasehi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zis = Zis::findOrFail($id); //Get data with specified id
        $ZisType = ZisType::all()->sortBy('id')->pluck('zis_type', 'id');
        if(Auth::user()->id == $zis->amil || Auth::user()->hasPermissionTo('outsource-delete')){
            return view('dashboard.zis.edit', compact('zis','ZisType'));
        }else{
            abort('404');
        }
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
        //Validating title and body field
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
        //$zis->amil = Auth::user()->id;
        $zis->atas_nama = $request->atas_nama;
        $zis->nama_lain = $request->nama_lain;
        $zis->jumlah_jiwa = $request->jumlah_jiwa;
        if(isset($request->uang)){
            $zis->uang = str_replace(".", "", $request->uang);
        }else{
            $zis->uang = $request->uang;
        }
        if(isset($request->uang_infaq)){
            $zis->uang_infaq = str_replace(".", "", $request->uang_infaq);
        }else{
            $zis->uang_infaq = $request->uang_infaq;
        }
        $zis->beras = $request->beras;
        $zis->beras_infaq = $request->beras_infaq;
        $zis->hijri = \GeniusTS\HijriDate\Date::today();
        $zis->save();
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
    public function SoftDeleteById($id){
        //softdelte record
        $zis = zis::findOrFail($id);
        $zis->delete();
        Alert::success('Berhasil Menghapus Data Zis', 'a/n '.$zis->atas_nama.'');
        return redirect()->route('adminzis.index');  
         
    }
    public function getZisDataByThisYear(){
        $nowHijri = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehi = Carbon::today()->format('Y');
        $dataFitrah = Zis::orderBy('created_at','desc')
        ->whereYear('hijri',$nowHijri)->get(); 
        return Datatables::of($dataFitrah)
            ->addColumn(('id_zis_typex'), function ($dataFitrah){
                $btn = '<a href="'.route('adminZisRekapHarian', $dataFitrah->id_zis_type).'">'.$dataFitrah->jenis_zakat->zis_type.'</a>';
                //return $datafitrah->id_zis_type ? with ('<a href="'.route('adminApiZisDataByThisYear', $datafitrah->id_zis_type).'">'.$datafitrah->jenis_zakat->zis_type).'</a>': '';
                return $btn;
            })
            ->editColumn(('uang'), function ($dataFitrah){
                return $dataFitrah->uang ? with (number_format($dataFitrah->uang)) : '';
            })
            ->editColumn(('uang_infaq'), function ($dataFitrah){
                return $dataFitrah->uang_infaq ? with (number_format($dataFitrah->uang_infaq)) : '';
            })
            ->editColumn(('atas_nama'), function($dataFitrah){
                $btn = '<a href="'.route('adminzis.show', $dataFitrah->id).'">'.$dataFitrah->atas_nama.'</a>';
                return $btn;
            })
            ->editColumn(('created_at'), function ($dataFitrah){
               return $dataFitrah->created_at ? with (new carbon($dataFitrah->created_at))->format('d/m/Y | H:i') : '';
            })
            ->addIndexColumn()
            ->removeColumn('updated_at','nama_lain','amil_editor', 'deleted_at', 'id_zis_type')
            ->rawColumns(['id_zis_typex', 'atas_nama'])
            //->addIndexColumn()
            ->make();
    }
    //
    public function PrintZakatJamaah($id){
        $todayHijri =\GeniusTS\HijriDate\Date::today()->format('Y');
        $zis = Zis::findOrFail($id);

        $pdf = PDF::loadview('dashboard.zis.print.print',['zis'=>$zis, 'nowHijri'=>$todayHijri]);
        return $pdf->stream('zakat'.$id.'.pdf');
        
    }
}
