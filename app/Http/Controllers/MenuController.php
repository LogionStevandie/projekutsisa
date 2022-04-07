<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
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
        $data = DB::table('Menu')->where('hapus',0)->get();
        


        $user = Auth::user();
        $check = $this->checkAccess('menu.index', $user->id, $user->idRole);
        
        if($check){
            return view('menu.index',[
                'data' => $data,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Menu Master');
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
        $check = $this->checkAccess('menu.create', $user->id, $user->idRole);
        
        if($check){
            return view('menu.tambah');
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Menu Master');
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
        $user = Auth::user();
        
        DB::table('Menu')
            ->insert(array(
                'nama' => $data['nama'],
                'url' => $data['url'],
                'keterangan' => $data['keterangan'],
            )
        );
        return redirect()->route('menu.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {

        $user = Auth::user();
        $check = $this->checkAccess('menu.show', $user->id, $user->idRole);
        
        if($check){
            return view('menu.show',[
                'menu' => $menu,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Menu Master');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {

        $user = Auth::user();
        $check = $this->checkAccess('menu.edit', $user->id, $user->idRole);
        
        if($check){
            return view('menu.edit',[
                'menu' => $menu,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Menu Master');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('Menu')
            ->where('idMenu', $menu['idMenu'])
            ->update(array(
                'nama' => $data['nama'],
                'url' => $data['url'],
                'keterangan' => $data['keterangan'],
            )
        );
        return redirect()->route('menu.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        DB::table('Menu')
        ->where('idMenu', $menu['idMenu'])
        ->update(array(
            'hapus' => 1,
        )
    );
    return redirect()->route('menu.index')->with('status','Success!!');
    }
}
