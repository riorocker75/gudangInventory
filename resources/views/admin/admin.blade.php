@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>  
     <div style="text-align:center;margin:30px 0">

   
  </div>
    <section class="content">
        @php
            // $jlh_pasien= App\Models\Pasien::where('status',1)->count();
            // $jlh_rekam= App\Models\Rekam::where('status',1)->count(); 
            // $jlh_rujuk= App\Models\Rujukan::all()->count(); 
            // $jlh_dokter= App\Models\Dokter::all()->count();   

        @endphp
      <div class="container-fluid">
         <div class="row">
                <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            {{-- <h3>{{}}</h3> --}}

                            <p>Transaksi</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                 </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3></h3>

                            <p>Stock Barang</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                        <div class="inner">
                            <h3></h3>

                            <p>Barang Terjual</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/dashboard/rujuk/data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <h3></h3>

                            <p>Total Barang</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <a href="{{url('/')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
         </div>

        <div class="row">
          <div class="col-md-4 col-sm-12">
            <div class="card">
              <div class="card-header">
              <h3 class="card-title">Barang baru di stock</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
              </button>
              </div>
              </div>
              
              <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @php
                    $barang_1= App\Models\Barang::orderBy('id','desc')->limit(7)->get();
                @endphp
                @foreach ($barang_1 as $br)
                    
              <li class="item">
              {{-- <div class="product-img">
              <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
              </div> --}}
              <div class="product-info">
              <a href="{{url('/dashboard/barang/detail/'.$br->id.'')}}" class="product-title">{{$br->nama}}
              <span class="badge badge-warning float-right">{{rupiah_format($br->jual)}}</span></a>
              <span class="product-description">
              {{$br->code}}
              </span>
              </div>
              </li>
              @endforeach
              
             
              
              </ul>
              </div>
              
              <div class="card-footer text-center">
              <a href="{{url('/dashboard/barang/data')}}" class="uppercase">Lihat semua barang</a>
              </div>
              
              </div>
          </div>
          {{-- end row barang baru --}}

          <div class="col-md-8 col-sm-12">
            <div class="card">
              <div class="card-header border-transparent">
              <h3 class="card-title">Transaksi Barang</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
              </button>
              </div>
              </div>
              
              <div class="card-body p-0" style="display: block;">
              <div class="table-responsive">
              <table class="table m-0">
              <thead>
              <tr>
              <th>Kode Item</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Status</th>
              </tr>
              </thead>
              <tbody>
                @php
                    $transaksi= App\Models\Transaksi::orderBy('id','desc')->limit(7)->get();
                @endphp
                @foreach ($transaksi as $trs)
                    @php
                        $barang_2 = App\Models\Barang::where('id',$trs->barang_id)->first();
                    @endphp
                <tr>
                  <td>{{$barang_2->code}}</td>
                  <td>{{$barang_2->nama}}</td>
                  <td>{{$trs->jumlah}}</td>
                  <td>
                    <span class="badge badge-<?php if($trs->ket=="masuk"){echo "info";}else{echo"success";}?>">{{$trs->ket}}</span>
                  </td>
                </tr>
                @endforeach
              
              </tbody>
              </table>
              </div>
              
              </div>
              
              <div class="card-footer clearfix" style="display: block;">
              <a href="{{url('/dashboard/barang_masuk/data')}}" style="margin-right:8px" class="btn btn-sm btn-info float-left"><i class="fa fa-plus" aria-hidden="true"></i> Barang Masuk</a>
              <a href="{{url('/dashboard/barang_keluar/data')}}" class="btn btn-sm btn-success float-left"><i class="fa fa-plus" aria-hidden="true"></i> Barang Keluar</a>

              <a href="{{url('/dashboard/transaksi/data')}}" class="btn btn-sm btn-secondary float-right">Semua transaksi</a>
              </div>
              
              </div>

          </div>
            {{-- end row transaksi --}}
        </div>


      </div>  
      </section>   

</div>  


@endsection