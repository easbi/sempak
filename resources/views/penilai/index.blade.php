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
                Data Rincian Yang Telah Diinput Pengusul 
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary">Kembali Ke Beranda</a>
                <br/>
                <br/>
                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unsur Utama</th>
                            <th>Subunsur</th>          
                            <th>Rincian Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai</th>  
                            <th>Tanggal Selesai</th>                          
                            <th>Berkas</th>
                            <th>Angka Kredit Yang Diusulkan</th>
                            <th>Satuan</th>
                            <th>Aksi</th>                         
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $tr)
                        <tr>
                            <td>{{ $tr->id_transaksi }}</td>
                            <td>{{ $tr->unsur_utama }}</td>
                            <td>{{ $tr->kegiatan_sub_unsur }}</td>
                            <td>{{ $tr->rincian_kegiatan }}</td>
                            <td>{{ $tr->nama_acara }}</td>
                            <td>{{ $tr->tgl_mulai }}</td>
                            <td>{{ $tr->tgl_selesai }}</td>
                            <td>{{ $tr->berkas }}</td>
                            <td>{{ str_replace('.', ',', $tr->angka_kredit_usul) }}</td>
                            <td>{{ $tr->satuan }}</td>
                            <td>
                                <a class="btn btn-warning" href="{{ action('PenilaiController@edit',$tr->id_transaksi) }}">Edit</a>
                            </td>
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