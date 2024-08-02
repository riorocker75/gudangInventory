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
                   <form action="{{ url('/dashboard/rekam/act') }}" method="post">
                       @csrf  
                       @method('POST')
                       <div class="row">

                        <div class="col-lg-6">
                               <div class="form-group">
                                    <label>Pasien</label>
                                    <select class="form-control select2" style="width: 100%;" name="pasien" required>
                                        <option selected value="">Cari Nik Pasien</option>
                                        @php
                                            $pasien= \App\Models\Pasien::get();
                                        @endphp
                                        @foreach ($pasien as $ps)
                                         <option value="{{$ps->id}}">{{$ps->nama}} {{$ps->nik}}</option>
                                        @endforeach
                                    </select>
                               </div>

                                <div class="form-group">
                                    <label>Kartu Berobat</label>

                                    <select class="custom-select form-control-border border-width-2"  name="kartu" required="required">
                                            <option value="">--Pilih Jenis Kartu--</option>
                                            <option value="1">BPJS KIS</option>
                                            <option value="2">JAMSOSKES</option>
                                            <option value="3">UMUM</option>
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label>Dokter Penanggung Jawab</label>
                                    <select class="form-control select2" style="width: 100%;" name="dokter" required>
                                        <option selected value="">Cari Nip Dokter</option>
                                        @php
                                            $dokter= \App\Models\Dokter::get();
                                        @endphp
                                        @foreach ($dokter as $dr)
                                        @php
                                            $poli_dokter=App\Models\Poli::where('id',$dr->poli)->first();
                                        @endphp
                                         <option value="{{$dr->id}}">{{$dr->nama}} {{$dr->nip}} || {{$poli_dokter->prosedur}}</option>
                                        @endforeach
                                    </select>
                               </div>
                                   <div class="form-group">
                                    <label>Poli</label>
                                    <select class="form-control select2" style="width: 100%;" name="poli" required>
                                        <option selected="">---Pilih Poli---</option>
                                        @php
                                            $poli= \App\Models\Poli::get();
                                        @endphp
                                        @foreach ($poli as $pl)
                                        <option value="{{$pl->id}}">{{$pl->prosedur}}</option>
                                            
                                        @endforeach
                                    </select>
                               </div>

                            
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Diagnosa</label>
                                        <input type="text" class="form-control" placeholder="Diagnosa penyakit..." name="diagnosa" required>
                                    </div>

                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Pengobatan</label>
                                       <textarea name="pengobatan" class="form-control"  cols="10" rows="5" ></textarea>
                                    </div>

                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Keluar</label>
                                        <input type="date" class="form-control" name="tgl_keluar" value={{date('Y-m-d')}}>
                                    </div>
                                
                        </div>
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Petugas</label>
                                    <select class="form-control select2" style="width: 100%;" name="pegawai">
                                        <option selected="">Cari Nip Petugas</option>
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

                               <div class="form-group">
                                    <label for="exampleSelectBorder">Status Rujukan</label>
                                    <select class="custom-select form-control-border" id="cek_rujuk" name="cek_rujuk" required>
                                        <option value="">Pilih Status Rujukan</option>
                                        <option value="0">Tidak Rujuk</option>
                                        <option  value="1">Di Rujuk</option>
                                    </select>
                                </div>

                                <div id="tampil_status">
                                   
                                </div>
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

                        </div>
                       </div>
                  

                  <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            
         
      </section>   

</div>  


@endsection