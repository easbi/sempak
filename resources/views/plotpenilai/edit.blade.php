@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Daftar Rincian Angka Kredit Yang Dinilai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/') }}" class="btn btn-primary float-sm-right">Beranda</a>
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

          <form method="post" action="{{ route('plotpenilai.update', $id_n) }}">

            @csrf
            @method('PUT')

            <div class="form-group">
              <label>Widyaiswara yang dinilai</label>
              <select id="user_dinilai" name="user_dinilai" class="form-control">
                <option value="{{$plotpenilais->id_user_dinilai}}"> {{$plotpenilais->user_dinilai}}</option>
                @foreach($namas as $key => $nama)
                <option value="{{$key}}"> {{$nama}}</option>
                @endforeach
              </select>     
            </div>
            <div class="form-group">
              <label>Penilai Pertama</label> 
              <select id="user_penilai_1" name="user_penilai_1" class="form-control">
                <option value="{{$plotpenilais->id_user_penilai_1}}"> {{$plotpenilais->penilai1}}</option>
                @foreach($namas as $key => $nama)
                <option value="{{$key}}"> {{$nama}}</option>
                @endforeach
              </select>          
            </div>
            <div class="form-group">
              <label>Penilai Kedua</label>
              <select id="user_penilai_2" name="user_penilai_2" class="form-control">
                <option value="{{$plotpenilais->id_user_penilai_2}}"> {{$plotpenilais->penilai2}}</option>
                @foreach($namas as $key => $nama)
                <option value="{{$key}}"> {{$nama}}</option>
                @endforeach
              </select>               
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
