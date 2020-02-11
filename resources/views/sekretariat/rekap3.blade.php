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
                <th>Ternilai</th>
                <th>Rincian Kegiatan</th>          
                <th>Keterangan kegiatan</th>
                <th>Penilai</th>
                <th>Keterangan Pending</th> 
                <th>Lihat Detail</th>                      
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              @foreach($rekap3 as $p)
              <tr>
                <td>{{ $p->id_transaksi }}</td>
                <td>{{ $p->user_dinilai }}</td>                
                <td>{{ $p->rincian_kegiatan }}</td>             
                <td>{{ $p->keterangan }}</td>
                @if ($p->status1 == 4 AND $p->status2 == 4)
                  <td>
                    {{$p->penilai1}} dan {{$p->penilai2}}                    
                  </td>
                  <td>
                    Menurut penilai pertama : {{$p->ket_status1}} sedangkan menurut penilai kedua {{$p->ket_status2}}                    
                  </td>
                @elseif ($p->status1 == 4)
                  <td>
                    {{$p->penilai1}}                   
                  </td>
                  <td>
                    Menurut penilai pertama : {{$p->ket_status1}}                  
                  </td>
                @elseif ($p->status2 == 4)
                  <td>
                    {{$p->penilai2}}                    
                  </td>
                  <td>
                    menurut penilai kedua : {{$p->ket_status2}}                    
                  </td>
                @endif
                <td>
                  <a href="{{ action('SekretariatController@show',$p->id_transaksi) }}" class="nav-link"><span class="badge bg-danger">Lihat</span></a>
                </td>
              </tr>
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
