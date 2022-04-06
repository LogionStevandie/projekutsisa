<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{asset('NiceAdmin/index.html')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Nota</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
           <li>
            <a href="{{route('notaPengiriman.index')}}">
              <i class="bi bi-circle"></i><span>Tambah Nota</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('pulau.index')}}">
              <i class="bi bi-circle"></i><span>Pulau</span>
            </a>
          </li>
          <li>
            <a href="{{route('provinsi.index')}}">
              <i class="bi bi-circle"></i><span>provinsi</span>
            </a>
          </li>
           <li>
            <a href="{{route('kota.index')}}">
              <i class="bi bi-circle"></i><span>kota</span>
            </a>
          </li>
           <li>
            <a href="{{route('pembayaranJenis.index')}}">
              <i class="bi bi-circle"></i><span>Jenis Pembayaran</span>
            </a>
          </li>

           <li>
            <a href="{{route('barangJenis.index')}}">
              <i class="bi bi-circle"></i><span>Jenis barang</span>
            </a>
          </li>

          <li>
            <a href="{{route('role.index')}}">
              <i class="bi bi-circle"></i><span>Role</span>
            </a>
          </li>

           <li>
            <a href="{{route('menu.index')}}">
              <i class="bi bi-circle"></i><span>Menu</span>
            </a>
          </li>

           <li>
            <a href="{{route('pengirimanJenis.index')}}">
              <i class="bi bi-circle"></i><span>Jenis Pengiriman</span>
            </a>
          </li>
          <li>
            <a href="{{route('hargaPengiriman.index')}}">
              <i class="bi bi-circle"></i><span>harga Pengiriman</span>
            </a>
          </li>
    
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Kurir</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('notaPengiriman.index')}}">
              <i class="bi bi-circle"></i><span>List kurir</span>
            </a>
          </li>
      
        </ul>
      </li><!-- End Tables Nav -->

    



  </aside>