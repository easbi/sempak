@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Periode Pengusulan - <strong>TAMBAH DATA</strong></h1>
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
    <div class="container">
      <div class="card">
        <div class="card-body">

          <form method="post" action="{{ route('plotpenilai.store') }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Widyaiswara yang dinilai</label>
              <select id="user_dinilai" name="user_dinilai" class="form-control">
                <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->nama }}</option>
              </select>     
            </div>
            <div class="form-group">
              <label>Periode Awal untuk Penilaian</label>
              <input type="date" name="p_awal" class="form-control">  
            </div>
            <div class="form-group">
              <label>Periode Akhir untuk Penilaian</label>
              <input type="date" name="p_akhir" class="form-control">  
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