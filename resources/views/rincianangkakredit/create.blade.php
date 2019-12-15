@extends('layouts.frontend.master')
@section('content')
<div class="container">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   
  <div class="card mt-5">
    <div class="card-header text-center">
      Data Rincian Angka Kredit - <strong>TAMBAH DATA</strong>
    </div>
    <div class="card-body">
      <a href="{{ url('/rincianangkakredit')}}" class="btn btn-primary">Kembali</a>
      <br/>
      <br/>

      <form method="post" action="{{ route('rincianangkakredit.store') }}">

        {{ csrf_field() }}

        <div class="form-group">
          <label>Unsur Utama</label>
          <select id="unsurutamas" name="unsurutamas" class="form-control">
            <option value="" selected disabled>Select</option>
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
          <label>Tingkatan Widyaiswara</label>
          <select id="id_tingkatan_wi" name="id_tingkatan_wi" class="form-control">
            <option value="" selected disabled>Select</option>
            @foreach($tingkatanwi as $key => $tw)
            <option value="{{$key}}"> {{$tw}}</option>
            @endforeach
          </select>
        </div> 
        <div class="form-group">
          <label>Angka Kredit</label>
          <input type="text" name="angka_kredit" class="form-control">
        </div> 
        <div class="form-group">
          <label>Kode Kegiatant</label>
          <input type="text" name="kk" class="form-control">
        </div> 
        <div class="form-group">
          <br>
          <input type="submit" class="btn btn-success" value="Simpan">
        </div>

      </form>

    </div>
  </div>
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
</script>
@endsection