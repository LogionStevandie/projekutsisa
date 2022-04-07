@extends('layouts.home_master')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

body {
    background-color: #eeeeee;
    font-family: 'Open Sans', serif
}

.container {
    margin-top: 50px;
    margin-bottom: 50px
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.10rem
}

.card-header:first-child {
    border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1)
}

.track {
    position: relative;
    background-color: #ddd;
    height: 7px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 60px;
    margin-top: 50px
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative
}

.track .step.active:before {
    background: #FF5722
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px
}

.track .step.active .icon {
    background: #ee5435;
    color: #fff
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd
}

.track .step.active .text {
    font-weight: 400;
    color: #000
}

.track .text {
    display: block;
    margin-top: 7px
}

.itemside {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%
}

.itemside .aside {
    position: relative;
    -ms-flex-negative: 0;
    flex-shrink: 0
}

.img-sm {
    width: 80px;
    height: 80px;
    padding: 7px
}

ul.row,
ul.row-sm {
    list-style: none;
    padding: 0
}

.itemside .info {
    padding-left: 15px;
    padding-right: 7px
}

.itemside .title {
    display: block;
    margin-bottom: 5px;
    color: #212529
}

p {
    margin-top: 0;
    margin-bottom: 1rem
}

.btn-warning {
    color: #ffffff;
    background-color: #ee5435;
    border-color: #ee5435;
    border-radius: 1px
}

.btn-warning:hover {
    color: #ffffff;
    background-color: #ff2b00;
    border-color: #ff2b00;
    border-radius: 1px
}
</style>
  <div class="container">
    <article class="card">
        <header class="card-header">Tracking Barang</header>
        <div class="card-body">
            <br>
            @foreach ($data as $nota)
            <h6>Order ID:{{$nota->nama}}</h6>
            <h6>Order ID:{{$nota->namaEnkripsi}}</h6>
              @foreach($dataUser as $dataU)
                    @if($dataU->id==$nota->idPelanggan)
                       <h6>Nama Pelanggan:{{$dataU->name}} </h6><!--nanti looping-->
                    @endif
              @endforeach
                @foreach($dataUser as $dataU)
                        @if($dataU->id==$nota->idKurir)
                        <h6>Nama Kurir:{{$dataU->name}} </h6>
                        @endif
                @endforeach
         
            <br>
            
            <article class="card">
                <div class="card-body row">
                    @foreach($dataUser as $dataU)
                        @if($dataU->id==$nota->idPelanggan)
                        <div class="col"> <strong>Nama Pelanggan #:</strong> <br> {{$dataU->name}} </div>
                        @endif
                    @endforeach

                  
                   
                

                    <div class="col"> 
                        <strong>Pengiriman Jenis #:</strong> <br>
                        @foreach($dataPengirimanJenis as $dataPengirim)
                            @if($dataPengirim->idPengirimanJenis==$nota->idPengirimanJenis)
                                {{$dataPengirim->nama}} 
                            @endif
                        @endforeach
                    </div>
                   
                    <div class="col"> <strong>Keterangan:</strong> <br> {{$nota->keterangan}} </div>
                    <div class="col"> <strong>Berat #:</strong> <br> {{$nota->totalBerat}} </div>
                    <div class="col"> <strong>Harga #:</strong> <br> Rp.{{$nota->totalHarga}} </div>
                    <div class="col"> 
                        <strong>Barang Jenis #:</strong> <br> 
                         @foreach($dataBarang as $dataBarg)
                            @if($dataBarg->idBarangJenis==$nota->idBarangJenis)
                                {{$dataBarg->nama}} 
                            @endif
                         @endforeach
                    </div>
                </div>
            </article>  
            <div class="track">
                @if($nota->prosesPengiriman==0 && $nota->prosesKurir==0)  <!-- 0:belum, 1:proses, 2:selesai -->
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Belum dikirim</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Sedang Diproses</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terkirim Di gudang Pusat</span> </div>
                 <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman Oleh kurir</span> </div>
                 <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pesanan sampai ke Pelanggan</span> </div>
                @elseif($nota->prosesPengiriman==1 && $nota->prosesKurir==0)
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Belum dikirim</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Sedang Diproses</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terkirim Di gudang Pusat</span> </div>
                 <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman Oleh kurir</span> </div>
                 <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pesanan sampai ke Pelanggan</span> </div>
                @elseif($nota->prosesPengiriman==2 && $nota->prosesKurir==0)
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Belum dikirim</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Sedang Diproses</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terkirim Di gudang Pusat</span> </div>
                 <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman Oleh kurir</span> </div>
                 <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pesanan sampai ke Pelanggan</span> </div>
                @elseif($nota->prosesPengiriman==2 && $nota->prosesKurir==1)
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Belum dikirim</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Sedang Diproses</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terkirim Di gudang Pusat</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman Oleh kurir</span> </div>
                <div class="step "> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pesanan sampai ke Pelanggan</span> </div>
                @elseif($nota->prosesKurir==2 && $nota->prosesKurir==2)
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Belum dikirim</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Sedang Diproses</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Terkirim Di gudang Pusat</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Proses pengiriman Oleh kurir</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pesanan sampai ke Pelanggan</span> </div>
                @endif
            </div>
            <br>
             <a href="{{route('tracking.index')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Kembali</a>
        </div>
        @endforeach
    </article>
</div>
@endsection

