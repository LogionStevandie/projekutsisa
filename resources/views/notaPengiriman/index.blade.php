@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
  <h1>Data Nota Pengiriman</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Nota Pengiriman</li>
      <li class="breadcrumb-item active">Index</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Nota Pengiriman</h5>
           <a href="{{route('notaPengiriman.create')}}" class="btn btn-primary btn-responsive">Tambah Nota Pengiriman
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
              </svg>
           </a> 

          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Nota</th>
                <th scope="col">Total Berat</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Kota Awal</th>
                <th scope="col">Kota Tujuan</th>
                <th scope="col">Proses Pengiriman</th>
                <th scope="col">Proses Kurir</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $data)
              <tr>
                <th scope="row">{{$data->idNotaPengiriman}}</th>
                <td>{{$data->nama}}</td>
                <td>{{$data->totalBerat}}</td>
                <td>{{$data->pelanggan}}</td>
               
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
                 
                @if($data->prosesPengiriman==0)  <!-- 0:belum, 1:proses, 2:selesai -->
                <td>Belum dikirim</td>
                @elseif($data->prosesPengiriman==1)
                <td>Sedang Diproses</td>
                @elseif($data->prosesPengiriman==2)
                <td>Sudah dikirim</td>
                @endif
                
                @if($data->prosesKurir==0)  <!-- 0:belum, 1:proses, 2:selesai -->
                <td>Belum dikirim</td>
                @elseif($data->prosesKurir==1)
                <td>Sedang Diproses</td>
                @elseif($data->prosesKurir==2)
                <td>Sudah sampai ditujuan</td>
                @endif
                
                <td>
                  @if($data->prosesPengiriman==0)  <!-- 0:belum, 1:proses, 2:selesai -->
                  <a href="{{route('notaPengiriman.edit',[$data->idNotaPengiriman])}}" class="btn btn-secondary btn-responsive">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                  </a>
                  <form action="{{route('notaPengiriman.destroy',[$data->idNotaPengiriman])}}" method="POST" class="btn btn-responsive">
                    @csrf
                    @method('DELETE')
                    <button action="{{route('notaPengiriman.destroy',[$data->idNotaPengiriman])}}" method="POST" class="btn btn-secondary btn-danger">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                      </svg>
                    </button>
                  </form>
                  @endif
                  <a href="{{route('notaPengiriman.show',[$data->idNotaPengiriman])}}" class="btn btn-primary btn-responsive">Detail</a>
                  
                  <form action="/print/invoice/{{$data->idNotaPengiriman}}/" method="get" class="btn btn-responsive">
                    <button class="btn btn-secondary btn-danger">Print</button>
                  </form>
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