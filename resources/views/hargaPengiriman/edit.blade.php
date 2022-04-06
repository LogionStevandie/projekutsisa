@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Harga Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Harga Pengiriman</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Harga Pengiriman</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
              
                    <form action="{{route('hargaPengiriman.update',[$hargaPengiriman->idHargaPengiriman])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">Harga</label>
                           <input require type="text" name="harga" class="form-control" 
                           value="{{old('harga',$hargaPengiriman->harga)}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Kota Awal</label>
                            <select name="idKotaAwal" class="form-control" disabled>
                                  <option value="">--Pilih Kota Awal--</option>
                                   @foreach($dataKota as $key => $data)
                                    @if($hargaPengiriman->idKotaAwal == $data->idKota)
                                    <option selected value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endif
                                  @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Kota Tujuan</label>
                            <select name="idKotaTujuan" class="form-control" disabled>
                               <option value="">--Pilih Kota Tujuan--</option>
                                    @foreach($dataKota as $key => $data)
                                    @if($hargaPengiriman->idKotaTujuan == $data->idKota)
                                    <option selected value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endif
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Pengiriman Jenis</label>
                            <select name="idPengirimanJenis" class="form-control" disabled>
                                    <option value="">--Pilih Pengiriman Jenis--</option>
                                    @foreach($dataPengirimanJenis as $key => $data)
                                    @if($hargaPengiriman->idPengirimanJenis == $data->idPengirimanJenis)
                                    <option selected value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endif
                                    @endforeach
                            </select>
                         </div>
                        <br>

                       <button class="btn btn-primary">Save</button>
                    </form>

          
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection