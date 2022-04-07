@extends('layouts.home_master')

@section('content')
<form method="POST" action="{{route('kurir.update',[$notaPengiriman->idNotaPengiriman])}}" >
    @csrf
    @method('PUT')
    <div class="pagetitle">
      <h1>Data Nota Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Approve Pengiriman</li>
           <li class="breadcrumb-item active">Show</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="bi bi-truck"></i> Kurir Terbaik
          <small style="float:right;">{{$notaPengiriman->tanggalDibuat}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>
            @foreach($dataUser as $user)
              @if($user->id == $notaPengiriman->idPelanggan)
                {{$user->name}}
              @endif
            @endforeach
          </strong><br>
          @foreach($dataHargaPengiriman as $harga)
              @if($harga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                @foreach($dataKota as $kota)
                  @if($kota->idKota == $harga->idKotaAwal)
                    {{$kota->nama}}<br>
                  @endif
                @endforeach
              @endif
          @endforeach
          @foreach($dataUser as $user)
            @if($user->id == $notaPengiriman->idPelanggan)
              {{$user->email}}
            @endif
          @endforeach
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
        <strong>
        @foreach($dataHargaPengiriman as $harga)
              @if($harga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                @foreach($dataKota as $kota)
                  @if($kota->idKota == $harga->idKotaTujuan)
                    {{$kota->nama}}<br>
                  @endif
                @endforeach
              @endif
          @endforeach
          </strong><br>  
          {{$notaPengiriman->alamat}}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b style="word-break: break-word;">Kode Nota (Untuk Tracking):<br>{{$notaPengiriman->namaEnkripsi}}</b><br>
        <!--<br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567-->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Jenis Pengiriman</th>
            <th>Jenis Barang</th>
            <th>Harga / KG</th>
            <th>total Berat</th>
            <th>total Harga</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              @foreach($dataPengirimanJenis as $pengiriman)
                @if($pengiriman->idPengirimanJenis == $notaPengiriman->idPengirimanJenis)
                  {{$pengiriman->nama}}
                @endif
              @endforeach
            </td>
            <td>
              @foreach($dataBarang as $barang)
                @if($barang->idBarangJenis == $notaPengiriman->idBarangJenis)
                  {{$barang->nama}}
                @endif
              @endforeach
            </td>
            <td>
              @foreach($dataHargaPengiriman as $harga)
                @if($harga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                  Rp. {{$harga->harga}},-
                @endif
              @endforeach
            </td>
            <td>{{$notaPengiriman->totalBerat}} Kg</td>
            <td>Rp. {{$notaPengiriman->totalHarga}},-</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        @foreach($dataPembayaranJenis as $bayar)
          @if($bayar->idPembayaranJenis == $notaPengiriman->idPembayaranJenis)
            <h2>{{$bayar->nama}}</h2>
          @endif
        @endforeach

      </div>
   
    </div>

  
  </section>
        




    <button class="btn btn-primary">Approve</button>
</form>


@endsection


