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
              <li class="breadcrumb-item active">Tambah Barang Masuk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


      <section class="content">
  
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Tambah Data Barang keluar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <form action="{{ url('/dashboard/barang_keluar/update') }}" method="post">
                                 @csrf  
                                 @method('POST')
                                 @foreach ($data as $dt)
                                     @php
                                         $barang=App\Models\Barang::where('id',$dt->barang_id)->first();
                                     @endphp
                          <div class="row">
                           <div class="col-md-12">
                                   
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kode Item</label>
                                        <input type="hidden" class="form-control" name="id" id="kodeItem" value="{{$dt->id}}" required>

                                        <input type="text" class="form-control" name="code" id="kodeItem" value="{{$barang->code}}" required readonly>
                                    </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Jumlah keluar</label>
                                          <input type="number" class="form-control" name="jumlah" value={{$dt->jumlah}} required>
                                      </div>
                                      
                                     
                                     
                                 </div>
          
                            </div>
                                 @endforeach

                           </div>
          
                        
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg float-right">Simpan </button>
                           
                           </form>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Detail Barang</h3>
                        </div>
                        <!-- /.card-header -->
                        @foreach ($data_barang as $bb)
                            
                        <div class="card-body">
                            <div class='form-group'>
                                <label for='exampleInputEmail1'>Nama Item: {{$bb->nama}}</label>
                          </div>
                         <div class='form-group'>
                                <label for='exampleInputEmail1'>Harga Beli: {{rupiah_format($bb->beli)}}</label>
                          </div>
                           <div class='form-group'>
                                <label for='exampleInputEmail1'>Harga Jual: {{rupiah_format($bb->jual)}}</label>
                          </div>
                          <div class='form-group'>
                                <label for='exampleInputEmail1'>Lokasi: {{$bb->lokasi}}</label>
                          </div>
                        </div>
                        @endforeach

                    </div> 

                </div>
            </div>
           
  
                </div>
                <!-- /.card-body -->
        </section>   


    </div> 

</div>


@endsection