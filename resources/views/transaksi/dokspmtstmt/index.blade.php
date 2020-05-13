@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Dokumen SPMT & STMT</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/dokumenkeg/create') }}" class="btn btn-primary float-sm-right">Input SPMT & STMT Baru</a>
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
                <th>Nama Event/Acara/Diklat</th>
                <th>Dokumen SPMT</th>          
                <th>Dokumen STMT</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              @foreach($dokumenkeg as $dk)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $dk->acara }}</td>
                <td>
                  @if (!empty($dk->spmt_berkas))
                    <a href="{{  url('public/dok_spmt_stmt_dupak', $dk->spmt_berkas) }}" class="btn btn-info" target="_blank">Berkas</a>
                  @elseif (!empty($dk->spmt_url))
                    <a href="{{  url($dk->spmt_url) }}" class="btn btn-info" target="_blank">Berkas Cloud</a>
                  @else
                    <a href="#" class="btn btn-info" target="_blank">Berkas Kosong/Error</a>
                  @endif
                </td>
                <td>
                  @if (!empty($dk->stmt_berkas))
                    <a href="{{  url('public/dok_spmt_stmt_dupak', $dk->stmt_berkas) }}" class="btn btn-info" target="_blank">Berkas</a>
                  @elseif (!empty($dk->stmt_url))
                    <a href="{{  url($dk->stmt_url) }}" class="btn btn-info" target="_blank">Berkas Cloud</a>
                  @else
                    <a href="#" class="btn btn-info" target="_blank">Berkas Kosong/Error</a>
                  @endif
                </td>
                <td>
                  <form action="{{ route('dokumenkeg.destroy',$dk->id) }}" method="POST">
                    <a class="btn btn-warning" href="{{ route('dokumenkeg.edit',$dk->id) }}">Edit</a>
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
    $('#example').DataTable();
  } );
</script>
@endpush
