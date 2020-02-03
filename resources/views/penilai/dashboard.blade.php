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
                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{Illuminate\Support\Str::limit($p->nama, 17) }}</span>
                            <a href="{{ action('PenilaiController@show',$p->id_user) }}"><span class="info-box-number">{{ $p->total_kegiatan }} Kegiatan</span></a>
                            <a href="{{ action('PenilaiController@showDokdasar',$p->id_user) }}"><span class="info-box-number">Lihat Dokumen Dasar</span></a>
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
                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{Illuminate\Support\Str::limit($p->nama, 17) }}</span>
                            <a href="{{ action('PenilaiController@show',$p->id_user) }}"><span class="info-box-number">{{ $p->total_kegiatan }} KEegiatan</span></a>
                            <a href="{{ action('PenilaiController@showDokdasar',$p->id_user) }}"><span class="info-box-number">Lihat Dokumen Dasar</span></a>
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