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
          <a href="{{ url('/dokumenkeg') }}" class="btn btn-primary float-sm-right">Kembali ke Tabel</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
  <section class="content">    
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <div class="card-body">
          <form method="post" action="{{route('dokumenkeg.update', $dokumenkeg->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <style type="text/css">
                .ui-autocomplete {
                    background: #5D9C92;
                    border-radius: 0px;
                };
                    height:10px;
                font-size:8px;}
            </style>
            <div class="form-group">
              <label>Nama Kegiatan/Event/Acara</label>
              <input type="text" name="acara" class="form-control" id="nama_acara" value="{{$dokumenkeg->acara}}">
            </div>
            <br>
            <div class="form-group">
              <label>Dokumen Surat Perintah Melaksanakan Kegiatan (SPMT)</label> <br>
              <input type="checkbox" id="checkbox_spmt" name="checkbox_spmt">
              <label for="checkbox_spmt"><small>Cek List Jika Berkas Dalam Bentuk URL/Link</small></label><br>              
              <script type="text/javascript">
                $(function () {
                  $('input[name="spmt_url"]').hide();
                  //show it when the checkbox_spmt is clicked
                  $('input[name="checkbox_spmt"]').on('click', function () {
                    if ($(this).prop('checked')) {
                      $('input[name="spmt_url"]').fadeIn();
                      $('input[name="spmt_berkas"]').hide();
                    } else {
                      $('input[name="spmt_url"]').hide();
                      $('input[name="spmt_berkas"]').fadeIn();
                    }
                  });
                });
              </script>
              <input type="file" name="spmt_berkas" class="form-control">
              <input type="text" name="spmt_url" id="spmt_url" placeholder="Copy-Paste Link Berkas Anda Dari Laci/Google Drive/Penyimpanan Cloud Lainnya di Sini" class="form-control" value="{{$dokumenkeg->spmt_url}}">
            </div>
            <br>
            <div class="form-group">
              <label>Dokumen Surat Telah Melaksanakan Kegiatan (STMT)</label> <br>
              <input type="checkbox" id="checkbox_stmt" name="checkbox_stmt">
              <label for="checkbox_stmt"><small>Cek List Jika Berkas Dalam Bentuk URL/Link</small></label><br>              
              <script type="text/javascript">
                $(function () {
                  $('input[name="stmt_url"]').hide();
                  //show it when the checkbox_stmt is clicked
                  $('input[name="checkbox_stmt"]').on('click', function () {
                    if ($(this).prop('checked')) {
                      $('input[name="stmt_url"]').fadeIn();
                      $('input[name="stmt_berkas"]').hide();
                    } else {
                      $('input[name="stmt_url"]').hide();
                      $('input[name="stmt_berkas"]').fadeIn();
                    }
                  });
                });
              </script>
              <input type="file" name="stmt_berkas" class="form-control">
              <input type="text" name="stmt_url" id="stmt_url" placeholder="Copy-Paste Link Berkas Anda Dari Laci/Google Drive/Penyimpanan Cloud Lainnya di Sini" class="form-control" value="{{$dokumenkeg->stmt_url}}">
            </div>
            <br>
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
