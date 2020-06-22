@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Berkas Untuk Pengusulan Dupak</h1>
          @if(!empty($dokutkusul->pengantar))
             <a href="{{ route('dokutkusul.edit', $cc) }}" class="btn btn-primary float-sm-right">Edit Berkas</a>
          @else
             <a href="{{ route('dokutkusul.edit', $cc) }}" class="btn btn-warning float-sm-right">Isi Berkas</a>
          @endif

        </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
          <div class="form-group">
            <label>Surat Pengantar</label><br>
            @if(!empty($dokutkusul->pengantar))
              <a href="{{  url('public/dok_dasar_dupak/pengantar', $dokutkusul->pengantar) }}" class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
          <div class="form-group">
            <label>Form Dupak</label><br>
            @if(!empty($dokutkusul->dupak))
              <a href='{{  url('public/dok_dasar_dupak/dupak', $dokutkusul->dupak) }}' class="btn btn-success" target="_blank">Berkas</a>
            @else
              <div class="alert alert-warning">
                <strong>Sorry!</strong> File Belum Diupload.
              </div>
            @endif
          </div>
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