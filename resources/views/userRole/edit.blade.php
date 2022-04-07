@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data User-Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">User-Role</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User-Role</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
               
                    <form action="{{route('userRole.update',[$user->id])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Role</label>
                           <input disabled required type="text" name="nama" class="form-control" 
                           value="{{old('name',$user->name)}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Role</label>
                            <select name="role" class="form-control">
                                    <option value="">--Pilih Role--</option>
                                    @foreach($role as $key => $data)
                                    @if($user->idRole==$data->idRole)
                                    <option selected value="{{$data->idRole}}"{{$data->nama == $data->idRole? 'selected' :'' }}>{{$data->nama}}</option>
                                    @else
                                    <option value="{{$data->idRole}}"{{$data->nama == $data->idRole? 'selected' :'' }}>{{$data->nama}}</option>
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