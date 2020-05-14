@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Berkas SPMT/STMT - <strong>Isi Data</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url()->previous() }}" class="btn btn-primary float-sm-right">Kembali</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
      <div class="card">
        <div class="card-body">
          <form method="post" action="{{ route('dokumenkeg.store') }}" enctype="multipart/form-data">

            {{ csrf_field() }}
            <style type="text/css">              
                .ui-tooltip {
                    background: #4a4a4a;
                    color: #96f226;
                    border: 2px solid #454545;
                    border-radius: 0px;
                    box-shadow: 0 0 
                }
                .ui-autocomplete {
                    background: #5D9C92;
                    border-radius: 0px;
                }
                .ui-autocomplete.source:hover {
                    background: #454545;
                }

                .ui-menu .ui-menu-item a{
                    background:red;
                    height:10px;
                font-size:8px;}
            </style>
            <div class="form-group">
              <label>Nama Kegiatan/Event/Acara</label>
              <input type="text" name="acara" class="form-control" id="nama_acara">
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
              <input type="text" name="spmt_url" id="spmt_url" placeholder="Copy-Paste Link Berkas Anda Dari Laci/Google Drive/Penyimpanan Cloud Lainnya di Sini" class="form-control">
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
              <input type="text" name="stmt_url" id="stmt_url" placeholder="Copy-Paste Link Berkas Anda Dari Laci/Google Drive/Penyimpanan Cloud Lainnya di Sini" class="form-control">
            </div>
            <br>
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

@push('scripts')
<script>
$(document).ready(function() {
  $( "#nama_acara" ).autocomplete({    
    source: function(request, response) {
      $.ajax({
        url: "{{url('autocomplete')}}",
        data: {
          term : request.term
        },
        dataType: "json",
        success: function(data){
          var resp = $.map(data,function(obj){
                        //console.log(obj.city_name);
                        return obj.nama_acara;
                    });           
          response(resp);
        }
      });
    },
    minLength: 1
  });
});    
</script> 
@endpush