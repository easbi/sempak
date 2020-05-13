@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Rincian yang Telah Masuk </h1>
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
                <th>Angka Kredit</th>
                <th>Satuan</th>
                <th>Berkas</th>
                <th>Aksi</th>
                <th></th>

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
                  @if (!empty($tr->berkas))
                    <a href="{{  url('public/file_rincian_dupak', $tr->berkas) }}" class="btn btn-info" target="_blank">Berkas</a>
                  @elseif (!empty($tr->url_berkas))
                    <a href="{{  url($tr->url_berkas) }}" class="btn btn-info" target="_blank">Berkas Cloud</a>
                  @else
                    <a href="#" class="btn btn-info" target="_blank">Berkas Kosong/Error</a>
                  @endif
                </td>
                <td>
                  <a class="btn btn-warning" href="{{ action('TransaksiController@edit',$tr->id_transaksi) }}">Edit</a>
                </td>
                <td>
                  <form action="{{ route('transaksi.destroy',$tr->id_transaksi) }}" method="POST">                                       
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "scrollX": true
    });
  } );
</script>
@endpush

