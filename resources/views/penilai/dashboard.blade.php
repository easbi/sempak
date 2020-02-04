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
            <div class="row">
                <div class="col-sm-12">
                    <h4>Penilai pertama dari</h4>
                </div>
                @foreach($pen1 as $p)
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-warning">
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="{{asset('admin_lte/dist/img/icon.png')}}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{Illuminate\Support\Str::limit($p->nama, 17) }}</h3>
                        <h5 class="widget-user-desc"><a href="{{ action('PenilaiController@showDokdasar',$p->id_user) }}"><span class="info-box-number">Lihat berkas administrasi</span></a></h5>
                      </div>
                      <div class="card-footer p-0">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a href="{{ action('PenilaiController@show',$p->id_user) }}" class="nav-link">
                              Total kegiatan yang diusulkan <span class="float-right badge bg-primary">{{ $p->total_kegiatan }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                              Total Kegiatan yang belum diperiksa <span class="float-right badge bg-danger">{{$p->total_kegiatan - $p->setuju - $p->tolak  }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang sudah diperiksa <span class="float-right badge bg-success">{{ $p->setuju + $p->tolak }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang dipending <span class="float-right badge bg-info">{{ $p->pending }}</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
                @endforeach                      
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Penilai kedua dari</h4>
                </div>
                @foreach($pen2 as $p)
                <div class="col-md-4">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header bg-warning">
                        <div class="widget-user-image">
                          <img class="img-circle elevation-2" src="{{asset('admin_lte/dist/img/icon.png')}}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{Illuminate\Support\Str::limit($p->nama, 17) }}</h3>
                        <h5 class="widget-user-desc"><a href="{{ action('PenilaiController@showDokdasar',$p->id_user) }}"><span class="info-box-number">Lihat berkas administrasi</span></a></h5>
                      </div>
                      <div class="card-footer p-0">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a href="{{ action('PenilaiController@show',$p->id_user) }}" class="nav-link">
                              Total kegiatan yang diusulkan <span class="float-right badge bg-primary">{{ $p->total_kegiatan }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                              Total Kegiatan yang belum diperiksa <span class="float-right badge bg-danger">{{$p->total_kegiatan - $p->setuju - $p->tolak  }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang sudah diperiksa <span class="float-right badge bg-success">{{ $p->setuju + $p->tolak }}</span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link" style="color: black">
                               Total Kegiatan yang dipending <span class="float-right badge bg-info">{{ $p->pending }}</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                @endforeach 
            </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection