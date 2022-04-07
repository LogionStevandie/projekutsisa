<?php

namespace App\Http\Controllers;

use App\Models\HargaPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HargaPengirimanController extends Controller
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
        //
        $data = DB::table('hargaPengiriman')
            ->select('hargaPengiriman.*','pengirimanJenis.nama as namaPengiriman', 'pengirimanJenis.kode as kodePengiriman')
            ->join('pengirimanJenis','hargaPengiriman.idPengirimanJenis','=','pengirimanJenis.idPengirimanJenis')
            ->where('hargaPengiriman.hapus',0)
            ->get();
        $dataKota = DB::table('kota')
            ->where('hapus',0)
            ->get();
        $dataPengirimanJenis = DB::table('PengirimanJenis')
            ->where('hapus',0)
            ->get();
    
        return view('hargaPengiriman.index',[
            'data' => $data,
            'dataKota' => $dataKota,
            'dataPengirimanJenis'=>$dataPengirimanJenis
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('hargaPengiriman.index', $user->id, $user->idRole);
        
        if($check){
            return view('hargaPengiriman.index',[
                'data' => $data,
                'dataKota' => $dataKota,
                'dataPengirimanJenis'=>$dataPengirimanJenis
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Harga Pengiriman Master');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataKota = DB::table('kota')
            ->select('kota.*')
            ->where('hapus',0)
            ->get();
        $dataPengirimanJenis = DB::table('PengirimanJenis')
            ->where('hapus',0)
            ->get();
        $dataPembayaran = DB::table('hargaPengiriman')
            ->where('hargaPengiriman.hapus',0)
            ->get();

        return view('hargaPengiriman.tambah',[
            'dataKota' => $dataKota,
            'dataPengirimanJenis'=>$dataPengirimanJenis,
            'dataPembayaran'=>$dataPembayaran,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('hargaPengiriman.create', $user->id, $user->idRole);
        
        if($check){
            return view('hargaPengiriman.tambah',[
                'dataKota' => $dataKota,
                'dataPengirimanJenis'=>$dataPengirimanJenis,
                'dataPembayaran'=>$dataPembayaran,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Harga Pengiriman Master');
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
        //
        $data = $request->collect();
        
        DB::table('HargaPengiriman')
            ->insert(array(
                'harga' => $data['harga'],
                'idKotaAwal' => $data['idKotaAwal'],
                'idKotaTujuan' => $data['idKotaTujuan'],
                'idPengirimanJenis' => $data['idPengirimanJenis']
            )
        );
        return redirect()->route('hargaPengiriman.index')->with('status','Success!!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HargaPengiriman  $hargaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function show(HargaPengiriman $hargaPengiriman)
    {
        //
        $dataKota = DB::table('kota')
        ->where('hapus',0)
        ->get();
        $dataPengirimanJenis = DB::table('PengirimanJenis')
        ->where('hapus',0)
        ->get();

        return view('hargaPengiriman.show',[
            'dataKota' => $dataKota,
            'dataPengirimanJenis'=>$dataPengirimanJenis,
            'hargaPengiriman'=>$hargaPengiriman
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('hargaPengiriman.show', $user->id, $user->idRole);
        
        if($check){
            return view('hargaPengiriman.show',[
                'dataKota' => $dataKota,
                'dataPengirimanJenis'=>$dataPengirimanJenis,
                'hargaPengiriman'=>$hargaPengiriman
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Harga Pengiriman Master');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HargaPengiriman  $hargaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(HargaPengiriman $hargaPengiriman)
    {
        //
        $dataKota = DB::table('kota')
        ->where('hapus',0)
        ->get();
        $dataPengirimanJenis = DB::table('PengirimanJenis')
        ->where('hapus',0)
        ->get();

        return view('hargaPengiriman.edit',[
            'dataKota' => $dataKota,
            'dataPengirimanJenis'=>$dataPengirimanJenis,
            'hargaPengiriman'=>$hargaPengiriman
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('hargaPengiriman.edit', $user->id, $user->idRole);
        
        if($check){
            return view('hargaPengiriman.edit',[
                'dataKota' => $dataKota,
                'dataPengirimanJenis'=>$dataPengirimanJenis,
                'hargaPengiriman'=>$hargaPengiriman
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Harga Pengiriman Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HargaPengiriman  $hargaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HargaPengiriman $hargaPengiriman)
    {
        //
        $data = $request->collect();
         DB::table('HargaPengiriman')
        ->where('idHargaPengiriman', $hargaPengiriman['idHargaPengiriman'])
        ->update(array(
            'harga' => $data['harga'],
            //'idKotaAwal' => $data['idKotaAwal'],
            //'idKotaTujuan' => $data['idKotaTujuan'],
            //'idPengirimanJenis' => $data['idPengirimanJenis']
        )
        );
        return redirect()->route('hargaPengiriman.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HargaPengiriman  $hargaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(HargaPengiriman $hargaPengiriman)
    {
        //
        DB::table('HargaPengiriman')
            ->where('idHargaPengiriman', $hargaPengiriman['idHargaPengiriman'])
            ->update(array(
            'hapus' => 1,
            )
        );
        return redirect()->route('hargaPengiriman.index')->with('status','Success!!');
    }
}
