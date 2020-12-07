@extends('layouts.frontend.master')
@section('content')


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4>Tambah Usulan Kegiatan : <strong>KK {{$kk}}</strong> </h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Daftar Periode</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/periode/'.date_format($periode['awal'],'Y').'/'.date_format($periode['awal'],'m')) }}">{{$periode['judul']}}</a></li>
            <li class="breadcrumb-item" active>KK {{$kk}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form method="post" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
              <label>Unsur Utama</label>
              <input type="text" name="unsurutamas" style="display:none;" value="{{$kegiatan->id}}">
              <input type="text" class="form-control" readonly="true" value="{{$kegiatan->unsur_utama}}">
            </div>
            <div class="form-group">
              <label>Sub Unsur</label>
              <input type="text" name="subunsur" style="display:none;" value="{{$kegiatan->id_sub_unsur}}">
              <input type="text" class="form-control" readonly="true" value="{{$kegiatan->kegiatan_sub_unsur}}">
            </div>                      
            <div class="form-group">
              <label>Rincian Kegiatan</label>
              <input type="text" name="rinciankegiatan" style="display:none;" value="{{$kegiatan->id_rincian_kegiatan}}">
              <input type="text" class="form-control" readonly="true" value="{{$kegiatan->rincian_kegiatan}}">
            </div>
            <div class="form-group">
              <label>Nama Acara / Diklat</label>
              <select id="nama_acara" name="nama_acara" class="form-control">
                <option value="" selected disabled>Select</option>
                @foreach($nama_acaras as $key => $nama_acara)
                <option value="{{$key}}"> {{$nama_acara}}</option>
                @endforeach
                <option value="1000">-- <i>Tambahkan Acara & Dokumen SPMT dan STMT dahulu, Jika Opsi yang anda inginkan tidak ada di sini</i> --</option><i></i>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Mulai</label>
              <input type="date" name="awal_acara" class="form-control" min="{{date_format($periode['awal'],'Y-m-d')}}" max="{{date_format($periode['akhir'],'Y-m-d')}}">            
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <input type="date" name="akhir_acara" class="form-control" min="{{date_format($periode['awal'],'Y-m-d')}}">            
            </div>          
            <div class="form-group">
              <label>Mata Diklat / Keterangan Lainnyaa </label>
              <textarea class="form-control" name="keterangan"></textarea>            
            </div>
            <div class="form-group">
              <label>Kuantitas</label>
              <input type="number" name="kuantitas" id="kuantitas" class="form-control" value="1">
            </div> 
            <div class="form-group">
              <label>Angka Kredit Usulan</label>
              <input type="text" name="kk" style="display:none;" value="{{$kk}}">
              <input type="text" name="ak_usul" id="ak_usul" class="form-control" readonly="true" value="{{$kegiatan->angka_kredit}}">
            </div>
            <br>
            <!-- <div class="form-group">
              <label>Pilih Referensi Berkas STMP dan SPMK</label>
              <input type="file" name="letter_file">
            </div> -->
            <div class="form-group">
              <input type="checkbox" id="checkbox" name="checkbox">
              <label for="checkbox">Gunakan link/url</label><br>
              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
              <script type="text/javascript">
                $(function () {
                  $('input[name="link"]').hide();
                  //show it when the checkbox is clicked
                  $('input[name="checkbox"]').on('click', function () {
                    if ($(this).prop('checked')) {
                      $('input[name="link"]').fadeIn();
                      $('input[name="berkas"]').hide();
                    } else {
                      $('input[name="link"]').hide();
                      $('input[name="berkas"]').fadeIn();
                    }
                  });
                });
              </script>
              <label>Berkas</label><br>
              <input type="file" name="berkas">
              <input type="text" name="link" id="link" placeholder="Copy-Paste Link Berkas Anda Dari Laci/Google Drive/Penyimpanan Cloud Lainnya di Sini">
            </div>
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
<!-- dropdown.blade.php -->
@endsection

@push('scripts')
<!-- Script -->
<script src="{{asset('select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
      // CSRF Token
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $(document).ready(function(){

        $( "#selUser" ).select2({
          ajax: { 
            url: "{{route('transaksi.getAcara')}}",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              console.log(params);
              return {
                _token: CSRF_TOKEN,
                search: params.term // search term
              };
            },
            processResults: function (response) {
              console.log(response);
              return {
                results: response
              };
            },
            cache: true
          }

        });

      });
    </script>
    
    <script type="text/javascript">
      jQuery('#nama_acara').on('change', function(){
        if(jQuery(this).val() == 1000){
          //window.location.href = '{{ url('/dokumenkeg')}}'
          window.open('{{ url('/dokumenkeg')}}', '_blank');
        }
      })

      $('#kuantitas').on('change',function(){
        var kuantitas = $(this).val();
        $("#ak_usul").val(kuantitas*{{$kegiatan->angka_kredit}});    
      });
    </script>
    @endpush
