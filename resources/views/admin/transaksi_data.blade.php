@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Transaksi Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Transaksi Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div> 


    <section class="content">
  
        <div class="container-fluid">
           <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Transaksi Barang </h3>
                  <div class="float-right">
                      <a href="{{url('/dashboard/barang_masuk/add')}}" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Barang Masuk</a>
                      <a href="{{url('/dashboard/barang_keluar/add')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Barang Keluar</a>
                      <a href="#" class="btn btn-default" data-toggle="modal" data-target="#cetakLaporanTrs"> <i class="fa fa-print" aria-hidden="true"></i> Cetak Laporan</a>
                      
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="table1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama </th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Keterangan</th>
                      <th>Tanggal Transksi</th>
                      <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                       
                        <?php $no=1; ?>
                        @foreach ($data as $dt)
  
                          @php
                              // $pasien=App\Models\Pasien::where('id',$dt->id_pasien)->first();
                              $barang=App\Models\Barang::where('id',$dt->barang_id)->first();

                          @endphp
  
                             <tr>
                                  <td>{{$no++}}</td>
                                    <td>{{$barang->nama}}</td>
                                    <td>Barang <?php if($dt->ket == "masuk"){echo "Masuk";}else{echo"Keluar";}?>:{{$dt->jumlah}}
                                      <br>Total Stock Barang: {{$barang->jumlah}}
                                    </td>

                                    <td>
                                        Harga Beli: Rp.{{rupiah_format($barang->beli)}} <br>
                                        Harga Jual: Rp.Rp.{{rupiah_format($barang->jual)}}
                                    </td>
                                   
                                    <td>         
                                       <span class="badge badge-<?php if($dt->ket=="masuk"){echo "info";}else{echo"success";}?>">{{$dt->ket}}</span>
                                    </td>
                                    <td> {{format_tanggal($dt->tgl)}} </td>
                                    {{-- <td>{{date_format($dt->tgl,'Y-m-d')}}</td> --}}
                                     <td>
                                        <a href="{{url('/dashboard/transaksi/detail/'.$dt->id.'')}}" class="btn btn-sm btn-default">Lihat</a>
                                        <a href="{{url('/dashboard/transaksi/delete/'.$dt->id.'')}}" class="btn btn-sm btn-danger" onclick="return confirm('Apa Anda Yakin Hapus Data Ini?')">Hapus</a>
                                    </td>
                              </tr>
                        @endforeach
                   
                   
                    </tbody>
                
                  </table>
                </div>
                <!-- /.card-body -->
        </section>   



</div>


<div class="modal fade" id="cetakLaporanTrs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{url('/dashboard/transaksi/cetak')}}" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Transaksi</h5>
        </div>
        <div class="modal-body">

          {{ csrf_field() }}

          <label>Pilih Tanggal </label>
          <div class="form-group">
            <label>Dari :</label>
                <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="dari">
            </div>

            <div class="form-group">
              <label>Sampai :</label>
                  <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="sampai">
                     
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Cetak Laporan</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection