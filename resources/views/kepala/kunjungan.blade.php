@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Kunjungan Pasien</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Kunjungan Pasien</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>  
    
    <section class="content">
  
      <div class="container-fluid">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kunjungan Pasien</h3>
                <div class="float-right">
                     <a href="{{url('/kapus/cetak/kunjungan')}}" class="btn btn-default" ><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>No</th>
                    <th>Pasien</th>
                    <th>Keluhan</th>
                    <th>Poli</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $no=1; ?>
                      @foreach ($data as $dt)
                         @php
                            $pasien=App\Models\Pasien::where('id',$dt->id_pasien)->first();
                            $dokter=App\Models\Dokter::where('id',$dt->id_dokter)->first();
                            $poli=App\Models\Poli::where('id',$dt->id_poli)->first();
                            @endphp
                           <tr>
                               	
                            <td>{{$no++}}</td>
                            <td>{{$pasien->nama}} <br>{{$pasien->nik}}</td>
                            <td>{{$dt->diagnosa}} </td>
                            <td>{{$poli->prosedur}} </td>
                            <td>{{$dokter->nama}} </td>

                            <td>{{format_tanggal(date('Y-m-d',strtotime($dt->tanggal)))}} </td>
                            </tr>
                      @endforeach
                 
                 
                  </tbody>
              
                </table>
              </div>
              <!-- /.card-body -->
      </section>   

</div>  


@endsection