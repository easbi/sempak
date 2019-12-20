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
          <h1 class="m-0 text-dark">Daftar Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/pegawai/create') }}" class="btn btn-primary float-sm-right">Input Pegawai Baru</a>
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
                <div class="table-responsive">    
                    <table class="table">
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