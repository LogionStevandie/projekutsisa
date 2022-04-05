@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Menu</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Menu</li>
          <li class="breadcrumb-item active">Index</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Menu</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
              
                    <form action="{{route('menu.update',[$menu->idMenu])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Menu</label>
                           <input require type="text" name="nama" class="form-control" 
                           value="{{old('nama',$menu->nama)}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Url</label>
                           <input require type="text" name="url" class="form-control" 
                           value="{{old('url',$menu->url)}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">keterangan</label>
                           <input require type="text" name="keterangan" class="form-control" 
                           value="{{old('keterangan',$menu->keterangan)}}" >
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