@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Rincian Yang Diinput {{ $nama_dinilai->nama }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/penilai/dashboard')}}" class="btn btn-primary float-sm-right">Kembali</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container">
      
      <div class="card">
        <div class="card-bod">
          
            
          <table id="example" class="display">
            <thead>
              <tr>
                <th>No</th>
                <th>Keselarasan antar Penilai</th>
                <th>Status Pemeriksaan</th>
                <th>Unsur Utama</th>        
                <th>Rincian Kegiatan</th>
                <th>Nama Kegiatan</th>
                <th>Mata Diklat/ keterangan lainnya</th>
                <th>Satuan</th>
                <th>Dokumen</th>
                <th>Aksi</th>                         
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              @foreach($transaksis as $tr)
                <tr>
                <td>{{ $tr->id_transaksi }}</td>
                <td>
                  @if(($tr->status1 == $tr->status2) AND ($tr->angka_kredit1 == $tr->angka_kredit2))
                    <span class="badge bg-info">Sudah Selaras</span>
                  @else
                    <span class="badge bg-danger">Belum Selaras</span>
                  @endif
                </td>
                <td>
                  @if ($x == 1 AND ($tr->status1 == NULL OR $tr->status1 == 1))
                    <span class="badge bg-danger">Belum Diperiksa</span>
                  @elseif ($x == 1 AND ($tr->status1 == 2 )) 
                    <span class="badge bg-info">Sudah Diperiksa : Disetujui</span>
                  @elseif ($x == 1 AND ($tr->status1 == 3 )) 
                    <span class="badge bg-warning">Sudah Diperiksa : Ditolak</span>
                  @elseif ($x == 1 AND ($tr->status1 == 4 )) 
                    <span class="badge bg-secondary">Sudah Diperiksa : Pending</span>
                  @elseif ($x == 2 AND ($tr->status2 == NULL OR $tr->status2 == 1 )) 
                    <span class="badge bg-danger">Belum Diperiksa</span>
                  @elseif ($x == 2 AND ($tr->status2 == 2 )) 
                    <span class="badge bg-info">Sudah Diperiksa : Disetujui</span> 
                  @elseif ($x == 2 AND ($tr->status2 == 3 )) 
                    <span class="badge bg-warning">Sudah Diperiksa : Ditolak</span>                 
                  @elseif ($x == 2 AND ($tr->status2 == 4 )) 
                    <span class="badge bg-secondary">Sudah Diperiksa : Pending</span>
                  @endif
                </td>
                <td>{{ $tr->unsur_utama }}</td>
                <td>{{ $tr->rincian_kegiatan }}</td>
                <td>{{ $tr->acara }}</td>
                <td>{{ $tr->keterangan }}</td>
                <td>{{ $tr->satuan }}</td>
                <td><a href="{{  url('public/file_rincian_dupak', $tr->berkas) }}" class="btn btn-warning" target="_blank">Berkas</a></td>
                <td>
                  {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal">Evaluasi<i class="fa fa-edit"></i></button> --}}
                  <a class="btn btn-info" href="{{ action('PenilaiController@edit',$tr->id_transaksi) }}">Evaluasi</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- //rencana mau nambahin modal buat evaluasi -->
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection


@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "scrollX": true,
      stateSave: true,
    });
  } );
</script>
@endpush
