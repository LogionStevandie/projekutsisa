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
        ->select('kota.*','Provinsi.nama as namaProvinsi','provinsi.kode as kodeProvinsi')
        ->join('provinsi','kota.idProvinsi', '=', 'provinsi.idProvinsi')
        ->where('kota.hapus',"=",0)
        ->get();
        
        return view('kota.index',[
            'data' => $data,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('kota.index', $user->id, $user->idRole);
        
        if($check){
            return view('kota.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Kota Master');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataProvinsi = DB::table('Provinsi')
            ->where('hapus',0)
            ->get();
        return view('kota.tambah',[
            'dataProvinsi' => $dataProvinsi,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('kota.create', $user->id, $user->idRole);
        
        if($check){
            return view('kota.tambah',[
                'dataProvinsi' => $dataProvinsi,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Kota Master');
        }
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
    public function show(Kota $kotum)
    {
         $dataProvinsi = DB::table('Provinsi')
            ->where('hapus',0)
            ->get();
        return view('kota.show',[
            'dataProvinsi' => $dataProvinsi,
            'kota' => $kotum,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('kota.show', $user->id, $user->idRole);
        
        if($check){
            return view('kota.show',[
                'dataProvinsi' => $dataProvinsi,
                'kota' => $kotum,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Kota Master');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit(Kota $kotum)
    {
        $dataProvinsi = DB::table('Provinsi')
            ->where('hapus',0)
            ->get();
        return view('kota.edit',[
            'dataProvinsi' => $dataProvinsi,
            'kota' => $kotum,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('kota.edit', $user->id, $user->idRole);
        
        if($check){
            return view('kota.edit',[
                'dataProvinsi' => $dataProvinsi,
                'kota' => $kotum,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Kota Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kota $kotum)
    {
        $data = $request->collect();

        DB::table('Kota')
        ->where('idKota', $kotum['idKota'])
        ->update(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idProvinsi' => $data['idProvinsi']
            //'keterangan' => $data['keterangan'],
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
    public function destroy(Kota $kotum)
    {
        DB::table('kota')
        ->where('idKota', $kotum['idKota'])
        ->update(array(
            'hapus' => 1,
        )
        );
        return redirect()->route('kota.index')->with('status','Success!!');
    }
}
