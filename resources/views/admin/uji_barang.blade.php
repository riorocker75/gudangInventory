@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div> 


    <section class="content">
  
        <div class="container-fluid">
           <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data semua Barang </h3>
                  <div class="float-right">
                      <a href="{{url('/dashboard/barang/add')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Barang</a>
                      <button type="button" class="btn btn-success mr-5" data-toggle="modal" data-target="#importExcel">
                       <i class="fa fa-file" aria-hidden="true"></i> IMPORT EXCEL
                      </button>
                      <a href="#" class="btn btn-default" data-toggle="modal" data-target="#cetakLaporan"> <i class="fa fa-print" aria-hidden="true"></i> Cetak Laporan</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="table1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama </th>
                      <th>Item Code </th>
                      <th>Stock</th>
                      <th>Harga</th>
                      <th>Lokasi</th>
                      <th>QR code</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach ($data as $dt)
                       
                    
  
                          @php
                              $lokasi=App\Models\Lokasi::where('nama',$dt->lokasi)->first();

                          @endphp
  
                             <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$dt->nama}}</td>
                                  <td>{{$dt->code}}</td>
                                  <td>{{$dt->jumlah}}</td>
                                    <td>
                                      Beli :<span class="badge badge-default">{{rupiah_format($dt->beli)}} </span><br>
                                      Jual: <span class="badge badge-default">{{rupiah_format($dt->jual)}} </span>
                                    </td>
                                    <td>{{$lokasi->nama}}</td>
                                    <td> 
                                     
                                        {!! DNS2D::getBarcodeSVG($dt->barcode, "QRCODE") !!}
                                    </td>
                                    
                              </tr>


                               {{-- modal cetak barcode --}}
                <div class="modal fade" id="cetakBarcode-{{$dt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form method="post" action="{{url('/dashboard/barang_detail/cetak_barcode_item')}}" enctype="multipart/form-data">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Cetak</h5>
                        </div>
                        <div class="modal-body">
                
                          {{ csrf_field() }}
                
                          <label>Masukan Jumlah Qr code yang ingin dicetak</label>
                          <div class="form-group">
                              <input type="hidden" class="form-control" name="id" value="{{$dt->id}}" required>
              
                              <input type="number" class="form-control" name="cetak" value="1" required>
                          </div>
                
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">cetak</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                   
                       @endforeach
                   
                    </tbody>
                
                  </table>
                </div>
                <!-- /.card-body -->

               
        </section>   



</div>



<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{url('/dashboard/barang/import_excel')}}" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
        </div>
        <div class="modal-body">

          {{ csrf_field() }}

          <label>Pilih file excel</label>
          <div class="form-group">
            <input type="file" name="file" required="required">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- cetak laporan --}}

<div class="modal fade" id="cetakLaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="{{url('/dashboard/barang/cetak')}}" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
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