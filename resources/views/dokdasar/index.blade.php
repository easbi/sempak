@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Berkas Administrasi Pokok </h1>
          @if(!empty($dokdasar->sk_pangkat_pns))
             <a href='{{ route('dokdasar.edit', $dokdasar->id_user) }}' class="btn btn-primary float-sm-right">Edit Berkas</a>
          @else
             <a href='{{  url('dokdasar/create') }}' class="btn btn-primary float-sm-right">Isi Berkas</a>
          @endif

        </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
          <div class="form-group">
            <label>SK Pangkat PNS Terakhir</label><br>
            @if(!empty($dokdasar->sk_pangkat_pns))
              <a href='{{  url('public/dok_dasar_dupak/sk_pangkat_pns', $dokdasar->sk_pangkat_pns) }}' class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>SK Jabatan Widyaiswara Terakhir</label><br>
            @if(!empty($dokdasar->sk_jab_wi))
              <a href='{{  url('public/dok_dasar_dupak/sk_jab_wi', $dokdasar->sk_jab_wi) }}' class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>Penetapan Angka Kredit terakhir</label><br>
            @if(!empty($dokdasar->pak))
              <a href='{{  url('public/dok_dasar_dupak/pak', $dokdasar->pak) }}' class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>Kartu Pegawai</label><br>
            @if(!empty($dokdasar->pak))
              <a href='{{  url('public/dok_dasar_dupak/karpeg', $dokdasar->karpeg) }}' class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>DP3 Satu Tahun Terakhir</label><br>
            @if(!empty($dokdasar->dp3))
              <a href='{{  url('public/dok_dasar_dupak/dp3', $dokdasar->dp3) }}' class="btn btn-success" target="_blank">Berkas</a>
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