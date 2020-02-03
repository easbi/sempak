@extends('layouts.frontend.master')
@section('content')
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
                <th>Dokumen</th>
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
                <td><a href='{{  url('file_rincian_dupak', $tr->berkas) }}' class="btn btn-warning" target="_blank">Berkas</a></td>
                <td>
                  {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-modal">Evaluasi<i class="fa fa-edit"></i></button> --}}
                  <a class="btn btn-info" target="_blank" href="{{ action('PenilaiController@edit',$tr->id_transaksi) }}">Evaluasis</a>
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
      "scrollX": true
    });
  } );
</script>
@endpush
