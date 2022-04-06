@extends('layouts.home_master')

@section('content')

<div class="pagetitle">
      <h1>Data Nota Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Nota Pengiriman</li>
          <li class="breadcrumb-item active">Edit</li>
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
              
                   <form action="{{route('notaPengiriman.update',[$notaPengiriman->idNotaPengiriman])}}" method="POST" >
                       @csrf
                       @method('PUT')
                        <div class="form-group">
                            <label for="title">Pelanggan</label>
                            <select name="idPelanggan" class="form-control" id="pelanggan">
                                    <option value="">--Pilih Pelanggan--</option>
                                    @foreach($dataUser as $key => $data)
                                    @if($data->id == $notaPengiriman->idPelanggan)
                                    <option selected value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                    @else
                                    <option value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                    @endif
                                    @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                            <label for="title">Kota Awal</label>
                            <select name="idKotaAwal" class="form-control harga" id="kotaAwal">
                                    <option value="">--Pilih Kota Awal--</option>
                                    @foreach($dataHargaPengiriman as $dataHarga)
                                      @foreach($dataKota as $kota)
                                        @if($kota->idKota == $dataHarga->idKotaAwal)
                                          <option selected value="{{$kota->idKota}}"{{$kota->nama == $kota->idKota? 'selected' :'' }}>{{$kota->nama}}</option>
                                        @else
                                          <option value="{{$kota->idKota}}"{{$kota->nama == $kota->idKota? 'selected' :'' }}>{{$kota->nama}}</option>
                                        @endif
                                      @endforeach
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Kota Tujuan</label>
                            <select name="idKotaTujuan" class="form-control harga" id="kotaTujuan">
                                    <option value="">--Pilih Kota Tujuan--</option>
                                    @foreach($dataHargaPengiriman as $dataHarga)
                                      @foreach($dataKota as $kota)
                                        @if($kota->idKota == $dataHarga->idKotaTujuan)
                                            <option selected value="{{$kota->idKota}}"{{$kota->nama == $kota->idKota? 'selected' :'' }}>{{$kota->nama}}</option>
                                          @else
                                            <option value="{{$kota->idKota}}"{{$kota->nama == $kota->idKota? 'selected' :'' }}>{{$kota->nama}}</option>
                                          @endif
                                      @endforeach
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Pengiriman Jenis</label>
                            <select name="idPengirimanJenis" class="form-control harga" id="jenisPengiriman">
                                    <option value="">--Pilih Pengiriman Jenis--</option>
                                    @foreach($dataPengirimanJenis as $key => $data)
                                      @if($data->idPengirimanJenis == $notaPengiriman->idPengirimanJenis)
                                        <option selected value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                      @else
                                        <option value="{{$data->idPengirimanJenis}}"{{$data->nama == $data->idPengirimanJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                      @endif
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Jenis Pembayaran</label>
                            <select name="idPembayaranJenis" class="form-control" >
                                    <option value="">--Pilih Pembayaran Jenis--</option>
                                    @foreach($dataPembayaranJenis as $key => $data)
                                      @if($data->idPembayaranJenis == $notaPengiriman->idPembayaranJenis)
                                      <option selected value="{{$data->idPembayaranJenis}}"{{$data->nama == $data->idPembayaranJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                      @else
                                      <option value="{{$data->idPembayaranJenis}}"{{$data->nama == $data->idPembayaranJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                      @endif
                                    @endforeach
                            </select>
                         </div>

                         <div class="form-group">
                            <label for="title">Jenis Barang</label>
                            <select name="idBarangJenis" class="form-control" >
                                    <option value="">--Pilih Jenis Barang--</option>
                                    @foreach($dataBarang as $key => $data)
                                    @if($data->idBarangJenis == $notaPengiriman->idBarangJenis)
                                        <option selected value="{{$data->idBarangJenis}}"{{$data->nama == $data->idBarangJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                      @else
                                        <option value="{{$data->idBarangJenis}}"{{$data->nama == $data->idBarangJenis? 'selected' :'' }}>{{$data->nama}}</option>
                                      @endif
                                    @endforeach
                            </select>
                         </div>

                        <div class="form-group">
                           <label for="title">Alamat</label>
                           <input require type="text" name="alamat" class="form-control" 
                           value="{{old('alamat',$notaPengiriman->alamat)}}" >
                        </div>
     
                        <div class="form-group">
                           <label for="title">Keterangan</label>
                           <input require type="text" name="keterangan" class="form-control" min="1" 
                           value="{{old('keterangan',$notaPengiriman->keterangan)}}" > 
                        </div>
                         
                        <div class="form-group">
                           <label for="title">Berat</label>
                           <input require type="number" name="berat" class="form-control" min="1" id="beratPesanan"
                           value="{{old('totalBerat',$notaPengiriman->totalBerat)}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">Harga</label>
                           <input require type="number" step=".01" name="harga" class="form-control" id="hargaPesanan"
                           value="{{old('totalHarga',$notaPengiriman->totalHarga)}}" disabled>                           
                        </div>

                        @foreach($dataHargaPengiriman as $dataHarga)
                          @if($dataHarga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                          <input type="hidden" value="{{$dataHarga->harga}}" id="hargaHidden" name="hargaTotal">
                          @endif
                        @endforeach
                        <br>
                       <button id="btnTambah" class="btn btn-primary">Simpan</button>
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
        alert(harga);
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

