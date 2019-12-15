@extends('layouts.frontend.master')
@section('content')
<div class="container">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
  <div class="card mt-5">
    <div class="card-header text-center">
      Data Rincian Kegiatan - <strong>TAMBAH DATA</strong>
    </div>
    <div class="card-body">
      <a href="{{ url('/rinciankegiatan')}}" class="btn btn-primary">Kembali</a>
      <br/>
      <form method="post" action="{{ route('rinciankegiatan.store') }}">

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
          <input type="text" name="rincian" class="form-control">

        </div>
        <br><br>
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
  jQuery(document).ready(function ()
  {
    jQuery('select[name="unsurutamas"]').on('change',function(){
     var unsurutamaID = jQuery(this).val();
     if(unsurutamaID)
     {
      jQuery.ajax({
       url : 'getSubunsurList/' +unsurutamaID,
       type : "GET",
       dataType : "json",
       success:function(data)
       {
        console.log(data);
        jQuery('select[name="subunsur"]').empty();
        jQuery.each(data, function(key,value){
         $('select[name="subunsur"]').append('<option value="'+ key +'">'+ value +'</option>');
       });
      }
    });
    }
    else
    {
      $('select[name="subunsur"]').empty();
    }
  });
  });
</script>
@endsection