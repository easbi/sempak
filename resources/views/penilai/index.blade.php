@extends('layouts.frontend.master')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Rincian Yang Telah Diinput Pengusul </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/')}}" class="btn btn-primary float-sm-right">Kembali</a>
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
                            <th>Unsur Utama</th>
                            <th>Subunsur</th>          
                            <th>Rincian Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai</th>  
                            <th>Tanggal Selesai</th>
                            <th>Angka Kredit Yang Diusulkan</th>
                            <th>Satuan</th>
                            <th>Aksi</th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($transaksis as $tr)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $tr->unsur_utama }}</td>
                            <td>{{ $tr->kegiatan_sub_unsur }}</td>
                            <td>{{ $tr->rincian_kegiatan }}</td>
                            <td>{{ $tr->nama_acara }}</td>
                            <td>{{ $tr->tgl_mulai }}</td>
                            <td>{{ $tr->tgl_selesai }}</td>
                            <td>{{ str_replace('.', ',', $tr->angka_kredit_usul) }}</td>
                            <td>{{ $tr->satuan }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ action('PenilaiController@edit',$tr->id_transaksi) }}">Evaluasi</a>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollX": true
        });
    } );
</script>

@endsection
