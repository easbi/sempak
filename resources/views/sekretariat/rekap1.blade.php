@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Rekap Penilaian DUPAK 2</h1>
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
          <table id="example" class="display">
            <thead>
              <tr>
                <th>No</th>
                <th>Widyaiswara Yang Dinilai</th>
                <th>Total Kegiatan</th>          
                <th>Total Angka Kredit Yang Diusulkan</th>
                <th>Total Angka Kredit oleh Penilai 1</th>
                <th>Total Angka Kredit oleh Penilai 2</th> 
                <th>Lihat Detail</th>                      
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                $a = $rekap1;
                $length = count($a); 
              ?>
              @for ($i = 0; $i < $length; $i++)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $a[$i][0]->nama }}</td>                
                <td>{{ $a[$i][0]->total_kegiatan }}</td>
                <td>
                  @if ($a[$i][0]->total_ak_usul == NULL AND $a[$i][0]->total_ak_usul == 0)
                    Belum dinilai
                  @else
                    {{ $a[$i][0]->total_ak_usul }}
                  @endif
                </td>
                <td>
                  @if ($a[$i][0]->total_ak_1 == NULL AND $a[$i][0]->total_ak_1 == 0)
                    <i>Belum dinilai</i>
                  @else
                    {{ $a[$i][0]->total_ak_1 }}
                  @endif
                </td>
                <td>
                  @if ($a[$i][0]->total_ak_2 == NULL AND $a[$i][0]->total_ak_2 == 0)
                    <i>Belum dinilai</i>
                  @else
                    {{ $a[$i][0]->total_ak_2 }}
                  @endif
                </td>
                <td>
                  <a href="{{ action('SekretariatController@rekap2',$a[$i][0]->id_user) }}" class="nav-link"><span class="badge bg-danger">Lihat</span></a>
                </td>
              </tr>
              @endfor
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
      "scrollX": true,
      dom: 'Bfrtip',
      buttons: [{
        extend: 'collection',
        className: "btn-primary",
        text: 'Export',
        buttons:
        [{
          extend: "excel", className: "btn-primary"
        }],
    }]
    });
  } );
</script>
@endpush
