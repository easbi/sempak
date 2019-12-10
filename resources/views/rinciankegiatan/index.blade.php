<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>SIMPAK 2019</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    Data Rincian Kegiatan
                </div>
                <div class="card-body">
                    <a href="{{ url('/rinciankegiatan/create') }}" class="btn btn-primary">Input Rincian Kegiatan Baru</a>
                    <br/>
                    <br/>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>id Unsur Utama</th>
                                <th>id Subunsur</th>
                                <th>id Rincian Kegiatan</th>
                                <th>
                                    Rincian Kegiatan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rinciankegiatan as $p)
                            <tr>
                                <td>{{ $p->id_unsur_utama }}</td>
                                <td>{{ $p->id_subunsur }}</td>
                                <td>{{ $p->id_rincian_kegiatan }}</td>
                                <td>{{ $p->rincian_kegiatan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>