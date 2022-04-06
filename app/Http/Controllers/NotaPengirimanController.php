<?php

namespace App\Http\Controllers;

use App\Models\NotaPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotaPengirimanController extends Controller
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
            ->where('hapus',0)
            ->get();

        return view('notaPengiriman.index',[
            'data' => $data,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        
        return view('notaPengiriman.tambah',[
            'dataPengirimanJenis' => $dataPengirimanJenis,
            'dataPembayaranJenis' => $dataPembayaranJenis,
            'dataHargaPengiriman' => $dataHargaPengiriman,
            'dataKota' => $dataKota,
            'dataBarang' => $dataBarang,
        ]);
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
        $year = date("Y");
        $month = date("m");

        $kodePengiriman = DB::table('pengirimanJenis')
            ->where('idPengirimanJenis',$data['idPengirimanJenis'])
            ->get();
        
        $dataNota = DB::table('notaPengiriman')
            ->where('nama', 'like', $kodePengiriman[0]->kode.'/'.$year.'/'.$month."/%")
            ->get();
        $dataHarga = DB::table('hargaPengiriman')
            ->where('idHargaPengiriman', $data['idHargaPengiriman'])
            ->get();
        
        $totalIndex = str_pad(strval(count($dataNota) + 1),4,'0',STR_PAD_LEFT);

        $idnota = DB::table('notaPengiriman')->insertGetId(array(
            'nama' => $kodePengiriman[0]->kode.'/'.$year.'/'.$month."/".$totalIndex,
            'keterangan' => $data['keterangan'],//dienkripsi
            'idPengirimanJenis' => $data['idPengirimanJenis'],
            'idPembayaranJenis' => $data['idPembayaranJenis'],
            'idHargaPengiriman' => $data['idHargaPengiriman'],
            'idPelanggan' => $data['idPelanggan'],//belumada
            'tanggalDibuat' => date("Y-m-d h:i:sa"),//belumada
            'proses' => 0,
            )
        ); 

        $totalHarga = 0;
        $totalBerat = 0;

        for($i = 0; $i < count($data['idBarangJenis']); $i++){
            DB::table('notaPengirimanDetail')->insert(array(
                'idNotaPengiriman' => $idnota,
                'idBarangJenis' => $data['idBarangJenis'][$i], //array
                'berat' => $data['beratBarang'][$i],
                )
            ); 
            $totalBerat += $data['beratBarang'][$i];
            $totalHarga += $data['beratBarang'][$i] * $dataHarga->harga;         
        }

        DB::table('notaPengiriman')
            ->where('id', $idnota)
            ->update([
                'totalBerat' =>  $totalBerat,
                'totalHarga' =>  $totalHarga,
        ]);

        return redirect()->route('purchaseRequest.index')->with('status','Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function show(NotaPengiriman $notaPengiriman)
    {
        //
        $data = DB::table('notaPengirimanDetail')
            ->get();

        return view('notaPengiriman.index',[
            'notaPengiriman' => $notaPengiriman,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(NotaPengiriman $notaPengiriman)
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
        
        return view('notaPengiriman.tambah',[
            'dataPengirimanJenis' => $dataPengirimanJenis,
            'dataPembayaranJenis' => $dataPembayaranJenis,
            'dataHargaPengiriman' => $dataHargaPengiriman,
            'dataKota' => $dataKota,
            'dataBarang' => $dataBarang,
            'notaPengiriman' => $notaPengiriman,
            'dataDetail' => $dataDetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotaPengiriman $notaPengiriman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotaPengiriman  $notaPengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotaPengiriman $notaPengiriman)
    {
        //
        DB::table('notaPengiriman')
            ->where('idNotaPengiriman', $notaPengiriman['idNotaPengiriman'])
            ->update(array(
                'hapus' => 1,
            )
        );
        return redirect()->route('notaPengiriman.index')->with('status','Success!!');
    }
}
