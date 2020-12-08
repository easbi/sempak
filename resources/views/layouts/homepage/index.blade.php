@extends('layouts.frontend.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Beranda</h1>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
  	<style>
  		.responsive {
		  max-width: 100%;
		  height: auto;
		}
	</style>
    <div class="container-fluid">
      <h2>Petunjuk Pengisian DOOLOH dapat di akses di <a href="https://1drv.ms/u/s!ApioQiHuoxzig6tcWGSxoafH_p1Gzw?e=CPWsSX">Sini</a></h2> 

      <br>
    	<img src="{{asset('admin_lte/dist/img/dooloh2.png')}}" class="responsive">
    	<img src="{{asset('admin_lte/dist/img/dooloh1.png')}}" class="responsive">
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection

@push('scripts')

@endpush