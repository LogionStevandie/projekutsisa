<?php

namespace App\Http\Controllers;

use App\Models\PengirimanJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengirimanJenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('PengirimanJenis')->get();
        

        return view('PengirimanJenis.index',[
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
        return view('pengirimanJenis.tambah');
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
        
        DB::table('PengirimanJenis')
            ->insert(array(
                'nama' => $data['nama'],
                'keterangan' => $data['keterangan'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('pengirimanJenis.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengirimanJenis  $pengirimanJenis
     * @return \Illuminate\Http\Response
     */
    public function show(PengirimanJenis $pengirimanJenis)
    {
        //
        return view('pengirimanJenis.detail',[
            'pengirimanJenis' => $pengirimanJenis,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengirimanJenis  $pengirimanJenis
     * @return \Illuminate\Http\Response
     */
    public function edit(PengirimanJenis $pengirimanJenis)
    {
        //
        return view('pengirimanJenis.edit',[
            'pengirimanJenis' => $pengirimanJenis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengirimanJenis  $pengirimanJenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengirimanJenis $pengirimanJenis)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('PengirimanJenis')
            ->where('idPengirimanJenis', $pengirimanJenis['idPengirimanJenis'])
            ->update(array(
                'nama' => $data['nama'],
                'keterangan' => $data['keterangan'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('pengirimanJenis.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengirimanJenis  $pengirimanJenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengirimanJenis $pengirimanJenis)
    {
        //
        DB::table('PengirimanJenis')
        ->where('idPengirimanJenis', $pengirimanJenis['idPengirimanJenis'])
        ->update(array(
            'hapus' => 1,
            'UpdatedBy'=> $user->id,
            'UpdatedOn'=> date("Y-m-d h:i:sa"),
        )
    );
    return redirect()->route('pengirimanJenis.index')->with('status','Success!!');
    
    }
}
