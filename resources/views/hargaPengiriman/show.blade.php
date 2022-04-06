@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data HargaPengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">HargaPengiriman</li>
           <li class="breadcrumb-item active">Show</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">HargaPengiriman</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
              
                    <form action="{{route('hargaPengiriman.update',[$hargaPengiriman->idHargaPengiriman])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">harga</label>
                           <input require type="text" name="harga" class="form-control" 
                           value="{{old('harga',$hargaPengiriman->harga)}}" disabled >
                        </div>

                        <div class="form-group">
                            <label for="title">Kota Awal</label>
                            <select name="idKota" class="form-control">
                                    <option value="">--Pilih Kota Awal--</option>
                                    @foreach($dataKota as $key => $data)
                                    @if($kota->idKotaAwal == $data->idKotaAwal)
                                    <option selected value="{{$data->idKotaAwal}}"{{$data->nama == $data->idKotaAwal? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idKotaAwal}}"{{$data->nama == $data->idKotaAwal? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endif

                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Kota Tujuan</label>
                            <select name="idKota" class="form-control">
                                    <option value="">--Pilih Kota Tujuan--</option>
                                    @foreach($dataKota as $key => $data)
                                    @if($kota->idKotaTujuan == $data->idKotaTujuan)
                                    <option selected value="{{$data->idKotaTujuan}}"{{$data->nama == $data->idKotaTujuan? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idKotaTujuan}}"{{$data->nama == $data->idKotaTujuan? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endif

                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Pengiriman Jenis</label>
                            <select name="idKota" class="form-control">
                                    <option value="">--Pilih Pengiriman Jenis--</option>
                                    @foreach($dataKota as $key => $data)
                                    @if($kota->idPengirimanJenis == $data->idPengirimanJenis)
                                    <option selected value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endif

                                    @endforeach
                            </select>
                         </div>
                        <br>
               
                    </form>

          
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection