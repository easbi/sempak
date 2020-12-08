@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Usulan Periode Pengajuan DUPAK</h1>
          @if(empty($periodePengusul->p_awal))
             <a href="{{ route('plotpenilai.createDariPengusul') }}" class="btn btn-warning float-sm-right">Isi Periode</a>
          @else
              OKs
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
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>Nama Pengusul</th>
                            <th>Periode Awal</th>
                            <th>Periode Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($periodePengusul as $p)
                        <tr>
                            <td>{{ $p->user_dinilai }}</td>
                            <td>{{ $p->p_awal }}</td>
                            <td>{{ $p->p_akhir }}</td>
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