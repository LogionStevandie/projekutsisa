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
        //dd($data);
        //echo $data['barang'][0];
        //echo count($data['jumlah']);
        $year = date("Y");
        $month = date("m");

        /*$getLokasi = DB::table('gudang')
            ->where('gudang.id', '=', $user->idGudang)
            ->get();
        */

        $dataLokasi = DB::table('MGudang')
            ->select('MKota.*','MPerusahaan.cnames as perusahaanCode')
            ->join('MKota', 'MGudang.cidkota', '=', 'MKota.cidkota')
            ->join('MPerusahaan', 'MGudang.cidp', '=', 'MPerusahaan.MPerusahaanID')
            ->where('MGudang.MGudangID', '=', $user->MGudangID)
            ->get();
        
        $dataPermintaan = DB::table('purchase_request')
            ->where('name', 'like', 'NPP/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/%")
            ->get();
        

        $totalIndex = str_pad(strval(count($dataPermintaan) + 1),4,'0',STR_PAD_LEFT);

        $idpr = DB::table('purchase_request')->insertGetId(array(
            'name' => 'NPP/'.$dataLokasi[0]->perusahaanCode.'/'.$dataLokasi[0]->ckode.'/'.$year.'/'.$month."/".$totalIndex,
            'MGudangID' => $data['gudang'],
            'approved' => 0,
            'approvedAkhir' => 0,
            'hapus' => 0,
            'tanggalDibutuhkan' => $data['tanggalDibutuhkan'],
            'tanggalAkhirDibutuhkan' => $data['tanggalAkhir'],
            'jenisProses' => $data['jenisProses'],
            'created_by'=> $user->id,
            'created_on'=> date("Y-m-d h:i:sa"),
            'updated_by'=> $user->id,
            'updated_on'=> date("Y-m-d h:i:sa"),
            )
        ); 

        $totalHarga = 0;

        for($i = 0; $i < count($data['itemId']); $i++){
            DB::table('purchase_request_detail')->insert(array(
                'idPurchaseRequest' => $idpr,
                'jumlah' => $data['itemTotal'][$i],
                'ItemID' => $data['itemId'][$i],
                'harga' => $data['itemHarga'][$i],
                'keterangan_jasa' => $data['itemKeterangan'][$i],
                )
            ); 
            $totalHarga += $data['itemHarga'][$i] * $data['itemTotal'][$i];
            /*if(isset($data['barang'][$i])){
                DB::table('purchase_request_detail')->insert(array(
                    'idPurchaseRequest' => $idpr,
                    'jumlah' => $data['jumlah'][$i],
                    'ItemID' => $data['barang'][$i],
                    'jasa' => 0,
                    'harga' => $data['harga'][$i],
                    )
               ); 
            }
            elseif(isset($data['jasa'][$i])){
                DB::table('purchase_request_detail')->insert(array(
                    'idPurchaseRequest' => $idpr,
                    'jasa' => 1,
                    'jumlah' =>1,
                    'keterangan_jasa' => $data['keterangan'][$i],
                    'harga' => $data['harga'][$i],
                    )
               ); 
            }*/
            
        }

        DB::table('purchase_request')
            ->where('id', $idpr)
            ->update([
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
