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
              <li class="breadcrumb-item active">Tambah Barang Keluar</li>
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
                          <h3 class="card-title">Tambah Data Barang Keluar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <form action="{{ url('/dashboard/barang_keluar/act') }}" method="post">
                                 @csrf  
                                 @method('POST')
                          <div class="row">
                           <div class="col-md-12">
                                   
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Kode Item</label>
                                        <input type="text" class="form-control" name="code" id="kodeItem" required>
                                    </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Jumlah keluar</label>
                                          <input type="number" value="1" class="form-control" name="jumlah" required>
                                      </div>
                                      
                                     
                                     
                          </div>
          
                                      </div>
                           </div>
          
                        
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg float-right">Simpan</button>
                           
                           </form>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Detail Barang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="showDetail"></div>
                        </div>
                    </div> 

                </div>
            </div>
           
  
                </div>
                <!-- /.card-body -->
        </section>   


    </div> 

</div>
<script>
$(document).ready(function () {
    $('#kodeItem').on('paste',function (e) { 
 setTimeout(function() {
        var kode=  $("#kodeItem").val();
        // if(kode != '' ){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type:"post",
                url:"/ajax/kode-masuk",
                data:{kode:kode},
                success: function(data){          
                    $('#showDetail').html(data);
                    // console.log('Server response:',data);
                }
              
            });
         
         
        // }else{
        //     alert('Wajib isi ');
        // }
    //    $('#hilang').hide();
}, 1000);
    });
});
</script>


@endsection