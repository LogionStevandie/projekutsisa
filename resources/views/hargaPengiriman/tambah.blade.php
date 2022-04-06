@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data HargaPengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">HargaPengiriman</li>
          <li class="breadcrumb-item active">Tambah</li>
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
              
                    <form action="{{route('hargaPengiriman.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Harga</label>
                           <input required type="text" name="harga" class="form-control" 
                           value="{{old('harga','')}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Kota Awal</label>
                            <select required name="idKotaAwal" class="form-control harga" id="kotaAwal">
                                    <option value="">--Pilih Kota Awal--</option>
                                    @foreach($dataKota as $key => $data)
                                    <option value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Kota Tujuan</label>
                            <select required name="idKotaTujuan" class="form-control harga" id="kotaTujuan">
                                    <option value="">--Pilih Kota Tujuan--</option>
                                    @foreach($dataKota as $key => $data)
                                    <option value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Pengiriman Jenis</label>
                            <select required name="idPengirimanJenis" class="form-control harga" id="jenisPengiriman"> 
                                    <option value="">--Pilih Pengiriman Jenis--</option>
                                    @foreach($dataPengirimanJenis as $key => $data)
                                    <option value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>
                        <br>

                       <button id="btnTambah" class="btn btn-primary">Tambah</button>
                    </form>

          
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>


<script type="text/javascript">
$(".harga").change(function() {
        //alert(this.value);
        var kotaAwal = $("#kotaAwal").val();
        var kotaTujuan = $("#kotaTujuan").val();
        var pengirimanJenis = $("#jenisPengiriman").val();
        /*alert(kotaAwal);
        alert(kotaTujuan);
        die;*/
        var dataPembayaran = <?php echo json_encode($dataPembayaran); ?>;
        if(kotaAwal != "" || kotaTujuan != "" || pengirimanJenis !=""){
          $.each(dataPembayaran, function( key, value ){
                if(kotaAwal == value.idKotaAwal && kotaTujuan == value.idKotaTujuan && pengirimanJenis == value.idPengirimanJenis){
                  alert("Data untuk kota awal, kota tujuan dan jenis pengiriman ini sudah ada,Harap menggantinya");
                  $('#btnTambah').prop('disabled', true);
                  die;
                }            
                else{
                  $('#btnTambah').prop('disabled', false);
                }    
          });
        }
    });
</script>
@endsection

