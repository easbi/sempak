@extends('layouts.frontend.master')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">DUPAK Yang Diperiksa</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            @if($pen1->isEmpty() AND $pen2->isEmpty())
            <div class="col-sm-12">
              <h4>Anda Belum Dialokasikan Untuk Menilai DUPAK</h4>
            </div>
            @else
            <div class="row">
                <div class="col-sm-12">
                    <h4>Penilai pertama dari</h4>
                </div>

                @foreach($pen1 as $p)
                  <div class="col-md-4">
                    <div class="card card-widget widget-user-2">   
                    @if( ($p[0]->total_kegiatan - $p[0]->setuju - $p[0]->tolak - $p[0]->pending) > 0 )
                      <div class="widget-user-header bg-warning">
                    @else
                      <div class="widget-user-header bg-info">
                    @endif
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="{{asset('admin_lte/dist/img/icon.png')}}" alt="User Avatar">
                        </div>
                        <h3 class="widget-user-username"> {{Illuminate\Support\Str::limit($p[0]->nama, 17) }}</h3>
                        <h5 class="widget-user-desc"><a href="{{ action('PenilaiController@showDokdasar',$p[0]->id_user) }}"><span class="info-box-number" style="color: black">Lihat berkas administrasi</span></a></h5>
                      </div>
                      <div class="card-footer p-0">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a href="{{ action('PenilaiController@show',$p[0]->id_user) }}" class="nav-link">
                              Total kegiatan yang diusulkan <span class="float-right badge bg-primary">{{ $p[0]->total_kegiatan }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                              Total Kegiatan yang belum diperiksa <span class="float-right badge bg-danger">{{$p[0]->total_kegiatan - $p[0]->setuju - $p[0]->tolak - $p[0]->pending }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang sudah diperiksa <span class="float-right badge bg-info">{{ $p[0]->setuju + $p[0]->tolak }}</span>
                            </a>                            
                            <a href="#" class="nav-link" style="color: black">
                               &nbsp &nbsp - Total Kegiatan yang disetujui <span class="float-right badge bg-success">{{ $p[0]->setuju }}</span>
                            </a>                                                        
                            <a href="#" class="nav-link" style="color: black">
                               &nbsp &nbsp - Total Kegiatan yang ditolak <span class="float-right badge bg-secondary">{{ $p[0]->tolak }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang dipending <span class="float-right badge bg-warning">{{ $p[0]->pending }}</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                </div>
                @endforeach                 
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Penilai kedua dari</h4>
                </div>

                @foreach($pen2 as $p)
                  <div class="col-md-4">
                    <div class="card card-widget widget-user-2">   
                    @if( ($p[0]->total_kegiatan - $p[0]->setuju - $p[0]->tolak - $p[0]->pending) > 0 )
                      <div class="widget-user-header bg-warning">
                    @else
                      <div class="widget-user-header bg-info">
                    @endif
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="{{asset('admin_lte/dist/img/icon.png')}}" alt="User Avatar">
                        </div>
                        <h3 class="widget-user-username"> {{Illuminate\Support\Str::limit($p[0]->nama, 17) }}</h3>
                        <h5 class="widget-user-desc"><a href="{{ action('PenilaiController@showDokdasar',$p[0]->id_user) }}"><span class="info-box-number" style="color: black">Lihat berkas administrasi</span></a></h5>
                      </div>
                      <div class="card-footer p-0">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a href="{{ action('PenilaiController@show',$p[0]->id_user) }}" class="nav-link">
                              Total kegiatan yang diusulkan <span class="float-right badge bg-primary">{{ $p[0]->total_kegiatan }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                              Total Kegiatan yang belum diperiksa <span class="float-right badge bg-danger">{{$p[0]->total_kegiatan - $p[0]->setuju - $p[0]->tolak - $p[0]->pending }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang sudah diperiksa <span class="float-right badge bg-info">{{ $p[0]->setuju + $p[0]->tolak }}</span>
                            </a>                            
                            <a href="#" class="nav-link" style="color: black">
                               &nbsp &nbsp - Total Kegiatan yang disetujui <span class="float-right badge bg-success">{{ $p[0]->setuju }}</span>
                            </a>                                                        
                            <a href="#" class="nav-link" style="color: black">
                               &nbsp &nbsp - Total Kegiatan yang ditolak <span class="float-right badge bg-secondary">{{ $p[0]->tolak }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang dipending <span class="float-right badge bg-warning">{{ $p[0]->pending }}</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                </div>
                @endforeach    
            </div>
            @endif
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection