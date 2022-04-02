<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('Kota')
        ->select('Kota.*','Provinsi.nama as namaProvinsi','Provinsi.kode as kodeProvinsi')
        ->join('Provisi', 'Kota.idProvinsi', '=', 'Provinsi.idProvinsi')
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
        ->get();
        return view('kota.tambah'.[
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
        DB::table('Kota')
        ->insert(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idProvinsi' => $data['idProvinsi'],
            'CreatedBy'=> $user->id,
            'CreatedOn'=> date("Y-m-d h:i:sa"),
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
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
        DB::table('Kota')
        ->where('idKota', $kota['idKota'])
        ->update(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idProvinsi' => $data['idProvinsi'],
            'keterangan' => $data['keterangan'],
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
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
        DB::table('Kota')
        ->where('idKota', $kota['idKota'])
        ->update(array(
            'hapus' => 1,
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
        )
        );
        return redirect()->route('kota.index')->with('status','Success!!');
    }
}
