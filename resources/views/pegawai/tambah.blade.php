@extends('layouts.frontend.master')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Data Unsur Utama - <strong>Tambah Data</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/pegawai')}}" class="btn btn-primary float-sm-right">Kembali</a>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
      <div class="card">
        <div class="card-body">
            <form method="post" action="{{ url('pegawai/store') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama pegawai ..">

                    @if($errors->has('nama'))
                        <div class="text-danger">
                            {{ $errors->first('nama')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="NIP ..">

                    @if($errors->has('nip'))
                        <div class="text-danger">
                            {{ $errors->first('nip')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>No Seri Karpeg</label>
                    <input type="text" name="no_seri_karpeg" class="form-control" placeholder="No Seri Karpeg ..">

                    @if($errors->has('no_seri_karpeg'))
                        <div class="text-danger">
                            {{ $errors->first('no_seri_karpeg')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir ..">

                    @if($errors->has('tempat_lahir'))
                        <div class="text-danger">
                            {{ $errors->first('tempat_lahir')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal lahir ..">

                    @if($errors->has('tanggal_lahir'))
                        <div class="text-danger">
                            {{ $errors->first('tanggal_lahir')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>

                    @if($errors->has('jenis_kelamin'))
                        <div class="text-danger">
                            {{ $errors->first('jenis_kelamin')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Pendidikan</label>
                    <select id="pendidikan" name="pendidikan" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($pendidikans as $p)
                        <option value="{{ $p->id }}"> {{ $p->nama_pendidikan }}</option>
                            @endforeach
                    </select>

                    @if($errors->has('pendidikan'))
                        <div class="text-danger">
                            {{ $errors->first('pendidikan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Pangkat/Golongan</label>
                    <select id="pangkat_golongan" name="pangkat_golongan" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($pangkat_golongans as $p)
                        <option value="{{ $p->id }}"> {{ $p->pangkat }} - {{ $p->golongan }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('pangkat_golongan'))
                        <div class="text-danger">
                            {{ $errors->first('pangkat_golongan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>TMT Pangkat/Golongan</label>
                    <input type="date" name="tmt_pangkat_golongan" class="form-control" placeholder="TMT pangkat/golongan ..">

                    @if($errors->has('tmt_pangkat_golongan'))
                        <div class="text-danger">
                            {{ $errors->first('tmt_pangkat_golongan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <select id="jabatan" name="jabatan" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($jabatans as $p)
                        <option value="{{ $p->id }}"> {{ $p->nama_jabatan }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('jabatan'))
                        <div class="text-danger">
                            {{ $errors->first('jabatan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>TMT Jabatan</label>
                    <input type="date" name="tmt_jabatan" class="form-control" placeholder="TMT jabatan ..">

                    @if($errors->has('tmt_jabatan'))
                        <div class="text-danger">
                            {{ $errors->first('tmt_jabatan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Unit Kerja</label>
                    <select id="unit_kerja" name="unit_kerja" class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="2600">Pusdiklat Badan Pusat Statistik</option>
                    </select>

                    @if($errors->has('unit_kerja'))
                        <div class="text-danger">
                            {{ $errors->first('unit_kerja')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<div class="content">
    <div class="card mt-5">
        <div class="card-body">
            <form method="post" action="{{ url('pegawai/store') }}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama pegawai ..">

                    @if($errors->has('nama'))
                        <div class="text-danger">
                            {{ $errors->first('nama')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="NIP ..">

                    @if($errors->has('nip'))
                        <div class="text-danger">
                            {{ $errors->first('nip')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>No Seri Karpeg</label>
                    <input type="text" name="no_seri_karpeg" class="form-control" placeholder="No Seri Karpeg ..">

                    @if($errors->has('no_seri_karpeg'))
                        <div class="text-danger">
                            {{ $errors->first('no_seri_karpeg')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir ..">

                    @if($errors->has('tempat_lahir'))
                        <div class="text-danger">
                            {{ $errors->first('tempat_lahir')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal lahir ..">

                    @if($errors->has('tanggal_lahir'))
                        <div class="text-danger">
                            {{ $errors->first('tanggal_lahir')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>

                    @if($errors->has('jenis_kelamin'))
                        <div class="text-danger">
                            {{ $errors->first('jenis_kelamin')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Pendidikan</label>
                    <select id="pendidikan" name="pendidikan" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($pendidikans as $p)
                        <option value="{{ $p->id }}"> {{ $p->nama_pendidikan }}</option>
                            @endforeach
                    </select>

                    @if($errors->has('pendidikan'))
                        <div class="text-danger">
                            {{ $errors->first('pendidikan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Pangkat/Golongan</label>
                    <select id="pangkat_golongan" name="pangkat_golongan" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($pangkat_golongans as $p)
                        <option value="{{ $p->id }}"> {{ $p->pangkat }} - {{ $p->golongan }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('pangkat_golongan'))
                        <div class="text-danger">
                            {{ $errors->first('pangkat_golongan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>TMT Pangkat/Golongan</label>
                    <input type="date" name="tmt_pangkat_golongan" class="form-control" placeholder="TMT pangkat/golongan ..">

                    @if($errors->has('tmt_pangkat_golongan'))
                        <div class="text-danger">
                            {{ $errors->first('tmt_pangkat_golongan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <select id="jabatan" name="jabatan" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($jabatans as $p)
                        <option value="{{ $p->id }}"> {{ $p->nama_jabatan }}</option>
                        @endforeach
                    </select>

                    @if($errors->has('jabatan'))
                        <div class="text-danger">
                            {{ $errors->first('jabatan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>TMT Jabatan</label>
                    <input type="date" name="tmt_jabatan" class="form-control" placeholder="TMT jabatan ..">

                    @if($errors->has('tmt_jabatan'))
                        <div class="text-danger">
                            {{ $errors->first('tmt_jabatan')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <label>Unit Kerja</label>
                    <select id="unit_kerja" name="unit_kerja" class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="2600">Pusdiklat Badan Pusat Statistik</option>
                    </select>

                    @if($errors->has('unit_kerja'))
                        <div class="text-danger">
                            {{ $errors->first('unit_kerja')}}
                        </div>
                    @endif

                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Simpan">
                </div>

            </form>

        </div>
    </div>
</div>
@endsection