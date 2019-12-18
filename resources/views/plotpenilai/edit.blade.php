@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Acara / Diklat - <strong>TAMBAH DATA</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/masteracara')}}" class="btn btn-primary float-sm-right">Kembali</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    
  </section>
  <!-- /.content -->
</div>
  <div class="container">
    <div class="card">
      <div class="card-body">

        <form method="post" action="{{route('masteracara.update', $masteracara->id)}}">

          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Nama Acara / DIKLAT</label>
            <input type="text" name="nama_acara" class="form-control" value="{{ $masteracara->nama_acara }}">            
          </div>
          <div class="form-group">
            <label>Tanggal Mulai Acara</label>
            <input type="date" name="awal_acara" class="form-control" value="{{ $masteracara->awal_acara }}">            
          </div>
          <div class="form-group">
            <label>Tanggal Selesai Acara</label>
            <input type="date" name="akhir_acara" class="form-control" value="{{ $masteracara->akhir_acara }}">            
          </div>
          <div class="form-group">
            <br>
            <input type="submit" class="btn btn-success" value="Simpan">
          </div>

        </form>

      </div>
    </div>
  </div>
@endsection