@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Rujukan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Rujukan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


    </div>  
    
    <section class="content">
  
      <div class="container-fluid">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data semua Rujukan</h3>
                <div class="float-right">
                <a href="{{url('/kapus/cetak/rujukan')}}" class="btn btn-default float-right"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                   

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paisen</th>
                    <th>NIK</th>
                    <th>Poli</th>
                    <th>Jenis Berobat</th>
                    <th>Diagnosa</th>

                    <th>Rumah Sakit Tujuan</th>
                    <th>Status Rujuk</th>

                  </tr>
                  </thead>
                  <tbody>
                     
                      <?php $no=1; ?>
                      @foreach ($data as $dt)

                        @php
                            $pasien=App\Models\Pasien::where('id',$dt->id_pasien)->first();
                            $poli=App\Models\Poli::where('id',$dt->id_poli)->first();
                            $pegawai=App\Models\Pegawai::where('id',$dt->petugas)->first();
                            $rujukan=App\Models\Rujukan::where('id_rekam',$dt->kode_rekam)->first();
                        @endphp

                           <tr>
                                <td>{{$no++}}</td>
                               
                               
                                  <td>{{$pasien->nama}}</td>
                                  <td>{{$pasien->nik}}</td>

                                  <td>{{$poli->prosedur}}</td>
                                  <td>{{jenis_kartu($dt->kartu_berobat)}} </td>
                                  <td>{{$dt->diagnosa}}</td>
                                  <td>{{$rujukan->rs_tujuan}}</td>

                                <td>{{status_rujuk($dt->status_rujuk)}}</td>
                            </tr>
                      @endforeach
                 
                 
                  </tbody>
              
                </table>
              </div>
              <!-- /.card-body -->
      </section>   

</div>  


@endsection