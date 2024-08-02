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
          <div class="row">

            <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rekam Medis</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                   <form action="{{ url('/dashboard/rekam/update') }}" method="post">
                       @csrf  
                       @method('POST')
                       @foreach ($data as $dt)
                       <div class="row">

                        <div class="col-lg-6">
                               <div class="form-group">
                                   <input type="text" name="kode_rekam" value="{{$dt->kode_rekam}}" >
                                    <label>Pasien</label>
                                    <select class="form-control select2" style="width: 100%;" name="pasien" required>
                                        @php
                                            $pasien= \App\Models\Pasien::where('id',$dt->id_pasien)->first();
                                        @endphp
                                      
                                         <option selected value="{{$pasien->id}}">{{$pasien->nama}} {{$pasien->nik}}</option>
                                    </select>
                               </div>

                                <div class="form-group">
                                    <label>Kartu Berobat</label>

                                    <select class="custom-select form-control-border border-width-2"  name="kartu" required="required">
                                       
                                        <option value="{{$dt->kartu_berobat}}" selected>{{jenis_kartu($dt->kartu_berobat)}}</option>
                                          <option value="1">BPJS KIS</option>
                                            <option value="2">JAMSOSKES</option>
                                            <option value="3">UMUM</option>
                                          
                                    </select>
                                </div>

                                   <div class="form-group">
                                    <label>Poli</label>
                                    <select class="form-control select2" style="width: 100%;" name="poli" required>
                                        @php
                                            $polis =App\Models\Poli::where('id',$dt->id_poli)->first();
                                            $poli= App\Models\Poli::get();
                                        @endphp  
                                        <option value="{{$polis->id}}" selected>{{$polis->prosedur}}</option>

                                        @foreach ($poli as $pl)
                                        <option value="{{$pl->id}}">{{$pl->prosedur}}</option>
                                            
                                        @endforeach
                                      
                                    </select>
                               </div>

                               <div class="form-group">
                                    <label>Dokter Penanggung Jawab</label>
                                    <select class="form-control select2" style="width: 100%;" name="dokter" required>
                                        @php
                                            $dokter= \App\Models\Dokter::where('id',$dt->id_dokter)->first();
                                            $cek_pd=App\Models\Poli::where('id',$dokter->poli)->first();
                                        @endphp
                                      
                                         <option value="{{$dokter->id}}" selected>{{$dokter->nama}} {{$dokter->nip}} || {{$cek_pd->prosedur}}</option>
                                        @php
                                            $Dokters= \App\Models\Dokter::get();
                                        @endphp
                                        @foreach ($Dokters as $drs)
                                        @php
                                            $poli_dokter=App\Models\Poli::where('id',$drs->poli)->first();
                                            
                                        @endphp
                                        <option value="{{$drs->id}}">{{$drs->nama}} {{$drs->nip}} || {{$poli_dokter->prosedur}}</option>
                                            
                                        @endforeach
                                    </select>
                               </div>

                            
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Diagnosa</label>
                                        <input type="text" class="form-control" placeholder="Diagnosa penyakit..." name="diagnosa" value="{{$dt->diagnosa}}" required>
                                    </div>

                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Pengobatan</label>
                                       <textarea name="pengobatan" class="form-control"  cols="10" rows="5" >{{$dt->pengobatan}}</textarea>
                                    </div>

                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Keluar</label>
                                        <input type="date" class="form-control" name="tgl_keluar" value={{date('Y-m-d',strtotime($dt->tanggal_keluar))}}>
                                    </div>
                                
                        </div>
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Petugas</label>
                                    <select class="form-control select2" style="width: 100%;" name="pegawai">
                                          @php
                                            $pegawais= \App\Models\Pegawai::where('id',$dt->petugas)->first();
                                        @endphp
                                      
                                         <option value="{{$pegawais->id}}" selected>{{$pegawais->nama}} {{$pegawais->nip}}</option>
                                        @php
                                            $pegawai= \App\Models\Pegawai::get();
                                        @endphp
                                        @foreach ($pegawai as $pg)
                                        <option value="{{$pg->id}}">{{$pg->nama}} {{$pg->nip}}</option>
                                            
                                        @endforeach
                                    </select>
                               </div>

                               {{-- <div class="form-group">
                                        <label for="exampleInputEmail1">Uang Diterima</label>
                                        <input type="number" class="form-control" placeholder="" name="uang">
                                        <span style="color:red">*kosongkan selain pasein Umum</span>
                               </div> --}}

                               <?php
                                    $rujuk=App\Models\Rujukan::where('id_rekam',$dt->kode_rekam)->first();
                                    if($dt->status_rujuk == "1"){
                                ?>

                                  <div class="form-group">
                                    <label for="exampleSelectBorder">Rumah Sakit Rujukan</label>
                                    <input type="text" class="form-control"  name="rs_rujuk" value="{{$rujuk->rs_tujuan}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectBorder">Tanggal surat</label>
                                    <input type="date" class="form-control"  name="tgl_rujuk" value="{{date('Y-m-d',strtotime($rujuk->tgl_surat))}}">
                                </div>           


                                <?php }else{?>
                               <div class="form-group">
                                    <label for="exampleSelectBorder">Status Rujukan</label>
                                    <select class="custom-select form-control-border" id="cek_rujuk" name="cek_rujuk" required>
                                        <option value="" selected >Pilih Status Rujukan</option>
                                        <option value="0">Tidak Rujuk</option>
                                        <option  value="1">Di Rujuk</option>
                                    </select>
                                </div>

                                <div id="tampil_status"> </div>
                             {{-- cek rujukan script --}}
                                <script>
                                    $(document).ready(function () {
   
                                        $('#cek_rujuk').change(function () {
                                            var cek_rujuk =$('#cek_rujuk').children("option:selected").val(); 
                                                if(cek_rujuk.length > 0){ 

                                                    $.ajax({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        },
                                                    type:"post",
                                                    url:"/ajax/cek_rujuk",
                                                    data:{cek_rujuk:cek_rujuk},
                                                    success: function(data){          
                                                        $('#tampil_status').html(data);
                                                    }
                                                    });
                                                }
                                        
                                        });
                                        });
                                </script>
                            <?php } ?>
                        </div>
                       </div>

                       @endforeach
                  

                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            
         
      </section>   

</div>  


@endsection