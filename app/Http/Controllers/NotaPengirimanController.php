<?php

namespace App\Http\Controllers;

use App\Models\NotaPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotaPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('notaPengiriman')
            ->where('hapus',0)
            ->get();

        return view('notaPengiriman.index',[
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
        //
        $dataPengirimanJenis = DB::table('pengirimanJenis')
            ->where('hapus', 0)
            ->get();

        $dataPembayaranJenis = DB::table('pembayaranJenis')
            ->where('hapus', 0)
            ->get();

        $dataKota = DB::table('kota')
            ->where('hapus', 0)
            ->get();
        
        $dataBarang = DB::table('barangJenis')
            ->where('hapus',0)
            ->get();
        
        $dataHargaPengiriman = DB::table('HargaPengiriman')
            ->where('hapus',0)
            ->get();
        
        return view('notaPengiriman.tambah',[
            'dataPengirimanJenis' => $dataPengirimanJenis,
            'dataPembayaranJenis' => $dataPembayaranJenis,
            'dataHargaPengiriman' => $dataHargaPengiriman,
            'dataKota' => $dataKota,
            'dataBarang' => $dataBarang,
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPengiriman $notaPengiriman)
    {
        //
        $data = DB::table('notaPengirimanDetail')
            ->get();

        return view('notaPengiriman.index',[
            'notaPengiriman' => $notaPengiriman,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPengiriman $notaPengiriman)
    {
        //
        $dataPengirimanJenis = DB::table('pengirimanJenis')
            ->where('hapus', 0)
            ->get();

        $dataPembayaranJenis = DB::table('pembayaranJenis')
            ->where('hapus', 0)
            ->get();

        $dataKota = DB::table('kota')
            ->where('hapus', 0)
            ->get();
        
        $dataBarang = DB::table('barangJenis')
            ->where('hapus',0)
            ->get();
        
        $dataHargaPengiriman = DB::table('HargaPengiriman')
            ->where('hapus',0)
            ->get();

        $dataDetail = DB::table('notaPengirimanDetail')
            ->get();
        
        return view('notaPengiriman.tambah',[
            'dataPengirimanJenis' => $dataPengirimanJenis,
            'dataPembayaranJenis' => $dataPembayaranJenis,
            'dataHargaPengiriman' => $dataHargaPengiriman,
            'dataKota' => $dataKota,
            'dataBarang' => $dataBarang,
            'notaPengiriman' => $notaPengiriman,
            'dataDetail' => $dataDetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPengiriman $notaPengiriman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPengiriman $notaPengiriman)
    {
        //
        DB::table('notaPengiriman')
            ->where('idNotaPengiriman', $notaPengiriman['idNotaPengiriman'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('notaPengiriman.index')->with('status','Success!!');
    }
}
