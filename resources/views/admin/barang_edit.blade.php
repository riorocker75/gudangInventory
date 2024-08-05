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
              <li class="breadcrumb-item active">Ubah Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


      <section class="content">
  
        <div class="container-fluid">
           <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Ubah Data Barang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="{{ url('/dashboard/barang/update') }}" method="post">
                         @csrf  
                         @method('POST')
                         @foreach ($data as $dt)
                             
                  <div class="row">
                   <div class="col-md-6">
                           
                               <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Item</label>
                                  <input type="hidden" class="form-control" name="id" value="{{$dt->id}}" required>
                                  <input type="text" class="form-control" name="nama" value="{{$dt->nama}}" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Kode Item</label>
                                <input type="text" class="form-control" name="code" value="{{$dt->code}}">
                            </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Jumlah</label>
                                  <input type="number" value="1" class="form-control" name="jumlah" value="{{$dt->jumlah}}" required>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Harga Beli</label>
                                  <input type="number" class="form-control" name="beli"  value="{{$dt->beli}}" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Harga Jual</label>
                                <input type="number" class="form-control" name="jual"  value="{{$dt->jual}}" required>
                            </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Lokasi</label>
                                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" name="lokasi" required>
                                    @php
                                        $lokasi= \App\Models\Lokasi::get();
                                        $lokasi_pil= \App\Models\Lokasi::where('nama',$dt->lokasi)->first();

                                    @endphp
                                     <option value="{{$lokasi_pil->nama}}" selected>{{$lokasi_pil->nama}}</option>
                                    @foreach ($lokasi as $pl)
                                     <option value="{{$pl->nama}}">{{$pl->nama}}</option>
                                        
                                    @endforeach
                                </select>
                              </div>
                             
                  </div>
  
                              </div>
                         @endforeach

                   </div>
  
                
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg float-right">Ubah</button>
                   
                   </form>
  
                </div>
                <!-- /.card-body -->
        </section>   


    </div> 

</div>

@endsection