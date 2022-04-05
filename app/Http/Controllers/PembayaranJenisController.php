<?php

namespace App\Http\Controllers;

use App\Models\PembayaranJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembayaranJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('PembayaranJenis')->where('hapus',0)->get();
        

        return view('pembayaranJenis.index',[
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
        return view('pembayaranJenis.tambah');
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
        $user = Auth::user();
        
        DB::table('PembayaranJenis')
            ->insert(array(
                'nama' => $data['nama'],
                'keterangan' => $data['keterangan'],
            )
        );
        return redirect()->route('pembayaranJenis.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembayaranJenis  $pembayaranJenis
     * @return \Illuminate\Http\Response
     */
    public function show(PembayaranJenis $pembayaranJenis)
    {
        //
        return view('pembayaranJenis.detail',[
            'pembayaranJenis' => $pembayaranJenis,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembayaranJenis  $pembayaranJenis
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranJenis $pembayaranJenis)
    {
        //
        return view('pembayaranJenis.edit',[
            'pembayaranJenis' => $pembayaranJenis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembayaranJenis  $pembayaranJenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranJenis $pembayaranJenis)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('PembayaranJenis')
            ->where('idPembayaranJenis', $pembayaranJenis['idPembayaranJenis'])
            ->update(array(
                'nama' => $data['nama'],
                'keterangan' => $data['keterangan'],
            )
        );
        return redirect()->route('pembayaranJenis.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembayaranJenis  $pembayaranJenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembayaranJenis $pembayaranJenis)
    {
        //
        DB::table('PembayaranJenis')
            ->where('idPembayaranJenis', $pembayaranJenis['idPembayaranJenis'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('pembayaranJenis.index')->with('status','Success!!');
    }
}
