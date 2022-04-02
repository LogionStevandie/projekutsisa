<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('Provinsi')
            ->select('Provinsi.*','Pulau.nama as namaPulau','Pulau.kode as kodePulau')
            ->join('Pulau', 'Provinsi.idPulau', '=', 'pulau.idPulau')
            ->get();
            
        return view('provinsi.index',[
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
        $dataPulau = DB::table('Pulau')
            ->get();
        return view('provinsi.tambah'.[
            'dataPulau' => $dataPulau,
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
        //       
        DB::table('Provinsi')
            ->insert(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'idPulau' => $data['idPulau'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('provinsi.index')->with('status','Success!!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $provinsi)
    {
        //
        return view('provinsi.detail',[
            'provinsi' => $provinsi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Provinsi $provinsi)
    {
        //
        $dataPulau = DB::table('Pulau')
            ->get();
        return view('provinsi.edit'.[
            'dataPulau' => $dataPulau,
            'provinsi' => $provinsi,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        DB::table('Provinsi')
        ->where('idProvinsi', $provinsi['idProvinsi'])
        ->update(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idPulau' => $data['idPulau'],
            'keterangan' => $data['keterangan'],
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
        )
        );
        return redirect()->route('provinsi.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
        DB::table('Provinsi')
        ->where('idProvinsi', $provinsi['idProvinsi'])
        ->update(array(
            'hapus' => 1,
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
        )
    );
    return redirect()->route('provinsi.index')->with('status','Success!!');
    }
}
