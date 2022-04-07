@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
  <h1>Data Nota Pengiriman</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Approve Pengiriman Kurir</li>
      <li class="breadcrumb-item active">Index</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Approve Pengiriman Kurir</h5>
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Nota</th>
                <th scope="col">Kota Awal</th>
                <th scope="col">Kota Tujuan</th>
                <th scope="col">Proses Pengiriman</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $data)
              <tr>
                <th scope="row">{{$data->idNotaPengiriman}}</th>
                <td>{{$data->nama}}</td>
               
                @foreach($dataHargaPengiriman as $pembayaran)
                  @foreach($dataKota as $kota)
                    @if($pembayaran->idKotaAwal == $kota->idKota)
                      <td>{{$kota->nama}}</td>
                    @endif
                  @endforeach

                  @foreach($dataKota as $kota)
                    @if($pembayaran->idKotaTujuan == $kota->idKota)
                      <td>{{$kota->nama}}</td>
                    @endif
                  @endforeach
                  
                @endforeach
                 
                @if($data->prosesKurir==0)  <!-- 0:belum, 1:proses, 2:selesai -->
                <th>Belum dikirim</th>
                @elseif($data->prosesKurir==1)
                <th>Sedang Diproses</th>
                @elseif($data->prosesKurir==2)
                <th>Sudah dikirim</th>
                @endif
        
                
                <td>
                @if($data->prosesKurir!=2)
                  <a href="{{route('kurir.edit',[$data->idNotaPengiriman])}}" class="btn btn-primary btn-responsive">Approve</a>
                @endif
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div>
    </div>
  </div>
</section>

@endsection