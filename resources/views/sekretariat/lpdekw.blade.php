@extends('layouts.frontend.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-11">
                    <h4 style="text-align: center">LEMBAR PEMBINAAN DAN EVALUASI KINERJA WIDYAISWARA TIM PENILAI PUSAT PERIODE </h4>
                    <br>
                    <div class="container-fluid">                        
                        <table style="width:100%">
                          <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $identitas->nama }}</td>
                            <td>Pangkat/Gol (TMT)</td>
                            <td>:</td>
                            <td>{{ $identitas->pangkat }}-{{ $identitas->golongan }} </td>
                          </tr>
                          <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $identitas->nip }}</td>
                            <td>Jabatan Widyaiswara</td>
                            <td>:</td>
                            <td>{{ $identitas->nama_jabatan }}</td>
                          </tr>
                          <tr>
                            <td>TTL</td>
                            <td>:</td>
                            <td>{{ $identitas->tempat_lahir }}/{{ $identitas->tanggal_lahir }}</td>
                            <td>jangka Waktu Penilaian</td>
                            <td>:</td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td>Pendidikan</td>
                            <td>:</td>
                            <td>{{ $identitas->nama_pendidikan }}</td>
                            <td>Periode Sidang</td>
                            <td>:</td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td>Instansi</td>
                            <td>:</td>
                            <td>BPS</td>
                            <td>AK Awal</td>
                            <td>:</td>
                            <td> </td>
                          </tr>
                        </table>
                    </div>
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
                            <table class="table table-bordered table-hover" id="tblData">
                                <thead style="background-color:#eefeff">
                                    <tr style="text-align:center;">
                                        <th width=10% rowspan="3">Unsur</th>
                                        <th width=3% rowspan="3">KK</th>
                                        <th width=35% rowspan="3">Rincian Kegiatan</th>
                                        <th width=10%>Usulan</th>
                                        <th width=10%>Penilaian</th>
                                        <th width=15%>Alasan Penilaian</th>
                                        <th width=15%>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                        @if(empty($result[$i]['kegiatans']))
                                            <tr>
                                                <td style="text-align:center">{{ $result[$i]['unsurutama']}}</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"></td> 
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                        @else
                                            @for ($j = 0; $j < count($result[$i]['kegiatans']); $j++)
                                                <tr>
                                                    @if($j == 0)
                                                        <td style="text-align:center">{{ $result[$i]['unsurutama']}}</td>
                                                    @else
                                                        <td style="text-align:center"></td>
                                                    @endif
                                                    <td style="text-align:center">{{ $result[$i]['kegiatans'][$j]['kk']}}</td>
                                                    <td style="text-align:left">{{ $result[$i]['kegiatans'][$j]['rincian_kegiatan']}}</td>
                                                    <td style="text-align:center">{{ $result[$i]['kegiatans'][$j]['angka_kredit']}}</td>
                                                    <td style="text-align:center">{{ $result[$i]['kegiatans'][$j]['ak1']}}</td> 
                                                    <td style="text-align:center"></td>
                                                    <td style="text-align:center"></td>
                                                </tr> 
                                            @endfor
                                        @endif
                                        
                                        @if($i == 4)
                                        @else
                                            <tr>
                                                <td style="background-color:#DCDCDC"></td>
                                                <td style="background-color:#DCDCDC"></td>
                                                <td style="background-color:#DCDCDC"></td>
                                                <td style="background-color:#DCDCDC"></td> 
                                                <td style="background-color:#DCDCDC"></td>
                                                <td style="background-color:#DCDCDC"></td>
                                                <td style="background-color:#DCDCDC"></td>                                            
                                            </tr>
                                        @endif
                                    @endfor
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <a href="{{ action('SekretariatController@generateDocx') }}" class="nav-link"><span class="badge bg-danger">Unduh</span></a>
                        </div>                        

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';
        
        // Create download link element
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;
            
            //triggering the function
            downloadLink.click();
        }
    }      
</script>
@endsection

