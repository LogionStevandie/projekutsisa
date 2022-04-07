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

        $user = Auth::user();
        $check = $this->checkAccess('pembayaranJenis.index', $user->id, $user->idRole);
        
        if($check){
            return view('pembayaranJenis.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pembayaran Jenis');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $user = Auth::user();
        $check = $this->checkAccess('pembayaranJenis.create', $user->id, $user->idRole);
        
        if($check){
            return view('pembayaranJenis.tambah');
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pembayaran Jenis');
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
    public function show(PembayaranJenis $pembayaranJeni)
    {
        //


        $user = Auth::user();
        $check = $this->checkAccess('pembayaranJenis.show', $user->id, $user->idRole);
        
        if($check){
            return view('pembayaranJenis.show',[
                'pembayaranJenis' => $pembayaranJeni,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pembayaran Jenis');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembayaranJenis  $pembayaranJenis
     * @return \Illuminate\Http\Response
     */
    public function edit(PembayaranJenis $pembayaranJeni)
    {
        //

        $user = Auth::user();
        $check = $this->checkAccess('pembayaranJenis.edit', $user->id, $user->idRole);
        
        if($check){
            return view('pembayaranJenis.edit',[
                'pembayaranJenis' => $pembayaranJeni,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pembayaran Jenis');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembayaranJenis  $pembayaranJenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembayaranJenis $pembayaranJeni)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('PembayaranJenis')
            ->where('idPembayaranJenis', $pembayaranJeni['idPembayaranJenis'])
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
    public function destroy(PembayaranJenis $pembayaranJeni)
    {
        //
        DB::table('PembayaranJenis')
            ->where('idPembayaranJenis', $pembayaranJeni['idPembayaranJenis'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('pembayaranJenis.index')->with('status','Success!!');
    }
}
