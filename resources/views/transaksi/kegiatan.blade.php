@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<style>
    .table thead th {
        vertical-align: middle;
        padding: .25rem;
    }
    .table td {
        padding : 0.25rem;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Data Rincian Kegiatan : {{ date_format($periode['awal'], "d M Y") }} - {{ date_format($periode['akhir'], "d M Y") }} </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/')}}">Daftar Periode</a></li>
                    <li class="breadcrumb-item active">{{$periode['judul']}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead style="background-color:#eefeff">
                                <tr style="text-align:center;">
                                    <th width=10% rowspan="2">Sub Unsur</th>
                                    <th width=20% rowspan="2">Kegiatan</th>
                                    <th width=3% rowspan="2">KK</th>
                                    <th width=50% rowspan="2">Rincian Kegiatan</th>
                                    <th width=17% colspan="3">Angka Kredit</th>
                                </tr>
                                <tr style="text-align:center;">
                                    <th width=5%>Sebelum</th>
                                    <th width=7%>Usulan</th>
                                    <th width=5%>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $uu)
                                <?php $s=0; $st_su=0; $st_keg=0;?>
                                @foreach ($uu['sub_unsurs'] as $su)
                                    <?php $k=0; ?>
                                    @foreach ($su['kegiatans'] as $keg)
                                        <tr>
                                            @if($k==0 && $s==0)
                                            <td style="border-bottom:0;">{{$uu['unsur']}}</td>
                                            @else
                                            <td style="border-top:0; border-bottom:0;"></td>
                                            @endif
                                            @if($k==0)
                                            <td style="border-bottom:0;">{{$su['su']}}</td>
                                            @else
                                            <td style="border-top:0; border-bottom:0;"></td>
                                            @endif
                                            <td style="text-align:center">{{$keg['kk']}}</td>
                                            <td>{{$keg['rincian_kegiatan']}} <a href="{{ url('/transaksi/'.$y.'/'.$m.'/'.$keg['kk']) }}" style="color:inherit;"><i class="fa fa-plus-square"></i></a></td>
                                            <td style="text-align:center">-</td>
                                            <td style="text-align:center"><a href="{{ url('/usulan/'.$y.'/'.$m.'/'.$keg['kk']) }}" style="color:blue;">{{$keg['angka_kredit']}} ({{$keg['jumlah_kegiatan']}})</a></td>
                                            <td style="text-align:center">-</td>
                                        </tr>
                                        <?php $k++; $st_su=$st_su+$keg['angka_kredit']; $st_keg=$st_keg+$keg['jumlah_kegiatan'];?>
                                    @endforeach
                                    <?php $s=$s+$k; ?>
                                @endforeach
                                <tr style="background-color:#eefeff">
                                    <td style="text-align:center" colspan="4">Total : {{$uu['unsur']}}</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">{{number_format($st_su, 3)}} ({{$st_keg}})</td>
                                    <td style="text-align:center">-</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <div class="col-sm-6">
                            <a href="{{ url('/test/'.date_format($periode['awal'], "d M Y").'/'.date_format($periode['akhir'], "d M Y"))}}" class="btn btn-primary float-sm-right">Submit Dupak</a>
                        </div>
                    </div>                        
                    
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

