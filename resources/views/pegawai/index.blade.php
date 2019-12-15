@extends('layouts.apps')

@section('topbutton')
<ul class="navbar-nav">
    <li class="nav-item">
        <a href="{{ url('pegawai/tambah') }}" class="btn btn-primary"><i class="material-icons">add_box</i> Input Pegawai Baru</a>
    </li>
</ul>
@endsection

@section('content')
<div class="content">    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">    
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Daftar Pegawai</h4>
                        <!-- <p class="card-category"> Here is a daftar pegawai Pusdiklat BPS</p> -->
                    </div>
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
        </div>
    </div>
</div>
@endsection