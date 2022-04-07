<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = DB::table('users')
            ->select('users.*','role.nama as namaRole')
            ->leftjoin('role', 'users.idRole', '=','role.idRole')
            ->get();
        return view('userRole.index',[
            'users' => $users,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('userRole.index', $user->id, $user->idRole);
        
        if($check){
            return view('userRole.index',[
                'users' => $users,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam User Role Master');
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $userRole)
    {
        //
        $role = DB::table('role')
            ->where('hapus',0)
            ->get();

        return view('userRole.edit',[
            'user' => $userRole,
            'role' => $role,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('userRole.edit', $user->id, $user->idRole);
        
        if($check){
            return view('userRole.edit',[
                'user' => $userRole,
                'role' => $role,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam User Role Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $userRole)
    {
        //
        $data = $request->collect();
        //$user = Auth::user();
      //  dd($userRole);
        DB::table('users')
            ->where('id', $userRole['id'])
            ->update(array(
                'idRole' => $data['role'],
            )
        );
        return redirect()->route('userRole.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
