@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pegawai</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>  
    
    <section class="content">
  
      <div class="container-fluid">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Data Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('/dashboard/pegawai/act') }}" method="post">
                       @csrf  
                       @method('POST')
                <div class="row">
                 <div class="col-md-6">
                         
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Induk Pegawai</label>
                                <input type="number" class="form-control" name="nip" required>
                            </div>

                             <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Kelamin</label>
                                 <select class="custom-select form-control-border border-width-2"  name="kelamin" required="required">
                                        <option value="">--Pilih Kelamin--</option>
                                        <option value="1">Pria</option>
                                        <option value="2">Wanita</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lhr" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tmp_lhr" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" name="alamat" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Telepon / No HP</label>
                                <input type="text" class="form-control" name="no_hp" required>
                            </div>

                 </div>

                 <div class="col-md-6">
                          <div class="form-group">
                                <label for="exampleInputEmail1">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                                <input type="text" class="form-control" name="pendidikan" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Lulus</label>
                                <input type="number" class="form-control" name="thn_lulus">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Pendidikan Tingkat Ijazah</label>
                                <input type="text" class="form-control" name="pt_ijazah">
                            </div>

          

                            <div class="form-group">
                                <label for="exampleInputEmail1">TMT CPNS</label>
                                <input type="number" class="form-control" name="cpns" required>
                            </div>
                 </div>
                 
                </div>
                <button type="submit" class="btn btn-primary btn-lg float-right">Tambah</button>
                 
                 </form>

              </div>
              <!-- /.card-body -->
      </section>   

</div>  


@endsection