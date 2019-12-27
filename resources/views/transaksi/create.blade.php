@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usulan DUPAK - <strong>TAMBAH DATA</strong></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <a href="{{ url('/transaksi') }}" class="btn btn-primary float-sm-right">Kembali</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
    <div class="container">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">

          {{ csrf_field() }}

          <div class="form-group">
            <label>Unsur Utama</label>
            <select id="unsurutamas" name="unsurutamas" class="form-control">
              @foreach($unsurutamas as $key => $unsurutama)
              <option value="{{$key}}"> {{$unsurutama}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Sub Unsur</label>
            <select name="subunsur" id="subunsur" class="form-control">
              <option>--Sub Unsur--</option>
            </select>
          </div>                      
          <div class="form-group">
            <label>Rincian Kegiatan</label>
            <select name="rinciankegiatan" id="rinciankegiatan" class="form-control">
              <option>--Rincian Kegiatan--</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Acara / Diklat</label>
            <select id="nama_acara" name="nama_acara" class="form-control">
              <option value="" selected disabled>Select</option>
              @foreach($nama_acaras as $key => $nama_acara)
              <option value="{{$key}}"> {{$nama_acara}}</option>
              @endforeach
              <option value="1000">-- <i>Tambahkan Acara, Jika Opsi Acara /Diklat tidak ada di sini</i> --</option><i></i>
            </select>
          </div>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

          <script type="text/javascript">
            jQuery('#nama_acara').on('change', function(){
              if(jQuery(this).val() == 1000){
                window.location.href = '{{ url('/masteracara')}}'
              }
            })
          </script>
          <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="awal_acara" class="form-control">            
          </div>
          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" name="akhir_acara" class="form-control">            
          </div>          
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="keterangan"></textarea>            
          </div>
          <div class="form-group">
            <label>Angka Kredit</label>
            <input type="text" name="angka_kredit" id="angka_kredit" class="form-control" readonly="true">
          </div> 
          <div class="form-group">
            <label>Berkas</label>
            <input type="file" name="berkas" class="form-control">
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
<script type="text/javascript">
  $('#unsurutamas').change(function(){
    var unsurutamasID = $(this).val();    
    if(unsurutamasID){
      $.ajax({
       type:"GET",
       url:"{{url('rincianangkakredit/getSubunsurList')}}?unsurutamas_id="+unsurutamasID,
       success:function(res){               
        if(res){
          $("#subunsur").empty();
          $("#subunsur").append('<option>Select</option>');
          $.each(res,function(key,value){
            $("#subunsur").append('<option value="'+key+'">'+value+'</option>');
          });
        }else{
          $("#subunsur").empty();
        }
      }
    });
    }else{
      $("#subunsur").empty();
      $("#rinciankegiatan").empty();
    }      
  });
  $('#subunsur').on('change',function(){
    var subunsurID = $(this).val();    
    if(subunsurID){
      $.ajax({
       type:"GET",
       url:"{{url('rincianangkakredit/getRinciankegiatanList')}}?subunsur_id="+subunsurID,
       success:function(res){               
        if(res){
          $("#rinciankegiatan").empty();
          $.each(res,function(key,value){
            $("#rinciankegiatan").append('<option value="'+key+'">'+value+'</option>');
          });

        }else{
         $("#rinciankegiatan").empty();
       }
     }
   });
    }else{
      $("#rinciankegiatan").empty();
    }
  });
  $('#rinciankegiatan').on('click',function(){
    var rinciankegiatanID = $(this).val();    
    if(rinciankegiatanID){
      $.ajax({
       type:"GET",
       url:"{{url('rincianangkakredit/getAngkaKredit')}}?rinciankegiatan_id="+rinciankegiatanID,
       success:function(res){               
        if(res){
          console.log(res);
          $("#angka_kredit").val(res);
        }else{
         $("#angka_kredit").empty();
       }
     }
   });
    }else{
      $("#angka_kredit").empty();
    }

  });
</script>
@endsection
