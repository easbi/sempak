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
          <h1 class="m-0 text-dark">Data Rincian Yang Telah Diinput Pengusul </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <a href="{{ url('/')}}" class="btn btn-primary float-sm-right">Kembali</a>
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
                            <th>Angka Kredit Yang Diusulkan</th>
                            <th>Satuan</th>
                            <th>Aksi</th>                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach($transaksis as $tr)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $tr->unsur_utama }}</td>
                            <td>{{ $tr->kegiatan_sub_unsur }}</td>
                            <td>{{ $tr->rincian_kegiatan }}</td>
                            <td>{{ $tr->nama_acara }}</td>
                            <td>{{ $tr->tgl_mulai }}</td>
                            <td>{{ $tr->tgl_selesai }}</td>
                            <td>{{ str_replace('.', ',', $tr->angka_kredit_usul) }}</td>
                            <td>{{ $tr->satuan }}</td>
                            <td>
                                <button class="btn btn-warning btn-detail open_modal" value="1">Edit</button>
                                {{-- <a class="btn btn-warning" href="{{ action('PenilaiController@edit',$tr->id_transaksi) }}">Evaluasi</a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


                {{--  ### --}}
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Tour</h4>
                            </div>
                            <div class="modal-body">
                                <form id="frmProducts" name="frmProducts" class="form-horizontal" novalidate="">
                                    <div class="form-group error">
                                     <label for="inputName" class="col-sm-3 control-label">Name</label>
                                       <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Product Name" value="">
                                       </div>
                                       </div>
                                     <div class="form-group">
                                     <label for="inputDetail" class="col-sm-3 control-label">Details</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="details" name="details" placeholder="details" value="">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                                <input type="hidden" id="product_id" name="tour_id" value="0">
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
                {{-- ### --}}
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

<script type="text/javascript">
    $(document).on('click','.open_modal',function(){
    var url = "/edit";
    var tour_id= $(this).val();
    $.get(url + '/' + tour_id, function (data) {
            //success data
            console.log(data);
            $('#tour_id').val(data.id);
            $('#name').val(data.name);
            $('#details').val(data.details);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        }) 
});
</script>

@endsection
