<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('kota')
        ->select('kota.*','Provinsi.nama as namaProvinsi','provisi.kode as kodeProvinsi')
        ->join('provisi', 'kota.idProvinsi', '=', 'provisi.idProvinsi')
        ->where('kota.hapus',0)
        ->get();
        
    return view('kota.index',[
        'data' => $data,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataProvinsi = DB::table('Provinsi')
            ->where('hapus',1)
            ->get();
        return view('kota.tambah',[
            'dataProvinsi' => $dataProvinsi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->collect();
        $user = Auth::user();

        DB::table('Kota')
        ->insert(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idProvinsi' => $data['idProvinsi'],
        )
    );
    return redirect()->route('kota.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function show(Kota $kota)
    {
        return view('kota.detail',[
            'kota' => $kota,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit(Kota $kota)
    {
        $dataProvinsi = DB::table('Provinsi')
            ->where('hapus',1)
            ->get();
        return view('kota.edit'.[
            'dataProvinsi' => $dataProvinsi,
            'kota' => $kota,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kota $kota)
    {
        $data = $request->collect();

        DB::table('Kota')
        ->where('idKota', $kota['idKota'])
        ->update(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idProvinsi' => $data['idProvinsi'],
            'keterangan' => $data['keterangan'],
        )
        );
        return redirect()->route('kota.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kota $kota)
    {
        DB::table('kota')
        ->where('idKota', $kota['idKota'])
        ->update(array(
            'hapus' => 1,
        )
        );
        return redirect()->route('kota.index')->with('status','Success!!');
    }
}
