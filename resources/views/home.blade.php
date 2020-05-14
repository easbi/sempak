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
                    <h1 class="m-0 text-dark">Status Pengajuan DUPAK</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @foreach($result as $periode)
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ url('/periode/'.date_format($periode['awal'],'Y').'/'.date_format($periode['awal'],'m')) }}" style="color:inherit;"><h4><u>{{ $periode["judul"] }}</u></h4></a>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $periode["proses_total"] }}</h3>
                            <p>Total Kegiatan Diinput</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-soup-can"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $periode["proses_11"] }}</h3>
                            <p>Kegiatan Sedang diproses Evaluasi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $periode["proses_12"] }}</h3>
                            <p>Kegiatan Yang Disetujui</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-thumbsup"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $periode["proses_13"] }}</h3>
                            <p>Kegiatan Yang Ditolak</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion ion-thumbsdown"></i>
                        </div>
                    </div>
                </div>
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