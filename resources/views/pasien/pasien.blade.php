<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Daftar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
      {{ show_alert()}}
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"><b>Daftar</b> Pasien</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Isi Data Diri Anda</p>

      <form action="{{ url('/daftar/pasien/act') }}" method="post">
            @csrf  
            @method('POST')
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" required="required">
        
        </div>
        <div class="input-group mb-3">
          <input type="number" class="form-control" placeholder="NIK (Nomor Induk Penduduk)" name="nik" required="required">
        </div>
        <div class="input-group mb-3">
              <select class="custom-select form-control-border border-width-2"  name="kartu" required="required">
                    <option value="">--Pilih Jenis Kartu--</option>
                    <option value="1">BPJS KIS</option>
                    <option value="2">JAMSOSKES</option>
                    <option value="3">UMUM</option>
            </select>
        </div>
         
         <div class="form-group">
              <label for="exampleInputEmail1">Tanggal Lahir</label>
            <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tgl_lhr" required="required">
          </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tempat Lahir" name="tmp_lhr" required="required">
        </div>

        <div class="input-group mb-3">
              <select class="custom-select form-control-border border-width-2"  name="agama" required="required">
                    <option value="">--Pilih Agama--</option>
                    <option value="1">ISLAM</option>
                    <option value="2">KRISTEN</option>
                    <option value="3">KONGHUCU</option>
                    <option value="4">LAINYA</option>
            </select>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Pekerjaan" name="kerja" required="required">
        </div>

         <div class="input-group mb-3">
          <textarea class="form-control" rows="3" placeholder="Alamat" style="height: 65px;" name="alamat" required="required"></textarea>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama Kepala Keluarga" name="kepala" required="required">
        </div>

     
      
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
