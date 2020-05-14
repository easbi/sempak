@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Berkas Dokumen Usulan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/dokutkusul') }}" class="btn btn-primary float-sm-right">Dokumen Usulan</a>
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
          <form method="post" action="{{route('dokutkusul.update', $dokutkusul->id_user)}}" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group">
              <label>Surat Pengantar</label>
              <input type="file" name="pengantar" class="form-control">            
            </div>
            <div class="form-group">
              <label>DUPAK</label>
              <input type="file" name="dupak" class="form-control">            
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
