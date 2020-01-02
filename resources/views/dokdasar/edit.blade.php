@extends('layouts.frontend.master')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Berkas Administrasi Pokok</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/dokdasar') }}" class="btn btn-primary float-sm-right">Dokumen Dasar</a>
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
          <form method="post" action="{{route('dokdasar.update', $dokdasar->id_user)}}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

             <div class="form-group">
              <label>SK Pangkat PNS Terakhir</label>
              <input type="file" name="sk_pangkat_pns" class="form-control">
            </div>
            <div class="form-group">
              <label>SK Jabatan Widyaiswara Terakhir</label>
              <input type="file" name="sk_jab_wi" class="form-control">            
            </div>
            <div class="form-group">
              <label>Penetapan Angka Kredit Terakhir</label>
              <input type="file" name="pak" class="form-control">            
            </div>
            <div class="form-group">
              <label>Kartu Pegawai</label>
              <input type="file" name="karpeg" class="form-control">            
            </div>
            <div class="form-group">
              <label>DP3 Satu tahun Terakhir</label>
              <input type="file" name="dp3" class="form-control">            
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
  } );
</script>

@endsection
