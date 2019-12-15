@extends('layouts.frontend.master')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="container">
    <div class="card mt-5">
        <div class="card-header text-center">
            Data Master Unsur Utama
        </div>
        <div class="card-body">
            <a href="{{ url('/metadata/create') }}" class="btn btn-primary">Input Unsur Utama Baru</a>
            <br/>
            <br/>
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

@endsection
