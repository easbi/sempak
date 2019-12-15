@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Unsur Utama - <strong>Tambah Data</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/metadata')}}" class="btn btn-primary float-sm-right">Kembali</a>
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
          <form method="post" action="{{ route('metadata.store') }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Unsur Utama</label>
              <input type="text" name="unsur_utama" class="form-control">
            </div>
            <div class="form-group">
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