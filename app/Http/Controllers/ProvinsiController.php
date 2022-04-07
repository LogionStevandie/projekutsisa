<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('Provinsi')
            ->select('Provinsi.*','Pulau.nama as namaPulau','Pulau.kode as kodePulau')
            ->join('Pulau', 'Provinsi.idPulau', '=', 'pulau.idPulau')
            ->where('Provinsi.hapus',0)
            ->get();
            
        return view('provinsi.index',[
            'data' => $data,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('provinsi.index', $user->id, $user->idRole);
        
        if($check){
            return view('provinsi.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Provinsi Master');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataPulau = DB::table('pulau')
            ->where('hapus','0')
            ->get();
        return view('provinsi.tambah',[
            'dataPulau' => $dataPulau,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('provinsi.create', $user->id, $user->idRole);
        
        if($check){
            return view('provinsi.tambah',[
                'dataPulau' => $dataPulau,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Provinsi Master');
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
        DB::table('Provinsi')
            ->insert(array(
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'idPulau' => $data['idPulau'],
                //'CreatedBy'=> $user->id,
                //'CreatedOn'=> date("Y-m-d h:i:sa"),
                //'UpdatedBy'=> $user->id,
                //'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
        return redirect()->route('provinsi.index')->with('status','Success!!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $provinsi)
    {
        //
        $dataPulau = DB::table('pulau')
            ->where('hapus','0')
            ->get();
        return view('provinsi.show',[
            'dataPulau' => $dataPulau,
            'provinsi' => $provinsi,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('provinsi.show', $user->id, $user->idRole);
        
        if($check){
            return view('provinsi.show',[
                'dataPulau' => $dataPulau,
                'provinsi' => $provinsi,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Provinsi Master');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Provinsi $provinsi)
    {
        //
        $dataPulau = DB::table('pulau')
            ->where('hapus','0')
            ->get();
        return view('provinsi.edit',[
            'dataPulau' => $dataPulau,
            'provinsi' => $provinsi,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('provinsi.edit', $user->id, $user->idRole);
        
        if($check){
            return view('provinsi.edit',[
                'dataPulau' => $dataPulau,
                'provinsi' => $provinsi,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Provinsi Master');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        $data = $request->collect();   
        $user = Auth::user();
        DB::table('Provinsi')
        ->where('idProvinsi', $provinsi['idProvinsi'])
        ->update(array(
            'nama' => $data['nama'],
            'kode' => $data['kode'],
            'idPulau' => $data['idPulau'],
          //'keterangan' => $data['keterangan'],
        )
        );
        return redirect()->route('provinsi.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
         
        $user = Auth::user();
        DB::table('Provinsi')
        ->where('idProvinsi', $provinsi['idProvinsi'])
        ->update(array(
            'hapus' => 1,
        )
    );
    return redirect()->route('provinsi.index')->with('status','Success!!');
    }
}
