@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Rincian Kegiatan - <strong>UBAH DATA</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/penilai')}}" class="btn btn-primary float-sm-right">Kembali</a>
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
          @foreach($transaksi as $transaksi)
          <form method="post" action="{{route('transaksi.update', $transaksi->id_transaksi)}}">

            @csrf
            @method('PUT')

            <div class="form-group">
              <label>Unsur Utama</label>
              <select id="unsurutamas" name="unsurutamas" class="form-control">
                {{-- <option value="{{ $transaksi->id_unsur_utama}}" selected disabled>{{ $transaksi->unsur_utama }}</option> --}}
                @foreach($unsurutamas as $key => $unsurutama)
                <option value="{{$key}}"> {{$unsurutama}}</option>
                @endforeach          
              </select>    
            </div>
            <div class="form-group">
              <label>Sub Unsur</label>
              {{-- <input type="text" name="subunsur" id="subunsur" class="form-control" value="{{ $transaksi->kegiatan_sub_unsur }}" readonly="true"> --}}
              <select name="subunsur" id="subunsur" class="form-control">
                <option>--Sub Unsur--</option>
              </select>
            </div>
            <div class="form-group">
              <label>Rincian Kegiatan</label>
              {{-- <input type="text" name="rincian_kegiatan" id="rincian_kegiatan" class="form-control" value="{{ $transaksi->rincian_kegiatan }}" readonly="true"> --}}
              <select name="rinciankegiatan" id="rinciankegiatan" class="form-control">
                <option>--Rincian Kegiatan--</option>
              </select>
            </div>
            <div class="form-group">
              <label>Nama Acara / Diklat</label>
              <input type="text" name="nama_acara" id="nama_acara" class="form-control" value="{{ $transaksi->nama_acara }}">
            </div>
            <div class="form-group">
              <label>Tanggal Mulai</label>
              <input type="date" name="awal_acara" class="form-control" value="{{ $transaksi->tgl_mulai }}">        
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <input type="date" name="akhir_acara" class="form-control" value="{{ $transaksi->tgl_selesai }}">                
            </div>          
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan">{{ $transaksi->keterangan }}</textarea>            
            </div>
            <div class="form-group">
              <label>Angka Kredit</label>
              <input type="text" name="angka_kredit" id="angka_kredit" class="form-control">
            </div> 
            <div class="form-group">
              <label>Berkas</label><br>
              <a href='{{  url('file_rincian_dupak', $transaksi->berkas) }}' class="btn btn-warning" target="_blank">Berkas</a>
            </div>            
            <div class="form-group">
              <br>
              <input type="submit" class="btn btn-success" value="Simpan">
            </div>

          </form>
          @endforeach

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