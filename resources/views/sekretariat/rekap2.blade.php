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
                    <h4>Data Rincian Kegiatan</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/')}}">Daftar Periode</a></li>
                    <li class="breadcrumb-item active">###</li>
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
                                    <th width=10% rowspan="3">Sub Unsur</th>
                                    <th width=20% rowspan="3">Kegiatan</th>
                                    <th width=3% rowspan="3">KK</th>
                                    <th width=35% rowspan="3">Rincian Kegiatan</th>
                                    <th width=17% colspan="3">Angka Kredit</th>
                                    <th width=10% colspan="3">Tim Penilai</th>
                                </tr>
                                <tr style="text-align:center;">
                                    <th width=5%>Sebelum</th>
                                    <th width=7%>Usulan</th>
                                    <th width=5%>Jumlah</th>
                                    <th width=5%>I</th>
                                    <th width=5%>II</th>
                                    <th width=5%>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $uu)
                                <?php $s=0; $st_su=0; $st_keg=0; $tot_ak1=0; $tot_ak2=0;?>
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
                                            <td>{{$keg['rincian_kegiatan']}}</td>
                                            <td style="text-align:center">-</td>
                                            <td style="text-align:center">{{$keg['angka_kredit']}} ({{$keg['jumlah_kegiatan']}})</a></td>
                                            <td style="text-align:center">-</td>
                                            @if ($keg['ak1'] == $keg['ak2'])
                                                <td style="text-align:center">{{ $keg['ak1'] }}</td>
                                                <td style="text-align:center">{{ $keg['ak2'] }}</td>
                                            @else
                                                <td style="text-align:center" bgcolor="#FF0000">{{ $keg['ak1'] }}</td>
                                                <td style="text-align:center" bgcolor="#FF0000">{{ $keg['ak2'] }}</td>
                                            @endif
                                            <td style="text-align:center">-</td>
                                        </tr>
                                        <?php 
                                          $k++; 
                                          $st_su=$st_su+$keg['angka_kredit']; 
                                          $st_keg=$st_keg+$keg['jumlah_kegiatan'];
                                          $tot_ak1= $tot_ak1 + $keg['ak1'];
                                          $tot_ak2= $tot_ak2 + $keg['ak2'];
                                        ?>
                                    @endforeach
                                    <?php $s=$s+$k; ?>
                                @endforeach
                                <tr style="background-color:#eefeff">
                                    <td style="text-align:center" colspan="4">Total : {{$uu['unsur']}}</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">{{number_format($st_su, 3)}} ({{$st_keg}})</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">{{number_format($tot_ak1, 3)}}</td>
                                    <td style="text-align:center">{{number_format($tot_ak2, 3)}}</td>
                                    <td style="text-align:center">-</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <br>
                    </div>                        
                    
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

