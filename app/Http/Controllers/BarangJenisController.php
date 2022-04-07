<?php

namespace App\Http\Controllers;

use App\Models\BarangJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangJenisController extends Controller
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
        $data = DB::table('barangJenis')
            ->where('hapus',0)
            ->get();
        

        $user = Auth::user();
        $check = $this->checkAccess('barangJenis.index', $user->id, $user->idRole);
        
        if($check){
            return view('barangJenis.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Barang Jenis Master');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Auth::user();
        $check = $this->checkAccess('barangJenis.create', $user->id, $user->idRole);
        
        if($check){
            return view('barangJenis.tambah');
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Barang Jenis Master');
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
        
        DB::table('barangJenis')
            ->insert(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'keterangan' => $data['keterangan'],
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
    public function show(BarangJenis $barangJeni)
    {
        //

        $user = Auth::user();
        $check = $this->checkAccess('barangJenis.show', $user->id, $user->idRole);
        
        if($check){
            return view('barangJenis.show',[
                'barangJenis' => $barangJeni,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Barang Jenis Master');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangJenis  $barangJenis
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangJenis $barangJeni)
    {
        //

        $user = Auth::user();
        $check = $this->checkAccess('barangJenis.edit', $user->id, $user->idRole);
        
        if($check){
            return view('barangJenis.edit',[
                'barangJenis' => $barangJeni,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Barang Jenis Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangJenis  $barangJenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangJenis $barangJeni)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('barangJenis')
            ->where('idBarangJenis', $barangJeni['idBarangJenis'])
            ->update(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'keterangan' => $data['keterangan'],
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
    public function destroy(BarangJenis $barangJeni)
    {
        //
        $user = Auth::user();
        DB::table('barangJenis')
            ->where('idBarangJenis', $barangJeni['idBarangJenis'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('barangJenis.index')->with('status','Success!!');
    }
}
