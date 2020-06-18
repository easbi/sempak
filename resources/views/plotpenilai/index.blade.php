@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Plot Penilaian dari Pengusul</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/plotpenilai/create') }}" class="btn btn-primary float-sm-right">Input Plot Penilai Baru</a>
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
                            <th>No Plot</th>
                            <th>Pengusul yang di Nilai</th>
                            <th>Periode Awal</th>
                            <th>Periode Akhir</th>
                            <th>Penilai 1</th>                  
                            <th>Penilai 2</th>
                            <th>Berkas Administrasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($plotpenilais as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->user_dinilai }}</td>
                            <td>{{ $p->p_awal }}</td>
                            <td>{{ $p->p_akhir }}</td>
                            <td>{{ $p->penilai1 }}</td>
                            <td>{{ $p->penilai2 }}</td>
                            <td style="text-align: center;">
                              <a href="{{ action('PenilaiController@showDokdasar',$p->id_user_dinilai) }}">
                                <span style="color: Tomato;"><i class="fas fa-business-time"></i></span>                                
                              </a>
                            </td>
                            <td>
                              <form action="{{ route('plotpenilai.destroy',$p->id) }}" method="POST">
                                <a class="btn btn-warning" href="{{ route('plotpenilai.edit',$p->id) }}">Edit</a>
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
