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
          <h1 class="m-0 text-dark">Data Dokumen Dasar </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
         {{--  <a href="{{ url('/dokdasar/create') }}" class="btn btn-primary float-sm-right">Input Acara Baru</a> --}}
     </div>
 </div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                  <label>SK Pangkat PNS Terakhir</label><br>
                  <a href='{{  url('public/dok_dasar_dupak/sk_pangkat_pns', $dokdasar->sk_pangkat_pns) }}' class="btn btn-warning" target="_blank">Berkas</a>
                </div>
                <div class="form-group">
                  <label>SK Jabatan Widyaiswara Terakhir</label><br>
                  <a href='{{  url('public/dok_dasar_dupak/sk_jab_wi', $dokdasar->sk_jab_wi) }}' class="btn btn-warning" target="_blank">Berkas</a>
                </div>
                <div class="form-group">
                  <label>Penetapan Angka Kredit terakhir</label><br>
                  <a href='{{  url('public/dok_dasar_dupak/pak', $dokdasar->pak) }}' class="btn btn-warning" target="_blank">Berkas</a>
                </div>
                <div class="form-group">
                  <label>Kartu Pegawai</label><br>
                  <a href='{{  url('public/dok_dasar_dupak/karpeg', $dokdasar->karpeg) }}' class="btn btn-warning" target="_blank">Berkas</a>
                </div>
                <div class="form-group">
                  <label>DP3 Satu Tahun Terakhir</label><br>
                  <a href='{{  url('public/dok_dasar_dupak/dp3', $dokdasar->dp3) }}' class="btn btn-warning" target="_blank">Berkas</a>
                </div>
          </div>
      </div>
  </div>
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollX": true
        });
    } );
</script>

@endsection
