@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Rincian Kegiatan - <strong>Evaluasi</strong></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url()->previous() }}" class="btn btn-primary float-sm-right">Kembali</a>
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
          @foreach($transaksi as $transaksi)
          <form method="post" action="{{route('penilai.update', $transaksi->id_transaksi)}}">

            @csrf
            @method('PUT')

            <div class="form-group">
              <label>Unsur Utama</label>
              <input type="text" name="unsurutamas" id="unsurutamas" class="form-control" value="{{ $transaksi->unsur_utama }}" readonly="true">
            </div>
            <div class="form-group">
              <label>Sub Unsur</label>
              <input type="text" name="subunsur" id="subunsur" class="form-control" value="{{ $transaksi->kegiatan_sub_unsur }}" readonly="true">
            </div>
            <div class="form-group">
              <label>Rincian Kegiatan</label>
              <input type="text" name="rincian_kegiatan" id="rincian_kegiatan" class="form-control" value="{{ $transaksi->rincian_kegiatan }}" readonly="true">
            </div>
            <div class="form-group">
              <label>Nama Acara / Diklat</label>
              <input type="text" name="nama_acara" id="nama_acara" class="form-control" value="{{ $transaksi->nama_acara }}" readonly="true">
            </div>
            <div class="form-group">
              <label>Tanggal Mulai</label>
              <input type="date" name="awal_acara" class="form-control" value="{{ $transaksi->tgl_mulai }}" readonly="true">        
            </div>
            <div class="form-group">
              <label>Tanggal Selesai</label>
              <input type="date" name="akhir_acara" class="form-control" value="{{ $transaksi->tgl_selesai }}" readonly="true">                
            </div>          
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" readonly="true">{{ $transaksi->keterangan }}</textarea>            
            </div>
            <div class="form-group">
              <label>Angka Kredit</label>
              <input type="text" name="angka_kredit" id="angka_kredit" class="form-control" readonly="true" value="{{ $transaksi->angka_kredit_usul }}">
            </div> 
            <br>
            <br>

            <div class="form-group"> 
              <label>Angka Kredit oleh penilai {{ $x == 1 ? 2 : 1 }}</label>
              <input type="text" class="form-control" readonly="true" value="{{ $x == 1 ? $transaksi->angka_kredit2 : $transaksi->angka_kredit1 }}">
            </div> 
            <div class="form-group">
              <label>Status Angka Kredit oleh penilai {{ $x == 1 ? 2 : 1 }}</label>
              @if ($x == 1)
                <select class="form-control" disabled>
                  <option value="1" {{ $transaksi->status2 == 1?'selected':'' }}>Proses</option>
                  <option value="2" {{ $transaksi->status2 == 2?'selected':'' }}>Setuju</option>
                  <option value="3" {{ $transaksi->status2 == 3?'selected':'' }}>Tolak</option>
                </select>
              @endif
              @if ($x == 2)
                <select class="form-control" disabled>
                  <option value="1" {{ $transaksi->status1 == 1?'selected':'' }}>Proses</option>
                  <option value="2" {{ $transaksi->status1 == 2?'selected':'' }}>Setuju</option>
                  <option value="3" {{ $transaksi->status1 == 3?'selected':'' }}>Tolak</option>
                </select>
              @endif
            </div> 
            <div class="form-group">
              <label>Keterangan Angka Kredit oleh penilai {{ $x == 1 ? 2 : 1 }}</label>
              <textarea class="form-control" name="keterangan" readonly="true">{{ $x == 1 ? $transaksi->ket_status2 : $transaksi->ket_status1 }}</textarea>
            </div> 
            <div class="form-group">
              <label>Berkas</label><br>
              <a href='{{  url('file_rincian_dupak', $transaksi->berkas) }}' class="btn btn-warning" target="_blank">Berkas</a>
            </div>

            <br>
            <br>
            <div class="form-group">
              <label>Silahkan Isi Penilaian DUPAK Anda di Bawah Ini !</label>
            </div>
            <div class="form-group">
              <label>Angka kredit hasil penilaian</label>
              @if ($x == 1)
              <input type="text" name="angka_kredit1" class="form-control" value="{{ $transaksi->angka_kredit_usul }}">
              @endif
              @if ($x == 2)
              <input type="text" name="angka_kredit2" class="form-control" value="{{ $transaksi->angka_kredit_usul }}">
              @endif
            </div>
            <div class="form-group">
              <label>Status</label>
              @if ($x == 1)
                <select id="status1" name="status1" class="form-control">
                  <option value="1" {{ $transaksi->status1 == 1?'selected':'' }}>Proses</option>
                  <option value="2" {{ $transaksi->status1 == 2?'selected':'' }}>Setuju</option>
                  <option value="3" {{ $transaksi->status1 == 3?'selected':'' }}>Tolak</option>
                </select>
              @endif
              @if ($x == 2)
                <select id="status1" name="status2" class="form-control">
                  <option value="1" {{ $transaksi->status2 == 1?'selected':'' }}>Proses</option>
                  <option value="2" {{ $transaksi->status2 == 2?'selected':'' }}>Setuju</option>
                  <option value="3" {{ $transaksi->status2 == 3?'selected':'' }}>Tolak</option>
                </select>
              @endif
            </div>
            <div class="form-group">
              <label>Keterangan Hasil Penilaian</label>  
              @if ($x == 1)
              <textarea class="form-control" name="keterangan1">{{ $transaksi->ket_status1 }}</textarea>  
              @endif
              @if ($x == 2)
              <textarea class="form-control" name="keterangan2">{{ $transaksi->ket_status2 }}</textarea>  
              @endif        
            </div>
            
            <div class="form-group">
              <br>
              <input type="submit" class="btn btn-success" value="Simpan">
            </div>

          </form>
          @endforeach

        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection