<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
{{-- databales --}}
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css?v=3.2.0')}}">

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



    <style type="text/css">
			.lead {
				font-family: "Verdana";
				font-weight: bold;
			}
			.value {
				font-family: "Verdana";
			}
			.value-big {
				font-family: "Verdana";
				font-weight: bold;
				font-size: large;
			}
			.td {
				valign : "top";
			}

			/* @page { size: with x height */
			/*@page { size: 20cm 10cm; margin: 0px; }*/
			@page {
				size: A4;
				margin : 0px;
			}
	/*		@media print {
			  html, body {
			  	width: 210mm;
			  }
			}*/
			 .kepala{
        text-align:center;
        font-size: 28px;
        margin:40px 120px;

    }
    .kop_surat {
	position: relative;
	height: 4cm;
	display: flex;
	top: 0;
}

.logo_surat {
	height: 0.5cm;
	width: 0.5cm;
    position: absolute;
    left: 150px;
}
.logo_surat img{
    margin-top: 40px;
  width: 90px;
    height: 75px;
}
.logo_kanan{
    position: absolute;
        right: 150px;

}
.logo_kanan img{
     margin-top: 40px;
    width: 90px;
    height: 75px;
}
.judul_surat {
	padding-top: 0.5cm;
	padding-left: 1cm;
	padding-right: 1cm;
	font-size: 20pt;
	font-weight: 700;
	text-align: center;
	width: 14.8cm;
	/* background: red; */
	margin: 0 auto;
	/* line-height: 1.3;s */
}
	</style>
</head>
<body onload="window.print();">
	<div class="wrapper">
		<div class="container">
<div class="kop_surat">
            <div class="logo_surat">
                <img src="{{url('/')}}/logo/logo.png" alt="" srcset="">
            </div>
                <div class="logo_kanan float-right">
                    <img src="{{url('/')}}/logo/puskesmas.png" alt="" srcset="">

                </div>

            <div class="judul_surat">
               <p style="font-size:20px">PEMERINTAH KABUPATEN ACEH TENGGARA</p> 
              <p style="line-height: 0;margin-top:16px">UPTD PUSKEMAS SUKA MAKMUR</p>
               <p style="margin-top:-10px"> KECAMATAN SEMADAM</p>
              
               <p style="font-size:12px;font-weight:400">Jln. Lawe Breingin Horas - Semadam Asal Kode Pos 24678</p>
            </div>
        </div>

   <div style="text-align:center;margin-top:30px">
        <h5> Rekapan Rujukan Pasien Pertahun</h5>
			<h5>{{date('Y')}}</h5>
   </div>
   <table id="absensi" class="table table-bordered table-hover">
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
			 
            <tr>
					
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
	</div>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
$('#absensi').dataTable({
	searching: false, paging: false, info: false
});
</script>    
</body>
</html>