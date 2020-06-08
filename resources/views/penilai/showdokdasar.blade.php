@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Berkas Administrasi {{ $nama_dinilai->nama }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url()->previous() }}" class="btn btn-primary float-sm-right">Kembali</a>
        </div>
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
 <section class="content">
  <div class="container">
    <label>Berkas Administrasi Pokok</label><br>
    <div class="card">
      <div class="card-body">
          <div class="form-group">
            <label>SK Pangkat PNS Terakhir</label><br>
            @if(!empty($dokdasar->sk_pangkat_pns))
              <a href="{{  url('public/dok_dasar_dupak/sk_pangkat_pns', $dokdasar->sk_pangkat_pns) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>SK Jabatan Widyaiswara Terakhir</label><br>
            @if(!empty($dokdasar->sk_jab_wi))
              <a href="{{  url('public/dok_dasar_dupak/sk_jab_wi', $dokdasar->sk_jab_wi) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>Penetapan Angka Kredit terakhir</label><br>
            @if(!empty($dokdasar->pak))
              <a href="{{  url('public/dok_dasar_dupak/pak', $dokdasar->pak) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>Kartu Pegawai</label><br>
            @if(!empty($dokdasar->pak))
              <a href="{{  url('public/dok_dasar_dupak/karpeg', $dokdasar->karpeg) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>DP3 Satu Tahun Terakhir</label><br>
            @if(!empty($dokdasar->dp3))
              <a href="{{  url('public/dok_dasar_dupak/dp3', $dokdasar->dp3) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
      </div>
    </div>
    <label>Berkas Pengusulan</label><br>
    <div class="card">
      <div class="card-body">
          <div class="form-group">
            <label>Surat Pengantar</label><br>
            @if(!empty($dokdasar->pengantar))
              <a href="{{  url('public/dok_dasar_dupak/pengantar', $dokdasar->pengantar) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>DUPAK</label><br>
            @if(!empty($dokdasar->dupak))
              <a href="{{  url('public/dok_dasar_dupak/dupak', $dokdasar->dupak) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "scrollX": true
    });
  } );
</script>
@endpush