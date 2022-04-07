<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RoleAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('Role')->where('hapus',0)->get();
        $dataAccess = DB::table('roleAccess')
            ->leftjoin('menu', 'roleAccess.idMenu', '=', 'menu.idMenu')
            ->get();

        return view('roleAccess.index',[
            'data' => $data,
            'dataAccess' => $dataAccess,    
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('roleAccess.index', $user->id, $user->idRole);
        
        if($check){
            return view('roleAccess.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Role Access Master');
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
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $rolesAkse)
    {
        //
        $dataMenu = DB::table('menu')
            ->get();
        
        $dataAccess = DB::table('roleaccess')
            ->where('idRole', $rolesAkse->idRole)
            ->get();

        return view('roleAccess.edit',[
            'role' => $rolesAkse,
            'dataMenu' => $dataMenu,
            'dataAccess' => $dataAccess,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('roleAccess.edit', $user->id, $user->idRole);
        
        if($check){
            return view('roleAccess.edit',[
                'role' => $rolesAkse,
                'dataMenu' => $dataMenu,
                'dataAccess' => $dataAccess,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Role Access Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $rolesAkse)
    {
        //
        $data=$request->collect();
        dd($data);
        $dataRoleAccess = DB::table('roleaccess')
            ->where('idRole', $rolesAkse->idRole)
            ->get();

        if(count($dataRoleAccess) > count($data['menu'])){
            DB::table('MGudangValues')
                ->where('idRole','=',$rolesAkse->idRole)
                ->delete();

            for($i = 0; $i < count($data['menu']); $i++){
            DB::table('MGudangValues')
                ->insert(array(
                    'idRole' => $rolesAkse->idRole,
                    'idMenu' => $data['menu'][$i],
                    )
                ); 
            }
        }
        else{
            for($i = 0; $i < count($data['menu']); $i++){
                if($i < count($dataRoleAccess)){
                    DB::table('MGudangValues')
                        ->where('MGudangID', $rolesAkse->idRole)
                        ->update(array(
                            'idMenu' => $data['menu'][$i],
                        )
                    );
                }
                else{
                    DB::table('MGudangValues')
                        ->insert(array(
                            'idRole' => $rolesAkse->idRole,
                            'idMenu' => $data['gudangAreaSimpan'][$i],
                        )
                    ); 
                }
            }
        }
        return redirect()->route('roleAccess.index')->with('status','Success!!');
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
    }
}
