@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Role Access</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Role-Access</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Role Access</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
               
                    <form action="{{route('roleAccess.update',[$role->idRole])}}" method="POST" >
                       @csrf
                       @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Role</label>
                           <input disabled required type="text" name="nama" class="form-control" 
                           value="{{old('nama',$role->nama)}}" >
                        </div>

                        <div class="form-group">
                            
                            @foreach($dataMenu as $data)      
                              <input type="checkbox" id="menuIni{{$data->idMenu}}" class="form-check-input" name= "menu[]" value="{{$data->idMenu}}"{{'$data->idMenu' == old('idMenu',$data->idMenu)? 'checked' :'' }}> 
                              <label for="title">{{$data->nama}}</label><br>
                            @endforeach
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

<script type="text/javascript">
$(document).ready(function() {
    var dataAccess = <?php echo json_encode($dataAccess); ?>;
    $.each(dataAccess, function( key, value ){
        $("#menuIni"+value.idMenu).prop('checked',true)
    });
});
</script>
@endsection