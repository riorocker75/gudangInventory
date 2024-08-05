@extends('layouts.main_app')
@section('content')
@foreach ($data as $dt)

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
              <li class="breadcrumb-item active">Detail Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


      <section class="content">
  
        <div class="container-fluid">
           <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detail Data Barang</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                             
                  <div class="row">
                   <div class="col-md-6">
                           
                               <div class="form-group">
                                  <label for="exampleInputEmail1">Nama Item</label>
                                  <input type="hidden" class="form-control" name="id" value="{{$dt->id}}" readonly>
                                  <input type="text" class="form-control" name="nama" value="{{$dt->nama}}" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Kode Item</label>
                                <input type="text" class="form-control" name="code" value="{{$dt->code}}" readonly>
                            </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Total Stock</label>
                                  <input type="number" value="1" class="form-control" name="jumlah" value="{{$dt->jumlah}}" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Harga Beli</label>
                                  <input type="text" class="form-control" name="beli"  value="{{rupiah_format($dt->beli)}}" readonly>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Harga Jual</label>
                                <input type="text" class="form-control" name="jual"  value="{{rupiah_format($dt->jual)}}" readonly>
                            </div>
                            @php
                            $lokasi= \App\Models\Lokasi::get();
                            $lokasi_pil= \App\Models\Lokasi::where('nama',$dt->lokasi)->first();

                             @endphp
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Lokasi</label>
                                <input type="text" class="form-control" name="lokasi" value="{{$dt->lokasi}}" readonly>
                                  
                              </div>

                              <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi Lokasi</label>
                               <textarea name=""  class="form-control" id="" cols="20" rows="5" readonly>{{$lokasi_pil->desc}}</textarea> 
                            </div>
                             
                     </div>


                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Barcode</label>
                            {!!DNS1D::getBarcodeHTML($dt->barcode, 'C39')!!} 
                           <span style="letter-spacing: 0.3em">{{$dt->barcode}}</span><br> 
                          <button type="button" class="btn btn-default mr-5" data-toggle="modal" data-target="#cetakBarcode">
                            <i class="fa fa-print" aria-hidden="true"></i> Cetak Barcode
                           </button>
                        </div>
                     </div>
                              
                    </div>
                    {{-- end row --}}


                   </div>
  
                
                  </div>
                   
                   </form>
  
                </div>
                <!-- /.card-body -->
        </section>   


    </div> 

</div>


<div class="modal fade" id="cetakBarcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{url('/dashboard/barang_detail/cetak_barcode_item')}}" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cetak</h5>
          </div>
          <div class="modal-body">
  
            {{ csrf_field() }}
  
            <label>Masukan Jumlah Barcode yang ingin dicetak</label>
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

@endsection