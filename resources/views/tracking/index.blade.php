@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
  <h1>Data Role</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item">Tracking</li>
      <li class="breadcrumb-item active">Index</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tracking Barang</h5>
            <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->

            <form action="{{route('tracking.detail')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Tracking</label>
                           <input require type="text" name="tracking" class="form-control" 
                           value="{{old('tracking','')}}" >
                        </div>
                        <br>
                       <button class="btn btn-primary">check</button>
                    </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection