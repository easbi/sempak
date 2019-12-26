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
          <h1 class="m-0 text-dark">Data Master Acara </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/masteracara/create') }}" class="btn btn-primary float-sm-right">Input Acara Baru</a>
        </div>
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
                        <th>Nama Acara</th>
                        <th>Tanggal Mulai</th>          
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($acaras as $a)
                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->nama_acara }}</td>
                        <td>{{ $a->awal_acara }}</td>
                        <td>{{ $a->akhir_acara }}</td>
                        <td>
                            <form action="{{ route('masteracara.destroy',$a->id) }}" method="POST">
                                <a class="btn btn-warning" href="{{ route('masteracara.edit',$a->id) }}">Edit</a>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollX": true
        });
    } );
</script>

@endsection
