@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">BAPAK</h1>
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
                <th>Nama dan NIP</th>        
                <th>Jabatan</th>
                <th>AK Awal</th>
                <th>Kode</th>
                <th>AK yang diusulkan</th>  
                <th>Hasil Penilaian TPI 1</th>      
                <th>Hasil Penilaian TPI 2</th>              
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              @foreach($result as $p)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $p->nama_ternilai }} <br> {{ $p->nip }}</td>
                <td>{{ $p->nama_jabatan }}</td>   
                <td> </td> 
                <td>
                  {{ $p->id_unsur_utama }}
                </td>            
                <td>{{ $p->angka_kredit }}</td>             
                <td>{{ $p->ak1 }}</td>            
                <td>{{ $p->ak2 }}</td>
              </tr>
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
