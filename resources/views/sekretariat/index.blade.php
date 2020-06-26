@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Rekap Penilaian DUPAK</h1>
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
                <th>Penilai 1</th>
                <th>Disetujui</th>
                <th>Ditolak</th>  
                <th>Dipending</th>
                <th>Belum Diperiksa</th>
                <th>Penilai 2</th>
                <th>Disetujui</th>
                <th>Ditolak</th>  
                <th>Dipending</th>
                <th>Belum Diperiksa</th>                        
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                $a = $plotpenilais;
                $length = count($a); 
                $b = $pen1c;
              ?>        
              @for ($i = 0; $i < $length; $i++)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $a[$i][0]->nama }}</td>
                <td>{{ $a[$i][0]->total_kegiatan }}</td>
                <td>{{ $b[$i]->user_penilai1 }}</td>
                <td> 
                  @if ($a[$i][0]->setuju1 == NULL and $a[$i][0]->setuju1 = 0)
                    <span class="float-right badge bg-danger">0 </span>
                  @else
                    <span class="float-right badge bg-success">{{ $a[$i][0]->setuju1 }}</span>
                  @endif
                </td>
                <td>{{ $a[$i][0]->tolak1 == NULL ? 0 : $a[$i][0]->tolak1}}</td>
                <td>{{ $a[$i][0]->pending1 == NULL ? 0 : $a[$i][0]->pending1}}</td>
                <td>                   
                  @if ($a[$i][0]->total_kegiatan - $a[$i][0]->setuju1 - $a[$i][0]->tolak1 == 0)
                    <span class="float-right badge bg-danger">0 </span>
                  @else
                    <span class="float-right badge bg-danger">{{ $a[$i][0]->total_kegiatan - $a[$i][0]->setuju1 - $a[$i][0]->tolak1 - $a[$i][0]->pending1}}</span>
                  @endif
                </td>
                <td>{{ $b[$i]->user_penilai2 }}</td>
                <td>
                  @if ($a[$i][0]->setuju2 == NULL and $a[$i][0]->setuju2 = 0)
                    <span class="float-right badge">0 </span>
                  @else
                    <span class="float-right badge bg-success">{{ $a[$i][0]->setuju2 }}</span>
                  @endif
                </td>
                <td>{{ $a[$i][0]->tolak2 == NULL ? 0 : $a[$i][0]->tolak2}}</td>
                <td>{{ $a[$i][0]->pending2 == NULL ? 0 : $a[$i][0]->pending2 }}</td>
                <td>                   
                  @if ($a[$i][0]->total_kegiatan - $a[$i][0]->setuju2 - $a[$i][0]->tolak2 == 0)
                    <span class="float-right badge bg-danger">0 </span>
                  @else
                    <span class="float-right badge bg-danger">{{ $a[$i][0]->total_kegiatan - $a[$i][0]->setuju2- $a[$i][0]->tolak2 - $a[$i][0]->pending2 }}</span>
                  @endif
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
