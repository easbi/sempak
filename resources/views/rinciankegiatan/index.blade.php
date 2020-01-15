@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Rincian Kegiatan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/rinciankegiatan/create') }}" class="btn btn-primary float-sm-right">Input Rincian Kegiatan Baru</a>
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
                            <th>No Rincian Kegiatan</th>
                            <th>Unsur Utama</th>
                            <th>Subunsur</th>                  
                            <th>Rincian Kegiatan</th>
                            <th>satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rinciankegiatan as $p)
                        <tr>
                            <td>{{ $p->id_rincian_kegiatan }}</td>
                            <td>{{ $p->unsur_utama }}</td>
                            <td>{{ $p->kegiatan_sub_unsur }}</td>
                            <td>{{ $p->rincian_kegiatan }}</td>
                            <td>{{ $p->satuan }}</td>
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
        $('#example').DataTable();
    } );
</script>
@endpush