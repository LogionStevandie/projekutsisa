<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
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
        $data = DB::table('Role')->where('hapus',0)->get();
        

        return view('role.index',[
            'data' => $data,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('role.index', $user->id, $user->idRole);
        
        if($check){
            return view('role.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Role Master');
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
        return view('role.tambah');

        $user = Auth::user();
        $check = $this->checkAccess('role.create', $user->id, $user->idRole);
        
        if($check){
            return view('role.tambah');
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Role Master');
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
        
        DB::table('Role')
            ->insert(array(
                'nama' => $data['nama'],
                'keterangan' => $data['keterangan'],
            )
        );
        return redirect()->route('role.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        return view('role.show', [
            'role' => $role
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('role.show', $user->id, $user->idRole);
        
        if($check){
            return view('role.show', [
                'role' => $role
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Role Master');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('role.edit',[
            'role' => $role,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('role.edit', $user->id, $user->idRole);
        
        if($check){
            return view('role.edit',[
                'role' => $role,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Role Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('Role')
            ->where('idRole', $role['idRole'])
            ->update(array(
                'nama' => $data['nama'],
                'keterangan' => $data['keterangan'],
            )
        );
        return redirect()->route('role.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        DB::table('Role')
            ->where('idRole', $role['idRole'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('role.index')->with('status','Success!!');
    }
}
