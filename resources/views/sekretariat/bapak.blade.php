@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2 class="m-0 text-dark">BERITA ACARA PENILAIAN ANGKA KREDIT</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/')}}" class="btn btn-primary float-sm-right">Kembali Ke Beranda</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="card">
        <div class="card-body">
          <table id="example" class="display" style='font-size:70%'>
            <thead style="background-color:#eefeff">
              <tr style="text-align:center;">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama / NIP</th>        
                <th rowspan="2">Jabatan</th>
                <th rowspan="2">AK Awal</th>
                <th colspan="2">AK yang diperlukan</th>
                <th colspan="2">AK periode sebelumnya</th>
                <th colspan="2">AK yang diusulkan</th> 
                <th colspan="2">Hasil Penilaian TPI</th> 
                <th colspan="2">Jumlah perolehan (6+8)</th>  
                <th colspan="2">Jumlah perolehan yang dipertimbangkan</th> 
                <th rowspan="2">Kumulatif (4+10)</th>
                <th rowspan="2">AK harus dicapai</th>
                <th rowspan="2">Keterangan</th>       
              </tr>
              <tr style="text-align:center;">
                <th>Kode</th>
                <th>AK</th>
                <th>Kode</th>
                <th>AK</th>
                <th>Kode</th>
                <th>AK</th>
                <th>Kode</th>
                <th>AK</th>
                <th>Kode</th>
                <th>AK</th>
                <th>Kode</th>
                <th>AK</th>
              </tr>
              <tr style="text-align:center;">
                <th>(1)</th>
                <th>(2)</th>
                <th>(3)</th>
                <th>(4)</th>
                <th colspan="2">(5)</th>
                <th colspan="2">(6)</th>
                <th colspan="2">(7)</th>
                <th colspan="2">(8)</th>
                <th colspan="2">(9)</th>
                <th colspan="2">(10)</th>
                <th>(11)</th>
                <th>(12)</th>
                <th>(13)</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($temp_su as $us)
                <?php $s=0; ?>
                @foreach ($us['array1lagi'] as $al)
                  @if($s==0)
                    <td style="border-bottom:0;">{{$us['id_user']}}</td>
                    <td style="border-bottom:0;">{{$us['nama']}}</td>
                    <td style="border-bottom:0;">{{$us['jabatan']}}</td>                    
                    <td style="border-bottom:0;">0</td>
                  @else
                    <td style="border-top:0; border-bottom:0;"></td>
                    <td style="border-top:0; border-bottom:0;"></td>
                    <td style="border-top:0; border-bottom:0;"></td>                    
                    <td style="border-top:0; border-bottom:0;"></td>
                  @endif
                    <td>{{ $al['kode'] }}</td>
                    <td></td>
                    <td>{{ $al['kode'] }}</td>
                    <td></td>
                    <td>{{ $al['kode'] }}</td>
                    <td>
                      {{ number_format($al['usul'], 3, ",",".") }}
                    </td>
                    <td>U</td>
                    <td>                    
                      {{ number_format($al['ak'], 3, ",",".") }}
                    </td>
                    <td>{{ $al['kode'] }}</td>
                    <td></td>
                    <td>{{ $al['kode'] }}</td>
                    <td></td>
                    @if($s==0)
                      <td style="border-bottom:0;"></td>
                      <td style="border-bottom:0;"></td>
                      <td style="border-bottom:0;"></td>
                    @else
                      <td style="border-top:0; border-bottom:0;"></td>
                      <td style="border-top:0; border-bottom:0;"></td>                    
                      <td style="border-top:0; border-bottom:0;"></td>
                    @endif                         
                  </tr>
                  <?php $s++; ?>
                @endforeach
                @foreach ($us['kegiatans'] as $uu)
                <tr>
                  <td style="border-top:0; border-bottom:0;"></td>
                  <td style="border-top:0; border-bottom:0;"></td>
                  <td style="border-top:0; border-bottom:0;"></td>                    
                  <td style="border-top:0; border-bottom:0;"></td>                      
                  <td>{{ $uu['kode'] }}</td>
                  <td></td>
                  <td>{{ $uu['kode'] }}</td>
                  <td></td>
                  <td>{{ $uu['kode'] }}</td>
                  <td>
                    @if( $uu['ak_usul'] == 0)
                      0
                    @else
                      {{ number_format($uu['ak_usul'], 3, ",",".") }}
                    @endif
                  </td>
                  <td>{{ $uu['kode'] }}</td>
                  <td>                    
                    @if( $uu['ak1'] == 0)
                      0
                    @else
                      {{ number_format($uu['ak1'], 3, ",",".") }}
                    @endif
                  </td>
                  <td>{{ $uu['kode'] }}</td>
                  <td></td>
                  <td>{{ $uu['kode'] }}</td>
                  <td></td>
                  @if($s==0)
                    <td style="border-bottom:0;"></td>
                    <td style="border-bottom:0;"></td>
                    <td style="border-bottom:0;"></td>
                  @else
                    <td style="border-top:0; border-bottom:0;"></td>
                    <td style="border-top:0; border-bottom:0;"></td>                    
                    <td style="border-top:0; border-bottom:0;"></td>
                  @endif                         
                </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection


@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "ordering": false,
      "scrollX": true,
      dom: 'Bfrtip',
      buttons: [{
                    extend: 'excel',
                    title: 'BAPAK',
                    init: function (api, node, config) {
                        $(node).removeClass('btn btn-secondary buttons-excel buttons-html5')
                    },
                    customizeData: function (data) {
                        for (var i = 0; i < data.body.length; i++) {
                            for (var j = 0; j < data.body[i].length; j++) {
                                data.body[i][11] = '\u200C' + data.body[i][11];
                            }
                        }
                    }
                }],
    });
  } );
</script>
@endpush
