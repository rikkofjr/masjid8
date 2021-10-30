<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Auth;
use App\Models\User;
//Plugin
use Carbon\Carbon;
use DataTables;
use PDF;
use DB;
use Alert;
//use spesific models
use App\Models\AlamatJamaah;
use App\Models\DataJamaah;

class DataJamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $messages = [
            'nama.required' => 'Formulir Atas Nama Wajid Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Jamaah Wajid Diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Jamaah Wajid Diisi',
        ];
        $this->validate($request, [
            'nama'=>'required', 
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required'
        ],$messages);

        $dj = new DataJamaah;
        $dj->id_alamat_jamaah = $request->id_alamat_jamaah;
        $dj->nama = $request->nama;
        $dj->jenis_kelamin = $request->jenis_kelamin;
        $dj->tanggal_lahir = $request->tanggal_lahir;
        $dj->penginput = Auth::user()->id;
        $dj->save();

        //dd($dj);
        return redirect()->back();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Formulir Atas Nama Wajid Diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin Jamaah Wajid Diisi',
            'tanggal_lahir.required' => 'Tanggal Lahir Jamaah Wajid Diisi',
        ];
        $this->validate($request, [
            'nama'=>'required', 
            'jenis_kelamin'=>'required',
            'tanggal_lahir'=>'required'
        ],$messages);

        $dj = new DataJamaah;
        $dj->id_alamat_jamaah = $request->id_alamat_jamaah;
        $dj->nama = $request->nama;
        $dj->jenis_kelamin = $request->jenis_kelamin;
        $dj->tanggal_lahir = $request->tanggal_lahir;
        $dj->penginput = Auth::user()->id;
        $dj->save();

        //dd($dj);
        Alert::success('Berhasil Menambah Data', 'Data Atas Nama '.$dj->nama.' Berhasil ditambah');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function SoftDelete($id)
    {
        $aj = AlamatJamaah::find($id);
        $aj-> editor = Auth::user()->id;
        $aj->delete();
        $aj->anggotaKeluarga()->delete();
        return redirect()->route('adminalamat-jamaah.index')->with('hapus');
    }
    public function SoftDeleteByJamah($id)
    {
        $aj = DataJamaah::find($id);
        $aj-> editor = Auth::user()->id;
        $aj->delete();
        Alert::success('Berhasil Menghapus Data', 'Data atas nama <b>'.$aj->nama.' </b> berhasil dihapus');
        return redirect()->route('adminalamat-jamaah.show', $aj->id_alamat_jamaah);
    }
}
