@extends('layouts.frontend.master')
@section('content')
  <div class="container">
    <div class="card mt-5">
      <div class="card-header text-center">
        Data Acara / Diklat - <strong>TAMBAH DATA</strong>
      </div>
      <div class="card-body">
        <a href="{{ url('/masteracara')}}" class="btn btn-primary">Kembali</a>
        <br/>
        <br/>

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