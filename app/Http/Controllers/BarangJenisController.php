<?php

namespace App\Http\Controllers;

use App\Models\BarangJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class BarangJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('BarangJenis')->get();
        

        return view('barangJenis.index',[
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
        return view('barangJenis.tambah');
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
        
        DB::table('BarangJenis')
            ->insert(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'keterangan' => $data['keterangan'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('barangJenis.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangJenis  $barangJenis
     * @return \Illuminate\Http\Response
     */
    public function show(BarangJenis $barangJenis)
    {
        //
        return view('barangJenis.detail',[
            'barangJenis' => $barangJenis,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangJenis  $barangJenis
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangJenis $barangJenis)
    {
        //
        return view('barangJenis.edit',[
            'barangJenis' => $barangJenis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangJenis  $barangJenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangJenis $barangJenis)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('BarangJenis')
            ->where('idBarangJenis', $barangJenis['idBarangJenis'])
            ->update(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'keterangan' => $data['keterangan'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('barangJenis.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangJenis  $barangJenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangJenis $barangJenis)
    {
        //
        DB::table('barangJenis')
            ->where('idBarangJenis', $pulau['idBarangJenis'])
            ->update(array(
                'hapus' => 1,
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('barangJenis.index')->with('status','Success!!');
    }
}
