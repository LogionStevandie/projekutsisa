@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Nota Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Nota Pengiriman</li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Nota Pengiriman</h5>
              <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->
              
                    <form action="{{route('notaPengiriman.store')}}" method="POST" >
                      @csrf
                        <div class="form-group">
                            <label for="title">Pelanggan</label>
                            <select name="idPelanggan" class="form-control" id="pelanggan">
                                    <option value="">--Pilih Pelanggan--</option>
                                    @foreach($dataUser as $key => $data)
                                    <option value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                    @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                            <label for="title">Kota Awal</label>
                            <select name="idKotaAwal" class="form-control harga" id="kotaAwal">
                                    <option value="">--Pilih Kota Awal--</option>
                                    @foreach($dataKota as $key => $data)
                                    <option value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Kota Tujuan</label>
                            <select name="idKotaTujuan" class="form-control harga" id="kotaTujuan">
                                    <option value="">--Pilih Kota Tujuan--</option>
                                    @foreach($dataKota as $key => $data)
                                    <option value="{{$data->idKota}}"{{$data->nama == $data->idKota? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Pengiriman Jenis</label>
                            <select name="idPengirimanJenis" class="form-control harga" id="jenisPengiriman">
                                    <option value="">--Pilih Pengiriman Jenis--</option>
                                    @foreach($dataPengirimanJenis as $key => $data)
                                    <option value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Jenis Pembayaran</label>
                            <select name="idPembayaranJenis" class="form-control" >
                                    <option value="">--Pilih Pembayaran Jenis--</option>
                                    @foreach($dataPembayaranJenis as $key => $data)
                                    <option value="{{$data->idPembayaranJenis}}"{{$data->nama == $data->idPembayaranJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Jenis Barang</label>
                            <select name="idBarangJenis" class="form-control" >
                                    <option value="">--Pilih Jenis Barang--</option>
                                    @foreach($dataBarang as $key => $data)
                                    <option value="{{$data->idBarangJenis}}"{{$data->nama == $data->idBarangJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                    @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                           <label for="title">Alamat</label>
                           <input require type="text" name="alamat" class="form-control" 
                           value="{{old('alamat','')}}" >
                        </div>

                              
                        <div class="form-group">
                           <label for="title">Keterangan</label>
                           <input require type="text" name="keterangan" class="form-control" min="1" 
                           value="{{old('keterangan','')}}" >
                        </div>
                         
                        <div class="form-group">
                           <label for="title">Berat</label>
                           <input require type="number" name="berat" class="form-control" min="1" id="beratPesanan"
                           value="{{old('berat','')}}" >
                        </div>


                        <div class="form-group">
                           <label for="title">Harga</label>
                           <input require type="number" step=".01" name="harga" class="form-control" id="hargaPesanan"
                           value="{{old('totalHarga','')}}" disabled>
                           
                        </div>
                        <input type="hidden" value="" id="hargaHidden" name="hargaTotal">
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
$("#beratPesanan").change(function() {
        //alert(this.value);
        var berat = this.value;
        var harga = $("#hargaHidden").val();
        $('#hargaPesanan').val(parseFloat(berat * harga));
});

$(".harga").change(function() {
        var kotaAwal = $("#kotaAwal").val();
        var kotaTujuan = $("#kotaTujuan").val();
        var pengirimanJenis = $("#jenisPengiriman").val();
        //alert(pengirimanJenis);
        /*alert(kotaAwal);
        alert(kotaTujuan);
        die;*/
        var dataHargaPengiriman = <?php echo json_encode($dataHargaPengiriman); ?>;
        if(kotaAwal != "" || kotaTujuan != "" || pengirimanJenis !=""){
          $.each(dataHargaPengiriman, function( key, value ){
                if(kotaAwal == value.idKotaAwal && kotaTujuan == value.idKotaTujuan && pengirimanJenis == value.idPengirimanJenis){
                  $('#hargaPesanan').val(parseFloat(value.harga));
                  $('#hargaHidden').val(parseFloat(value.harga));
                  //alert(value.harga);
                  $('#btnTambah').prop('disabled', false);
                  die;
                }            
                else{
                  $('#btnTambah').prop('disabled', true);
                  //alert("tidak ada Data untuk kota awal, kota tujuan dan jenis pengiriman Tambahkan terlebih dahulu di harga pengiriman");
                }    
          });
        }
    });
</script>
@endsection

