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

        $user = Auth::user();
        $check = $this->checkAccess('roleAccess.index', $user->id, $user->idRole);
        
        if($check){
            return view('roleAccess.index',[
                'data' => $data,
                'dataAccess'=>$dataAccess
                 
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
    public function edit(Role $roleAccess)
    {
        //
        $dataMenu = DB::table('menu')
            ->where('hapus',0)
            ->get();
        
        $dataAccess = DB::table('roleaccess')
            ->rightjoin('menu', 'roleaccess.idMenu', '=', 'menu.idMenu')
            ->where('roleaccess.idRole',$roleAccess->idRole)
            ->get();

        $user = Auth::user();
        $check = $this->checkAccess('roleAccess.edit', $user->id, $user->idRole);
        
        if($check){
            return view('roleAccess.edit',[
                'role' => $roleAccess,
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
    public function update(Request $request, Role $roleAccess)
    {
        //
        $data=$request->collect();
        //dd($data);
        $dataRoleAccess = DB::table('roleaccess')
            ->where('idRole', $roleAccess->idRole)
            ->get();

        //if(count($dataRoleAccess) > count($data['menu'])){
            DB::table('roleaccess')
                ->where('idRole','=',$roleAccess->idRole)
                ->delete();

            for($i = 0; $i < count($data['menu']); $i++){
            DB::table('roleaccess')
                ->insert(array(
                    'idRole' => $roleAccess->idRole,
                    'idMenu' => $data['menu'][$i],
                    )
                ); 
            }
        //}
        /*else{
            for($i = 0; $i < count($data['menu']); $i++){
                if($i < count($dataRoleAccess)){
                    DB::table('roleaccess')
                        ->where('idRole', $roleAccess->idRole)
                        ->update(array(
                            'idMenu' => $data['menu'][$i],
                        )
                    );
                }
                else{
                    DB::table('roleaccess')
                        ->insert(array(
                            'idRole' => $roleAccess->idRole,
                            'idMenu' => $data['menu'][$i],
                        )
                    ); 
                }
            }
        }*/
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
