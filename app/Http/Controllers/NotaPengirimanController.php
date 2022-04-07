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
            ->select('notaPengiriman.*','users.name as pelanggan')
            ->join('users','notaPengiriman.idPelanggan','=','users.id')
            ->where('hapus',0)
            ->get();

        $dataHargaPengiriman = DB::table('hargaPengiriman')
            ->where('hapus', 0)
            ->get();
        $dataKota = DB::table('kota')
            ->where('hapus', 0)
            ->get();


        $user = Auth::user();
        $check = $this->checkAccess('notaPengiriman.index', $user->id, $user->idRole);
        
        if($check){
            return view('notaPengiriman.index',[
                'data' => $data,
                'dataHargaPengiriman' => $dataHargaPengiriman,
                'dataKota' => $dataKota,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Nota Pengiriman');
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

        $dataUser = DB::table('users')
            ->get();
        

        $user = Auth::user();
        $check = $this->checkAccess('notaPengiriman.create', $user->id, $user->idRole);
        
        if($check){
            return view('notaPengiriman.tambah',[
                'dataPengirimanJenis' => $dataPengirimanJenis,
                'dataPembayaranJenis' => $dataPembayaranJenis,
                'dataHargaPengiriman' => $dataHargaPengiriman,
                'dataKota' => $dataKota,
                'dataBarang' => $dataBarang,
                'dataUser' => $dataUser,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Nota Pengiriman');
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
        $year = date("Y");
        $month = date("m");
        //dd($data);
        $kodePengiriman = DB::table('pengirimanJenis')
            ->where('idPengirimanJenis',$data['idPengirimanJenis'])
            ->get();
        
        $dataNota = DB::table('notaPengiriman')
            ->where('nama', 'like', $kodePengiriman[0]->kode.'/'.$year.'/'.$month."/%")
            ->get();


        /*$dataHarga = DB::table('hargaPengiriman')
            ->where('idHargaPengiriman', $data['idHargaPengiriman'])
            ->get();
        */
        $totalIndex = str_pad(strval(count($dataNota) + 1),4,'0',STR_PAD_LEFT);

        $namaNota = $kodePengiriman[0]->kode.'/'.$year.'/'.$month."/".$totalIndex;

        $enkripNamaNota = $this->enkripData($namaNota, true);

        $idHargaPengiriman = DB::table('hargaPengiriman')
            ->where('idKotaAwal', $data['idKotaAwal'])
            ->where('idKotaTujuan', $data['idKotaTujuan'])
            ->where('idPengirimanJenis', $data['idPengirimanJenis'])
            ->get();
        //dd($data['hargaTotal'] * $data['berat']);
        DB::table('notaPengiriman')->insert(array(
            'nama' => $namaNota,
            'namaEnkripsi' => $enkripNamaNota,//dienkripsi
            'keterangan' => $data['keterangan'],
            'idPengirimanJenis' => $data['idPengirimanJenis'],
            'idPembayaranJenis' => $data['idPembayaranJenis'],
            'idHargaPengiriman' => $idHargaPengiriman[0]->idHargaPengiriman,
            'totalBerat' =>  $data['berat'],
            'totalHarga' =>  $data['hargaTotal'] * $data['berat'],
            //'idKurir' =>  $data['idKurir'],
            'prosesPengiriman' => 0,
            'prosesKurir' => 0,
            'idBarangJenis' => $data['idBarangJenis'],//
            'idPelanggan' => $data['idPelanggan'],//
            'tanggalDibuat' => date("Y-m-d h:i:s"),//
            'alamat' => $data['alamat'],        
            )
        ); 


        /*for($i = 0; $i < count($data['idBarangJenis']); $i++){
            DB::table('notaPengirimanDetail')->insert(array(
                'idNotaPengiriman' => $idnota,
                'idBarangJenis' => $data['idBarangJenis'][$i], //array
                'berat' => $data['beratBarang'][$i],
                )
            ); 
            $totalBerat += $data['beratBarang'][$i];
            $totalHarga += $data['beratBarang'][$i] * $dataHarga->harga;         
        }
        */

        return redirect()->route('notaPengiriman.index')->with('status','Success!!');
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

        $dataUser = DB::table('users')
            ->get();

        $user = Auth::user();
        $check = $this->checkAccess('notaPengiriman.show', $user->id, $user->idRole);
        
        if($check){
            return view('notaPengiriman.show',[
                'notaPengiriman' => $notaPengiriman,
                'dataPengirimanJenis' => $dataPengirimanJenis,
                'dataPembayaranJenis' => $dataPembayaranJenis,
                'dataKota' => $dataKota,
                'dataBarang' => $dataBarang,
                'dataHargaPengiriman' => $dataHargaPengiriman,
                'dataUser' => $dataUser,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Nota Pengiriman');
        }
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
         $dataUser = DB::table('users')
            ->get();
        

        $user = Auth::user();
        $check = $this->checkAccess('notaPengiriman.edit', $user->id, $user->idRole);
        
        if($check){
            if($notaPengiriman->proses == 0){
                return view('notaPengiriman.edit',[
                    'dataPengirimanJenis' => $dataPengirimanJenis,
                    'dataPembayaranJenis' => $dataPembayaranJenis,
                    'dataHargaPengiriman' => $dataHargaPengiriman,
                    'dataKota' => $dataKota,
                    'dataBarang' => $dataBarang,
                    'notaPengiriman' => $notaPengiriman,
                    'dataDetail' => $dataDetail,
                    'dataUser' => $dataUser,
                ]);
            }else{
                return redirect()->route('notaPengiriman.index')->with('status','File tidak dapat diedit');         
            }
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Nota Pengiriman');
        }
        
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
        //
        $data = $request->collect();
        $user = Auth::user();
        $year = date("Y");
        $month = date("m");

        $idHargaPengiriman = DB::table('hargaPengiriman')
            ->where('idKotaAwal', $data['idKotaAwal'])
            ->where('idKotaTujuan', $data['idKotaTujuan'])
            ->where('idPengirimanJenis', $data['idPengirimanJenis'])
            ->get();

        DB::table('notaPengiriman')
            ->where('idNotaPengiriman',$notaPengiriman->idNotaPengiriman)
            ->update([
                'keterangan' => $data['keterangan'],
                'idPengirimanJenis' => $data['idPengirimanJenis'],
                'idPembayaranJenis' => $data['idPembayaranJenis'],
                'idHargaPengiriman' => $idHargaPengiriman[0]->idHargaPengiriman,
                'totalBerat' =>  $data['berat'],
                'totalHarga' =>  $data['hargaTotal'] * $data['berat'],
                //'idKurir' =>  $data['idKurir'],
                'idBarangJenis' => $data['idBarangJenis'],//
                'idPelanggan' => $data['idPelanggan'],//
                'alamat' => $data['alamat'],
            ]
        ); 

        /*$totalHarga = 0;
        $totalBerat = 0;

        $dataDetailTotal = DB::table('notaPengirimanDetail')
            ->where('idNotaPengiriman', $notaPengiriman->idNotaPengiriman)
            ->get();

        if(count($dataDetailTotal) > count($data['idBarangJenis'])){
            DB::table('notaPengirimanDetail')
                ->where('idNotaPengiriman', $notaPengiriman->idNotaPengiriman)
                ->delete();
            
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
        }
        else{
            for($i = 0; $i < count($data['idBarangJenis']); $i++){
                if($i < count($dataDetailTotal)){
                    DB::table('notaPengirimanDetail')
                    ->where('idNotaPengiriman', $notaPengiriman->idNotaPengiriman)
                    ->update(array(
                        'idBarangJenis' => $data['idBarangJenis'][$i], //array
                        'berat' => $data['beratBarang'][$i],
                        )           
                    );
                    $totalBerat += $data['beratBarang'][$i];
                    $totalHarga += $data['beratBarang'][$i] * $dataHarga->harga;           
                }
                else{
                    DB::table('notaPengirimanDetail')->insert(array(
                        'idNotaPengiriman' => $idnota,
                        'idBarangJenis' => $data['idBarangJenis'][$i], //array
                        'berat' => $data['beratBarang'][$i],
                        )
                    ); 
                    $totalBerat += $data['beratBarang'][$i];
                    $totalHarga += $data['beratBarang'][$i] * $dataHarga->harga;        
                }
            }
        }

        DB::table('notaPengiriman')
            ->where('id', $idnota)
            ->update([
                'totalBerat' =>  $totalBerat,
                'totalHarga' =>  $totalHarga,
        ]);*/

        return redirect()->route('notaPengiriman.index')->with('status','Success!!');
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


    public function print(NotaPengiriman $notaPengiriman)
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

        $dataUser = DB::table('users')
            ->get();
        //dd($notaPengiriman);
        return view('notaPengiriman.print',[
            'notaPengiriman' => $notaPengiriman,
            'dataPengirimanJenis' => $dataPengirimanJenis,
            'dataPembayaranJenis' => $dataPembayaranJenis,
            'dataKota' => $dataKota,
            'dataBarang' => $dataBarang,
            'dataHargaPengiriman' => $dataHargaPengiriman,
            'dataUser' => $dataUser,
        ]);

        $user = Auth::user();
        $check = $this->checkAccess('notaPengiriman.show', $user->id, $user->idRole);
        
        if($check){
            return view('notaPengiriman.print',[
                'notaPengiriman' => $notaPengiriman,
                'dataPengirimanJenis' => $dataPengirimanJenis,
                'dataPembayaranJenis' => $dataPembayaranJenis,
                'dataKota' => $dataKota,
                'dataBarang' => $dataBarang,
                'dataHargaPengiriman' => $dataHargaPengiriman,
                'dataUser' => $dataUser,
            ]);
        }
        else{
            return redirect()->route('home')->with('message','Anda tidak memiliki akses kedalam Nota Pengiriman');
        }
    }
}
