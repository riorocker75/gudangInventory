@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Lokasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Lokasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>  
    
    <section class="content">
      
     
              {{-- {{$cek->prosedur}} --}}
        
      <div class="container-fluid">
          <div class="row">

            <div class="col-lg-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lokasi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                   <form action="{{ url('/dashboard/lokasi/act') }}" method="post">
                       @csrf  
                       @method('POST')
                     <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama">
                    </div>

                      <div class="form-group">
                            <label>Deskripsi Lokasi</label>
                            <textarea class="form-control" rows="3" placeholder="Deskripsikan lokasi secara detail disini ..." name="desc"></textarea>
                    </div>


                  <button type="submit" class="btn btn-primary">Tambah Lokasi</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Semua Lokasi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>

                  </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; ?>
                      @foreach ($data as $dt)
                           <tr>
                                <td>{{$no++}}</td>
                                <td>{{$dt->nama}}</td>
                                <td>{{$dt->desc}}</td>
                                <td>
                                  <a href="{{url('/dashboard/lokasi/edit/'.$dt->id.'')}}" class="btn btn-warning">Ubah</a>

                                  <a href="{{url('/dashboard/lokasi/delete/'.$dt->id.'')}}" class="btn btn-danger" onclick="return confirm('Apa Anda Yakin Hapus Data Ini?')">Hapus</a>
                                </td>

                            </tr>
                      @endforeach
                 
                 
                  </tbody>
              
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
         
      </section>   

</div>  


@endsection