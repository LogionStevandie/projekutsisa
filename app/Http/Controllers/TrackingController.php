<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          return view('tracking.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $data = $request->collect();

        $namaDekrip = $this->enkripData($data['namaEnkripsi'], false);

        $data = DB::table('NotaPengiriman')
            ->where('nama', $namaDekrip)
            ->where('hapus',0)
            ->get();
        //dd($data);
         $dataPengirimanJenis = DB::table('pengirimanJenis')
            ->where('hapus', 0)
            ->get();
         $dataBarang = DB::table('barangJenis')
            ->where('hapus',0)
            ->get();

         $dataUser = DB::table('users')
            ->get();
          $dataKota = DB::table('kota')
            ->where('hapus', 0)
            ->get();
        
        //dd($data);
        return view('tracking.detail',[
            'data' => $data,
            'dataPengirimanJenis' => $dataPengirimanJenis,
            'dataBarang' => $dataBarang,
            'dataUser' => $dataUser,
            'dataKota'=>$dataKota
        ]);
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
}
