@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            Data Rincian Kegiatan
        </div>
        <div class="card-body">
            <a href="{{ url('/rinciankegiatan/create') }}" class="btn btn-primary">Input Rincian Kegiatan Baru</a>
            <br/>
            <br/>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection