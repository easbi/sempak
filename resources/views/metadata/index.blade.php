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
          <h1 class="m-0 text-dark">Data Master Unsur Utama</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/metadata/create') }}" class="btn btn-primary float-sm-right">Input Unsur Utama Baru</a>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unsurUtama as $uu)
                        <tr>
                            <td>{{ $uu->id }}</td>
                            <td>{{ $uu->unsur_utama }}</td>
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
        $('#example').DataTable();
    } );
</script>

@endsection
