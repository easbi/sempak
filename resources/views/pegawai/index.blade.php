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
                    CRUD Data Pegawai
                </div>
                <div class="card-body">
                    <a href="{{ url('pegawai/tambah') }}" class="btn btn-primary">Input Pegawai Baru</a>
                    <br/>
                    <br/>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Nomor Seri Karpeg</th>
                                <th>Tempat dan Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Pendidikan</th>
                                <th>Pangkat/Golongan/TMT</th>
                                <th>Jabatan/TMT</th>
                                <th>Unit Kerja</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pegawais as $p)
                            <tr>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nip }}</td>
                                <td>{{ $p->no_seri_karpeg }}</td>
                                <td>{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->pendidikan }}</td>
                                <td>{{ $p->pangkat }} - {{ $p->golongan }} / {{ $p->tmt_pangkat_golongan }}</td>
                                <td>{{ $p->jabatan }} / {{ $p->tmt_jabatan }}</td>
                                <td>Pusdiklat Badan Pusat Statistik</td>
                                <td>
                                    <a href="{{ url('pegawai/edit/'.$p->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ url('pegawai/hapus/'.$p->id) }}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>