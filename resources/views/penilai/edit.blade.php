<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
  
  <title>SIMPAK 2019</title>
</head>
<body>
  <div class="container">
    <div class="card mt-5">
      <div class="card-header text-center">
        Rincian Kegiatan - <strong>UBAH DATA</strong>
      </div>
      <div class="card-body">
        <a href="{{ url('/penilai')}}" class="btn btn-primary">Kembali</a>
        <br/>
        <br/>
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
            <label>Sub Unsur</label>
            <label>Tanggal Selesai</label>
            <input type="text" name="subunsur" id="subunsur" class="form-control" value="{{ $transaksi->id_rincian_kegiatan }}" readonly="true">
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
          <div class="form-group">
            <label>Berkas</label><br>
            <a href='{{  url('file_rincian_dupak', $transaksi->berkas) }}' class="btn btn-warning" target="_blank">Berkas</a>
          </div>
          <div class="form-group">
            <label>Angka kredit hasil penilaian</label>
            <input type="text" name="angka_kredit1" class="form-control" value="{{ $transaksi->angka_kredit_usul }}">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select id="status1" name="status1"class="form-control">
              <option value="1">Proses</option>
              <option value="2">Setuju</option>
              <option value="3">Tolak</option>
            </select>
          </div>
          <div class="form-group">
            <label>Keterangan Hasil Penilaian</label>
            <textarea class="form-control" name="keterangan1">{{ $transaksi->ket_status1 }}</textarea>            
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
  <!-- dropdown.blade.php -->
</body>
</html>