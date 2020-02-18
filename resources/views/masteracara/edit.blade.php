@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Daftar Acara</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/masteracara/create') }}" class="btn btn-primary float-sm-right">Input Acara Baru</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">    
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
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
      <!-- /.row (main row) -->
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection
