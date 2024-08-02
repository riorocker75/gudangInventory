@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Role</li>
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
                <h3 class="card-title">Role</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                   <form action="{{ url('/dashboard/role/update') }}" method="post">
                       @csrf  
                       @method('POST')
                     <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username">
                    </div>

                      <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                            <label>Role</label>
                            <select class="form-control select2" style="width: 100%;" name="role" required>
                                <option selected value="">-- Pilih Role --</option>
                                <option value="1">Admin</option>
                                <option value="2">Kepala Puskesmas</option>
                            </select>
                    </div>

                  <button type="submit" class="btn btn-primary">Tambah Role</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data semua Role</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>

                  </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; ?>
                      @foreach ($data as $dt)
                           <tr>
                                <td>{{$no++}}</td>
                                <td>{{$dt->username}}</td>
                                <td>{{role_user($dt->level)}}</td>
                                <td>
                                  <a href="{{url('/dashboard/role/delete/'.$dt->id.'')}}" class="btn btn-danger">Hapus</a>
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