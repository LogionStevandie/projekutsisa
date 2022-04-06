@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Kota</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Kota</li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Kota</h5>
              
              
                    <form action="{{route('kota.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama Kota</label>
                           <input require type="text" name="nama" class="form-control" 
                           value="{{old('nama','')}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Kode Kota</label>
                           <input require type="text" name="kode" class="form-control" 
                           value="{{old('kode','')}}">
                        </div>

                        <div class="form-group">
                            <label for="title">Provinsi</label>
                            <select name="idProvinsi" class="form-control">
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach($dataProvinsi as $key => $data)
                                    <option value="{{$data->idProvinsi}}"{{$data->nama == $data->idProvinsi? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <br>

                       <button class="btn btn-primary">tambah</button>
                    </form>

          
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection