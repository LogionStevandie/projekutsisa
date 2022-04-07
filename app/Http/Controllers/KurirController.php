<?php

namespace App\Http\Controllers;

use App\Models\NotaPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('notaPengiriman')
            ->select('notaPengiriman.*','users.name as pelanggan')
            ->join('users','notaPengiriman.idPelanggan','=','users.id')
            ->where('hapus',0)
            ->where('prosesPengiriman',2)
            ->get();

        $dataHargaPengiriman = DB::table('hargaPengiriman')
            ->where('hapus', 0)
            ->get();
        $dataKota = DB::table('kota')
            ->where('hapus', 0)
            ->get();

        return view('kurir.index',[
            'data' => $data,
            'dataHargaPengiriman' => $dataHargaPengiriman,
            'dataKota' => $dataKota,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('kurir.index', $user->id, $user->idRole);
        
        if($check){
            return view('kurir.index',[
                'data' => $data,
                'dataHargaPengiriman' => $dataHargaPengiriman,
                'dataKota' => $dataKota,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Kurir');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPengiriman $kurir)
    {
        //
        $dataPengirimanJenis = DB::table('pengirimanJenis')
            ->where('hapus', 0)
            ->get();

        $dataPembayaranJenis = DB::table('pembayaranJenis')
            ->where('hapus', 0)
            ->get();

        $dataKota = DB::table('kota')
            ->where('hapus', 0)
            ->get();
        
        $dataBarang = DB::table('barangJenis')
            ->where('hapus',0)
            ->get();
        
        $dataHargaPengiriman = DB::table('HargaPengiriman')
            ->where('hapus',0)
            ->get();

        $dataDetail = DB::table('notaPengirimanDetail')
            ->get();
         $dataUser = DB::table('users')
            ->get();
        
        if($kurir->prosesPengiriman == 2 && ($kurir->prosesKurir == 0 || $kurir->prosesKurir == 1)){
            return view('kurir.edit',[
                'dataPengirimanJenis' => $dataPengirimanJenis,
                'dataPembayaranJenis' => $dataPembayaranJenis,
                'dataHargaPengiriman' => $dataHargaPengiriman,
                'dataKota' => $dataKota,
                'dataBarang' => $dataBarang,
                'notaPengiriman' => $kurir,
                'dataDetail' => $dataDetail,
                'dataUser' => $dataUser,
            ]);
        }else{
            return redirect()->route('kurir.index')->with('status','File tidak dapat diedit');         
        }

        $user = Auth::user();
        $check = $this->checkAccess('kurir.edit', $user->id, $user->idRole);
        
        if($check){
            if($kurir->prosesPengiriman == 2 && ($kurir->prosesKurir == 0 || $kurir->prosesKurir == 1)){
                return view('kurir.edit',[
                    'dataPengirimanJenis' => $dataPengirimanJenis,
                    'dataPembayaranJenis' => $dataPembayaranJenis,
                    'dataHargaPengiriman' => $dataHargaPengiriman,
                    'dataKota' => $dataKota,
                    'dataBarang' => $dataBarang,
                    'notaPengiriman' => $kurir,
                    'dataDetail' => $dataDetail,
                    'dataUser' => $dataUser,
                ]);
            }else{
                return redirect()->route('kurir.index')->with('status','File tidak dapat diedit');         
            }
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Kurir');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPengiriman $kurir)
    {
        //
        $user = Auth::user();
        if($kurir->prosesPengiriman == "2" && $kurir->prosesKurir == "0"){
            //barang baru dikirim
            DB::table('notaPengiriman')
                ->where('idNotaPengiriman', $kurir['idNotaPengiriman'])
                ->update(array(
                    'prosesKurir' => $user->id,
                    'prosesKurir' => 1,
                )
            );
        }
        elseif($kurir->prosesPengiriman == "2" && $kurir->prosesKurir == "1"){
            //barang sudah sampai gudang pengiriman
            DB::table('notaPengiriman')
                ->where('idNotaPengiriman', $kurir['idNotaPengiriman'])
                ->update(array(
                    'prosesKurir' => 2,
                )
            );
        }
        return redirect()->route('kurir.index')->with('status','Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
