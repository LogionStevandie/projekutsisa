<?php

namespace App\Http\Controllers;

use App\Models\Pulau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PulauController extends Controller
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
        $data = DB::table('Pulau')->where('hapus',0)->get();


        $user = Auth::user();
        $check = $this->checkAccess('pulau.index', $user->id, $user->idRole);
        
        if($check){
            return view('pulau.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pulau Master');
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
        $check = $this->checkAccess('pulau.create', $user->id, $user->idRole);
        
        if($check){
            return view('pulau.tambah');
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pulau Master');
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
        
        DB::table('Pulau')
            ->insert(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
            )
        );
        return redirect()->route('pulau.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pulau  $pulau
     * @return \Illuminate\Http\Response
     */
    public function show(Pulau $pulau)
    {
        //

        $user = Auth::user();
        $check = $this->checkAccess('pulau.show', $user->id, $user->idRole);
        
        if($check){
            return view('pulau.show',[
                'pulau' => $pulau,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pulau Master');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pulau  $pulau
     * @return \Illuminate\Http\Response
     */
    public function edit(Pulau $pulau)
    {
        //

        $user = Auth::user();
        $check = $this->checkAccess('pulau.edit', $user->id, $user->idRole);
        
        if($check){
            return view('pulau.edit',[
                'pulau' => $pulau,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Pulau Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pulau  $pulau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pulau $pulau)
    {
        //
        $data = $request->collect();
        
        DB::table('Pulau')
            ->where('idPulau', $pulau['idPulau'])
            ->update(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
            )
        );
        return redirect()->route('pulau.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pulau  $pulau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pulau $pulau)
    {
        //
        $user = Auth::user();
        DB::table('Pulau')
            ->where('idPulau', $pulau['idPulau'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('pulau.index')->with('status','Success!!');
    }
}
