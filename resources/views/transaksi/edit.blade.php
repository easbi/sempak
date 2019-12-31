@extends('layouts.frontend.master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Rincian DUPAK - <strong>Edit Data</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/transaksi')}}" class="btn btn-primary float-sm-right">Kembali</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
      <div class="card">
        <div class="card-body">    
            <form method="post" action="{{route('transaksi.update', $transaksi->id_transaksi)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label>Unsur Utama</label>
                  <input type="text" name="unsurutamas" id="unsurutamas" class="form-control" value="{{ $transaksi->unsur_utama }}" readonly="true">
                </div>
                <div class="form-group">
                  <label>Sub Unsur</label>
                  <input type="text" name="subunsur" id="subunsur" class="form-control" value="{{ $transaksi->kegiatan_sub_unsur }}" readonly="true">
                </div>
                <div class="form-group">
                  <label>Rincian Kegiatan</label>
                  <input type="text" name="rincian_kegiatan" id="rincian_kegiatan" class="form-control" value="{{ $transaksi->rincian_kegiatan }}" readonly="true">
                </div>
                <div class="form-group">
                  <label>Nama Acara / Diklat</label>
                  <input type="text" name="nama_acara" id="nama_acara" class="form-control" value="{{ $transaksi->nama_acara }}" readonly="true">
                </div>
                <div class="form-group">
                  <label>Tanggal Mulai</label>
                  <input type="date" name="awal_acara" class="form-control" value="{{ $transaksi->tgl_mulai }}">        
                </div>
                <div class="form-group">
                  <label>Tanggal Selesai</label>
                  <input type="date" name="akhir_acara" class="form-control" value="{{ $transaksi->tgl_selesai }}">                
                </div>          
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="keterangan">{{ $transaksi->keterangan }}</textarea>            
                </div>
                <div class="form-group">
                  <label>Angka Kredit</label>
                  <input type="text" name="angka_kredit" id="angka_kredit" class="form-control" value="{{ $transaksi->angka_kredit_usul }}">
                </div> 
                <div class="form-group">
                  <label>Berkas Sebelumnya</label><br>
                  <a href='{{  url('public/file_rincian_dupak', $transaksi->berkas) }}' class="btn btn-warning" target="_blank"><i class="fas fa-book"></i></a>
                </div>  
                <div class="form-group">
                  <label>Ganti Berkas *</label><br>
                  <input type="file" name="berkas">
                </div>           
                <div class="form-group">
                  <br>
                  <input type="submit" class="btn btn-success" value="Simpan">
                </div>              
            </form>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection