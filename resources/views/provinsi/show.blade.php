@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Provinsi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Provinsi</li>
          <li class="breadcrumb-item active">Index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Provinsi</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
              
                    <form action="{{route('provinsi.update',[$provinsi->idProvinsi])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Provinsi</label>
                           <input require type="text" name="nama" class="form-control" 
                           value="{{old('nama',$provinsi->nama)}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Kode Provinsi</label>
                           <input require type="text" name="kode" class="form-control" 
                           value="{{old('kode',$provinsi->kode)}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Pulau</label>
                            <select name="idPulau" class="form-control" disabled>
                                    <option value="">--Pilih Pulau--</option>
                                    @foreach($dataPulau as $key => $data)
                                    @if($provinsi->idPulau == $data->idPulau)
                                    <option selected value="{{$data->idPulau}}"{{$data->nama == $data->idPulau? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idPulau}}"{{$data->nama == $data->idPulau? 'selected' :'' }}>{{$data->nama}}</option>
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