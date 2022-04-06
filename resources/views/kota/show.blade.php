@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Kota</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Kota</li>
           <li class="breadcrumb-item active">Show</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Kota</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
              
                    <form action="{{route('kota.show',[$kota->idKota])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Kota</label>
                           <input require type="text" name="nama" class="form-control" 
                           value="{{old('nama',$kota->nama)}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title">Kode Kota</label>
                           <input require type="text" name="kode" class="form-control" 
                           value="{{old('kode',$kota->kode)}}" disabled>
                        </div>

                         <div class="form-group">
                            <label for="title">Provinsi</label>
                            <select name="idProvinsi" class="form-control" disabled> 
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach($dataProvinsi as $key => $data)
                                    @if($kota->idProvinsi==$data->idProvinsi)
                                    <option selected value="{{$data->idProvinsi}}"{{$data->nama == $data->idProvinsi? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idProvinsi}}"{{$data->nama == $data->idProvinsi? 'selected' :'' }}>{{$data->nama}}</option>
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