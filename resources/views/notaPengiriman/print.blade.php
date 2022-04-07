<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('NiceAdmin/assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('NiceAdmin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('NiceAdmin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="{{asset('NiceAdmin/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<div class="pagetitle">
      <h1>Data Nota Pengiriman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Nota Pengiriman</li>
           <li class="breadcrumb-item active">Show</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="bi bi-truck"></i> Kurir Terbaik
          <small style="float:right;">{{$notaPengiriman->tanggalDibuat}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>
            @foreach($dataUser as $user)
              @if($user->id == $notaPengiriman->idPelanggan)
                {{$user->name}}
              @endif
            @endforeach
          </strong><br>
          @foreach($dataHargaPengiriman as $harga)
              @if($harga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                @foreach($dataKota as $kota)
                  @if($kota->idKota == $harga->idKotaAwal)
                    {{$kota->nama}}<br>
                  @endif
                @endforeach
              @endif
          @endforeach
          @foreach($dataUser as $user)
            @if($user->id == $notaPengiriman->idPelanggan)
              {{$user->email}}
            @endif
          @endforeach
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
        <strong>
        @foreach($dataHargaPengiriman as $harga)
              @if($harga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                @foreach($dataKota as $kota)
                  @if($kota->idKota == $harga->idKotaTujuan)
                    {{$kota->nama}}<br>
                  @endif
                @endforeach
              @endif
          @endforeach
          </strong><br>  
          {{$notaPengiriman->alamat}}<br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b style="word-break: break-word;">Kode Nota (Untuk Tracking):<br>{{$notaPengiriman->namaEnkripsi}}</b><br>
        <!--<br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567-->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Jenis Pengiriman</th>
            <th>Jenis Barang</th>
            <th>Harga / KG</th>
            <th>total Berat</th>
            <th>total Harga</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              @foreach($dataPengirimanJenis as $pengiriman)
                @if($pengiriman->idPengirimanJenis == $notaPengiriman->idPengirimanJenis)
                  {{$pengiriman->nama}}
                @endif
              @endforeach
            </td>
            <td>
              @foreach($dataBarang as $barang)
                @if($barang->idBarangJenis == $notaPengiriman->idBarangJenis)
                  {{$barang->nama}}
                @endif
              @endforeach
            </td>
            <td>
              @foreach($dataHargaPengiriman as $harga)
                @if($harga->idHargaPengiriman == $notaPengiriman->idHargaPengiriman)
                  Rp. {{$harga->harga}},-
                @endif
              @endforeach
            </td>
            <td>{{$notaPengiriman->totalBerat}} Kg</td>
            <td>Rp. {{$notaPengiriman->totalHarga}},-</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        @foreach($dataPembayaranJenis as $bayar)
          @if($bayar->idPembayaranJenis == $notaPengiriman->idPembayaranJenis)
            <h2>{{$bayar->nama}}</h2>
          @endif
        @endforeach

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Terimakasih sudah memakai jasa kami! 
        </p>
      </div>
      <!-- /.col 
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </table>
        </div>
      </div>-->
      <!-- /.col -->
    </div>
    <!-- /.row -->
  
  </section>
  <script>
  window.addEventListener("load", window.print());
</script>
  <!-- Vendor JS Files -->
  <script src="{{asset('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('NiceAdmin/assets/vendor/php-email-form/validate.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('NiceAdmin/assets/js/main.js')}}"></script>

</body>

</html>