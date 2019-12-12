<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
  <title>SIMPAK 2019</title>
</head>
<body>
  <div class="container">
    <div class="card mt-5">
      <div class="card-header text-center">
        Usulan DUPAK - <strong>TAMBAH DATA</strong>
      </div>
      <div class="card-body">
        <a href="{{ url('/transaksi') }}" class="btn btn-primary">Kembali</a>
        <br/>
        <br/>

        <form method="post" action="{{ route('transaksi.store') }}">

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
            <label>Tanggal Mulai</label>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
            <input type="date" data-date="" data-date-format="DD MMMM YYYY" value="2019-12-09">           
          </div>
          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" name="akhir_acara" class="form-control">            
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
</body>
</html>