@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Barang Masuk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Barang Masuk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div> 


    <section class="content">
  
        <div class="container-fluid">
           <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data semua Barang Masuk </h3>
                  <div class="float-right">
                      <a href="{{url('/dashboard/barang_masuk/add')}}" class="btn btn-primary">Tambah Barang Masuk</a>
                      
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
                      <th>Lokasi</th>
                      <th>Tanggal Masuk</th>
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
                                    <td>Barang Masuk:{{$dt->jumlah}}
                                      <br>Total Stock Barang: {{$barang->jumlah}}
                                    </td>

                                    <td>
                                        Harga Beli: Rp.{{rupiah_format($barang->beli)}} <br>
                                        Harga Beli: Rp.Rp.{{rupiah_format($barang->jual)}}
                                    </td>
                                   
                                    <td>{{$barang->lokasi}}</td>
                                    <td> {{format_tanggal($dt->tgl)}} </td>
                                    {{-- <td>{{date_format($dt->tgl,'Y-m-d')}}</td> --}}
                                     <td>
                                        <a href="{{url('/dashboard/barang_masuk/edit/'.$dt->id.'')}}" class="btn btn-sm btn-warning">Ubah</a>
                                        <a href="{{url('/dashboard/barang/delete/'.$dt->id.'')}}" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                              </tr>
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

@endsection