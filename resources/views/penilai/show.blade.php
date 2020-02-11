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
        <div class="card-body">
          <table id="example" class="display">
            <thead>
              <tr>
                <th>No</th>
                <th>Status Pemeriksaan</th>ths>
                <th>Unsur Utama</th>
                <th>Subunsur</th>          
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
                <td>{{ $tr->kegiatan_sub_unsur }}</td>
                <td>{{ $tr->rincian_kegiatan }}</td>
                <td>{{ $tr->nama_acara }}</td>
                <td>{{ $tr->keterangan }}</td>
                <td>{{ $tr->satuan }}</td>
                <td><a href='{{  url('public/file_rincian_dupak', $tr->berkas) }}' class="btn btn-warning" target="_blank">Berkas</a></td>
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

      {{-- adadada --}}

      <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" align="center"><b>Penilaian</b></h4>
            </div>
            <div class="modal-body">
              <form role="form" action="/edit_user">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                  <div class="form-group">
                    <label>Kuantitas</label> 
                    <input type="text" class="form-control" name="kuantitas" readonly="true" value="{{ $tr->kuantitas }}">
                  </div>
                  <div class="form-group">
                    <label>Angka kredit yang diusulkan</label> 
                    <input type="text" class="form-control" name="angka_kredit1" readonly="true" value="{{ $tr->angka_kredit_usul }}">
                  </div>
                  <div class="form-group">
                    <label>Keterangan mengenai rincian</label> 
                    <textarea class="form-control" name="keterangan" readonly>{{ $tr->keterangan }}</textarea>
                  </div>
                  <div class="form-group">
                    <label>Angka kredit hasil penilaian</label> 
                    <input type="text" class="form-control" name="angka_kredit1">
                  </div>
                  <div class="form-group">
                    <label>Status</label> 
                    <select id="status1" name="status1"class="form-control">
                      <option value="1">Proses</option>
                      <option value="2">Setuju</option>
                      <option value="3">Tolak</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label> 
                    <textarea class="form-control" name="ket_status1"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{-- dadad --}}
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
