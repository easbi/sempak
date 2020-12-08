<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_lte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin_lte/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Datatable CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  {{-- <link rel="shortcut icon" type="image/x-icon" href="icon.jpg"> --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">!</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Ada Pemberitahuan!</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Entri Periode Pengusulan DUPAK"
          </a>
        </div>
      </li>
      <!-- Profile Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        {{ Auth::user()->nama }} <i class="fas fa-user-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{ route('pegawai.edit', ['id' => Auth::id()]) }}" class="dropdown-item">
            <i class="far fa-address-book"></i>   Ubah Profil
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off"></i> Logout
          </a>          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/')}}" class="brand-link">
      <img src="{{asset('admin_lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      {{-- <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span> --}}
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(Auth::user()->role != 5)
          <li class="nav-header">Pengajuan DUPAK</li>            
          <li class="nav-item">
            <a href="{{ url('dokdasar') }}" class="nav-link">
              <i class="fas fa-file-signature nav-icon"></i>  
              <p>Berkas Administrasi DUPAK</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/dokumenkeg') }}" class="nav-link">
              <i class="fas fa-file-archive nav-icon"></i>
              <p>Pengisian SPMK dan STMK</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link">
              <i class="fas fa-envelope-open-text nav-icon"></i>
              <p>Entri Rincian Dupak</p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="{{ url('/plotpenilai/createDariPengusul') }}" class="nav-link">
              <p> </p>
              <i class="fas fa-calendar-alt"></i>
              <p> Entri Periode Pengajuan</p>
            </a>
          </li>     
          <li class="nav-item">
            <a href="{{ url('/dokutkusul') }}" class="nav-link">
              <p> </p>
              <i class="fas fa-people-carry nav-icon"></i>
              <p>Dokumen Pengajuan</p>
            </a>
          </li>
          <li class="nav-header">Penilaian DUPAK</li>
          <li class="nav-item">
            <a href="{{ url('/penilai/dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Penilaian Dupak</p>
            </a>
          </li>
          @endif

          @if(Auth::user()->role == 4 OR Auth::user()->role == 1 OR Auth::user()->role == 5)
          <li class="nav-header">Monitoring DUPAK</li>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Rekapitulasi<i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <a href="{{ url('/plotpenilai') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Plot Penilai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/sekretariat') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penilaian DUPAK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/sekretariat/rekap1')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel Total Angka Kredit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/sekretariat/bapak')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tabel BAPAK</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(Auth::user()->role != 5)
          <li class="nav-header">Tampilkan Laporan</li>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-buffer"></i>
              <p>Laporan<i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/dupak') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Rekap DUPAK</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if(Auth::user()->role == 4 OR Auth::user()->role == 1)
          <li class="nav-header">Metadata Dupak</li>
          <li class="nav-item">
            <a href="{{ url('/metadata') }}" class="nav-link">
              <i class="nav-icon fas fa-book-open"></i>
              <p>Unsur Utama</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/masteracara') }}" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>Master Acara / Diklat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/rinciankegiatan') }}" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>Rincian Kegiatan Per Unsur</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/rincianangkakredit') }}" class="nav-link">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>Rincian Angka Kredit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/pegawai') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Pegawai</p>
            </a>
          </li>
          @endif
          <li class="nav-header">Bantuan</li>
          <li class="nav-item">
            <a href="{{ url('http://wa.me/6285265513571')}}" class="nav-link">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>Laporkan</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="pusdiklat.bps.go.id">Pusdiklat BPS</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
  <script src="{{asset('admin_lte/plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('admin_lte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{asset('select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('admin_lte/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('admin_lte/plugins/sparklines/sparkline.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('admin_lte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('admin_lte/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('admin_lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('admin_lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('admin_lte/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin_lte/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('admin_lte/dist/js/demo.js')}}"></script>

  @stack('scripts')
</body>
</html>
