@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Rincian Kegiatan - <strong>TAMBAH DATA</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/rinciankegiatan')}}" class="btn btn-primary float-sm-right">Kembali</a>
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
  </section>
  <!-- /.content -->
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