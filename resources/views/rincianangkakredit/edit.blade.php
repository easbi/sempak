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
          <a href="{{ url('/rincianangkakredit') }}" class="btn btn-primary float-sm-right">Rincian Angka Kredit</a>
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

          <form method="post" action="{{ route('rincianangkakredit.update', $rincianangkakredit->id_rinci_ak) }}">

            @csrf
            @method('PUT')

            <div class="form-group">
              <label>Unsur Utama</label>
              <input type="text" name="unsurutamas" class="form-control" value="{{ $rincianangkakredit->unsur_utama }}" readonly="">
            </div>
            <div class="form-group">
              <label>Sub Unsur</label>
              <input type="text" name="subunsur" class="form-control" value="{{ $rincianangkakredit->kegiatan_sub_unsur }}" readonly="">
            </div>                      
            <div class="form-group">
              <label>Rincian Kegiatan</label>
              <input type="text" name="rinciankegiatan" class="form-control" value="{{ $rincianangkakredit->rincian_kegiatan }}" readonly="">
            </div>
            <div class="form-group">
              <label>Tingkatan Widyaiswara</label>
              <input type="text" name="tingkatanwi" class="form-control" value="{{ $rincianangkakredit->nama_tingkatan }}" readonly="">
            </div>
            <div class="form-group">
              <label>Satuan</label>
              <input type="text" name="satuan" class="form-control" value="{{ $rincianangkakredit->satuan }}" readonly="">
            </div> 
            <div class="form-group">
              <label>Kode Kegiatan</label>
              <input type="text" name="kk" class="form-control" value="{{ $rincianangkakredit->kk }}" readonly="">
            </div>              
            <div class="form-group">
              <label>Angka Kredit</label>
              <input type="text" name="angka_kredit" class="form-control" value="{{ $rincianangkakredit->angka_kredit }}">
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
