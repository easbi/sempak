@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Generate <strong>DUPAK</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <a href="{{ url('/transaksi') }}" class="btn btn-primary float-sm-right">Kembali</a>
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
        <form method="post" action="{{ url('generatedupak') }}" enctype="multipart/form-data">

          {{ csrf_field() }}

          <div class="form-group">
            <label>Periode Awal</label>
            <input type="date" name="periode_awal" class="form-control periodepicker">            
          </div>
          <div class="form-group">
            <label>Periode Akhir</label>
            <input type="date" name="periode_akhir" class="form-control periodepicker"> 
          </div>          
          <div class="form-group">
            <br>
            <input type="submit" class="btn btn-success" value="Generate">
          </div>

        </form>

      </div>
    </div>
  </div>
    </section>
    <!-- /.content -->
</div>
@endsection
