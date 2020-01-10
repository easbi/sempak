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
      <div class="container">
        <div class="card">
          <div class="card-body">
            <form method="post" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Unsur Utama</label>
                <select id="unsurutamas" name="unsurutamas" class="form-control" disabled>
                  <option value="{{$kegiatan->id}}"> {{$kegiatan->unsur_utama}}</option>
                </select>
              </div>
              <div class="form-group">
                <label>Sub Unsur</label>
                <select name="subunsur" id="subunsur" class="form-control" disabled>
                <option value="{{$kegiatan->id_sub_unsur}}"> {{$kegiatan->kegiatan_sub_unsur}}</option>
                </select>
              </div>                      
              <div class="form-group">
                <label>Rincian Kegiatan</label>
                <select name="rinciankegiatan" id="rinciankegiatan" class="form-control" disabled>
                <option value="{{$kegiatan->id_rincian_kegiatan}}"> {{$kegiatan->rincian_kegiatan}}</option>
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
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" name="awal_acara" class="form-control" min="{{date_format($periode['awal'],'Y-m-d')}}" max="{{date_format($periode['akhir'],'Y-m-d')}}">            
              </div>
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" name="akhir_acara" class="form-control" min="{{date_format($periode['awal'],'Y-m-d')}}" max="{{date_format($periode['akhir'],'Y-m-d')}}">            
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
  jQuery('#nama_acara').on('change', function(){
    if(jQuery(this).val() == 1000){
      window.location.href = '{{ url('/masteracara')}}'
    }
  })
</script>
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
