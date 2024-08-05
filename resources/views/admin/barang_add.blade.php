@extends('layouts.main_app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


      <section class="content">
  
        <div class="container-fluid">
           <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Tambah Data Barang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="{{ url('/dashboard/barang/act') }}" method="post">
                         @csrf  
                         @method('POST')
                  <div class="row">
                   <div class="col-md-6">
                           
                               <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Item</label>
                                  <input type="text" class="form-control" name="nama" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Kode Item</label>
                                <input type="text" class="form-control" name="code" >
                            </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Jumlah</label>
                                  <input type="number" value="1" class="form-control" name="jumlah" required>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Harga Beli</label>
                                  <input type="number" class="form-control" name="beli" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Harga Jual</label>
                                <input type="number" class="form-control" name="jual" required>
                            </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Lokasi</label>
                                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="lokasi" required>
                                    <option selected="">---Pilih Lokasi---</option>
                                    @php
                                        $lokasi= \App\Models\Lokasi::get();
                                    @endphp
                                    @foreach ($lokasi as $pl)
                                     <option value="{{$pl->nama}}">{{$pl->nama}}</option>
                                        
                                    @endforeach
                                </select>
                              </div>
                             
                  </div>
  
                              </div>
                   </div>
  
                
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg float-right">Tambah</button>
                   
                   </form>
  
                </div>
                <!-- /.card-body -->
        </section>   


    </div> 

</div>

@endsection