<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <title>SIMPAK 2019</title>
</head>
<body>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                Data Rincian Angka Kredit
            </div>
            <div class="card-body">
                <a href="{{ url('/rincianangkakredit/create') }}" class="btn btn-primary">Input Rincian Angka Kredit Baru</a>
                <br/>
                <br/>
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unsur Utama</th>
                            <th>Subunsur</th>          
                            <th>Rincian Kegiatan</th>
                            <th>Tingkatan Widyaiswara</th>
                            <th>Kode Kegiatan</th>
                            <th>Angka Kredit</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rincianangkakredits as $p)
                        <tr>
                            <td>{{ $p->id_rinci_ak }}</td>
                            <td>{{ $p->unsur_utama }}</td>
                            <td>{{ $p->kegiatan_sub_unsur }}</td>
                            <td>{{ $p->rincian_kegiatan }}</td>
                            <td>{{ $p->nama_tingkatan }}</td>
                            <td>{{ $p->kk }}</td>
                            <td>{{ str_replace('.', ',', $p->angka_kredit) }}</td>
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
</body>
</html>