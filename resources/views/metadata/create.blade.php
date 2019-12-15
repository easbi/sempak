@extends('layouts.frontend.master')
@section('content')
<div class="container">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
  <div class="card mt-5">
    <div class="card-header text-center">
      Data Unsur Utama - <strong>Tambah Data</strong>
    </div>
    <div class="card-body">
      <a href="{{ url('/metadata')}}" class="btn btn-primary">Kembali</a>
      <br/>
      <br/>

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
@endsection