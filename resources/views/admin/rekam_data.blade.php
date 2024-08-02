@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Rekam Medis</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Rekam Medis</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


    </div>  
    
    <section class="content">
  
      <div class="container-fluid">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data semua Rekam Medis</h3>
                <div class="float-right">
                    <a href="{{url('/dashboard/rekam/add')}}" class="btn btn-primary">Tambah Rekam</a>
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
                    <th>Poli & Dokter</th>
                    <th>Jenis Berobat</th>
                    <th>Diagnosa</th>

                    <th>Tanggal</th>
                    <th>Status Rujuk</th>

                    <th>Atur</th>
                  </tr>
                  </thead>
                  <tbody>
                     
                      <?php $no=1; ?>
                      @foreach ($data as $dt)

                        @php
                            $pasien=App\Models\Pasien::where('id',$dt->id_pasien)->first();
                            $poli=App\Models\Poli::where('id',$dt->id_poli)->first();
                            $pegawai=App\Models\Pegawai::where('id',$dt->petugas)->first();
                            $dokter=App\Models\Dokter::where('id',$dt->id_dokter)->first();
                        @endphp

                           <tr>
                                <td>{{$no++}}</td>
                               
                               
                                  <td>{{$pasien->nama}}</td>
                                  <td>{{$pasien->nik}}</td>

                                  <td>{{$poli->prosedur}}
                                  <br> {{$dokter->nama}}
                                  </td>
                                  <td>{{jenis_kartu($dt->kartu_berobat)}} </td>
                                  <td>{{$dt->diagnosa}}</td>
                              

                             
                                <td>Tanggal Masuk: {{format_tanggal(date('Y-m-d',strtotime($dt->tanggal)))}}
                                <br>Tanggal Keluar:  {{format_tanggal(date('Y-m-d',strtotime($dt->tanggal_keluar)))}}
                                </td>

                                <td>{{status_rujuk($dt->status_rujuk)}}</td>


                                <td>
                                  @if ($dt->status_rujuk == 0)
                                      
                                    <a href="{{url('/dashboard/rekam/kwitansi/'.$dt->id.'')}}"  class="btn btn-sm btn-default">Cetak</a>
                                  @else
                                    <a href="{{url('/dashboard/rekam/surat/'.$dt->kode_rekam.'')}}"  class="btn btn-sm btn-default">Cetak</a>

                                  @endif
                                <a href="{{url('/dashboard/rekam/edit/'.$dt->id.'')}}" class="btn btn-sm btn-warning">Ubah</a>
                                {{-- <a href="{{url('/dashboard/rekam/delete/'.$dt->id.'')}}" class="btn btn-sm btn-danger">Hapus</a> --}}
                                </td>
                            </tr>
                      @endforeach
                 
                 
                  </tbody>
              
                </table>
              </div>
              <!-- /.card-body -->
      </section>   

</div>  


@endsection