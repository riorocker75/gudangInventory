<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;


use App\Models\User;
use App\Models\Admin;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\LogTransaksi;
use App\Models\Lokasi;
use App\Models\Category;









class AdminCtrl extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

	public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-adm')){
                return redirect('/login')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }
    public function __invoke(Request $request)
    {
       

    }

    function index(){
          return view('admin.admin');
    }


    // pasien
    function pasien(){
        return view('pasien.pasien');
    }

    function pasien_act(Request $request){
         $request->validate([
            'nama' => 'required',
            'nik' => 'required'
        ]);

         $date=date('Y-m-d');

         DB::table('pasien')->insert([
            'nama' => $request->nama,
            'nik' =>$request->nik,
            'kartu_berobat'=> $request->kartu,
            'tanggal_lahir'=> $request->tgl_lhr,
            'tempat_lahir' => $request->tmp_lhr,
            'agama'=> $request->agama,
            'pekerjaan'=> $request->kerja,
            'alamat'=> $request->alamat,
            'nama_kepala'=> $request->kepala,
            'tgl_registrasi' => $date,
            'status' => 1
        ]);

        return redirect('/dashboard/pasien/data')->with('alert-success','Data diri anda sudah terkirim');

    }

     function pasien_data(){
         $data = Pasien::orderBy('id','desc')->get();
        return view('admin.pasien_data',[
            'data' =>$data
        ]);
    }
    function pasien_edit($id){
          $data = Pasien::where('id',$id)->get();
        return view('admin.pasien_edit',[
            'data' =>$data
        ]);
    }

    function pasien_update(){
        
    }
    function pasien_delete(){
               Pasien::where('id',$id)->delete();
        return redirect('/dashboard/pasien/data')->with('alert-success','Data Berhasil');  
    }


    // pegawai

    function pegawai(){
        $data=Pegawai::orderBy('id','desc')->get();
        return view('admin.pegawai_data',[
            'data' =>$data
        ]);

    }

    function pegawai_add(){
        return view('admin.pegawai_add');
    }

    function pegawai_act(Request $request){
            $request->validate([
                'nama' => 'required',
                'nip' => 'required'
            ]);

             $date=date('Y-m-d');

         DB::table('pegawai')->insert([
            'nama' => $request->nama,
            'nip' =>$request->nip,
            'jenis_kelamin' => $request->kelamin,
            'tanggal_lahir' => $request->tgl_lhr,
            'tempat_lahir' => $request->tmp_lhr,
            'alamat' => $request->alamat,
            'telepon' => $request->no_hp,
            'jabatan' => $request->jabatan,
            'pendidikan_nama' => $request->pendidikan,
            'pendidikan_tahun_lulus' => $request->thn_lulus,
            'pendidikan_tk_ijazah' => $request->pt_ijazah,
            // 'pangkat' => $request->pangkat,
            'tmt_cpns' => $request->cpns,
            'tanggal' => date('Y-m-d'),

            'status' => 1
        ]);

        return redirect('/dashboard/pegawai/data')->with('alert-success','Data diri anda sudah terkirim');


    }

    function pegawai_edit($id){
        $data=Pegawai::where('id',$id)->get();
        return view('admin.pegawai_edit',[
            'data' => $data
        ]);
    }
    function pegawai_update(Request $request){
          $request->validate([
                'nama' => 'required',
                'nip' => 'required'
            ]);
            $id=$request->id;

             $date=date('Y-m-d');

         DB::table('pegawai')->where('id',$id)->update([
            'nama' => $request->nama,
            'nip' =>$request->nip,
            'jenis_kelamin' => $request->kelamin,
            'tanggal_lahir' => $request->tgl_lhr,
            'tempat_lahir' => $request->tmp_lhr,
            'alamat' => $request->alamat,
            'telepon' => $request->no_hp,
            'jabatan' => $request->jabatan,
            'pendidikan_nama' => $request->pendidikan,
            'pendidikan_tahun_lulus' => $request->thn_lulus,
            'pendidikan_tk_ijazah' => $request->pt_ijazah,
            // 'pangkat' => $request->pangkat,
            'tmt_cpns' => $request->cpns,
            'status' => 1
        ]);

        return redirect('/dashboard/pegawai/data')->with('alert-success','Data diri anda sudah terkirim');

    }

    function pegawai_delete($id){
                 Pegawai::where('id',$id)->delete();
        return redirect('/dashboard/pegawai/data')->with('alert-success','Data Berhasil');
    }


    // data dokter
    function dokter(){
        $data=Dokter::orderBy('id','desc')->get();
        return view('admin.dokter_data',[
            'data' => $data
        ]);
    }
    function dokter_add(){
        return view('admin.dokter_add');
    }
    function dokter_act(Request $request){
            $request->validate([
                'nama' => 'required',
                'nip' => 'required'
            ]);

             $date=date('Y-m-d');

         DB::table('dokter')->insert([
            'nama' => $request->nama,
            'nip' =>$request->nip,
            'jenis_kelamin' => $request->kelamin,
            'tanggal_lahir' => $request->tgl_lhr,
            'tempat_lahir' => $request->tmp_lhr,
            'alamat' => $request->alamat,
            'telepon' => $request->no_hp,
            'poli' => $request->poli,
            'tanggal' =>$date,
            'status' => 1
        ]);
        return redirect('/dashboard/dokter/data')->with('alert-success','Data Berhasil disimpan');

    }
    function dokter_edit($id){
        $data=Dokter::where('id',$id)->get();
        return view('admin.dokter_edit',[
            'data' => $data
        ]);
    }
    function dokter_update(Request $request){
        $request->validate([
                'nama' => 'required',
                'nip' => 'required'
            ]);
            $id=$request->id;
             $date=date('Y-m-d');

         DB::table('dokter')->where('id',$id)->update([
            'nama' => $request->nama,
            'nip' =>$request->nip,
            'jenis_kelamin' => $request->kelamin,
            'tanggal_lahir' => $request->tgl_lhr,
            'tempat_lahir' => $request->tmp_lhr,
            'alamat' => $request->alamat,
            'telepon' => $request->no_hp,
            'poli' => $request->poli,
        ]);
        return redirect('/dashboard/dokter/data')->with('alert-success','Data Berhasil diubah');

    }
    function dokter_delete($id){
        Dokter::where('id',$id)->delete();
        return redirect('/dashboard/dokter/data')->with('alert-success','Data Berhasil terhapus');

    }





    // data poli

function poli(){
    $data=Poli::orderBy('id','desc')->get();
        return view('admin.poli_data',[
            'data' =>$data
        ]);
}
function  poli_act(Request $request){
       $request->validate([
            'nama' => 'required',
        ]);

         DB::table('poli')->insert([
            'prosedur' => $request->nama,
        ]);
        return redirect('/dashboard/poli/data')->with('alert-success','Data Berhasil');

}
function  poli_edit($id){
    $dpoli=Poli::where('id',$id)->get();
       $data=Poli::orderBy('id','desc')->get();
        return view('admin.poli_edit',[
            'data' =>$data,
            'poli' => $dpoli
        ]);
}
function  poli_update(Request $request){
        $request->validate([
            'nama' => 'required',
        ]);

        $id=$request->id;
         DB::table('poli')->where('id',$id)->update([
            'prosedur' => $request->nama,
        ]);
        return redirect('/dashboard/poli/data')->with('alert-success','Data Berhasil');


}
function  poli_delete($id){
         Poli::where('id',$id)->delete();
        return redirect('/dashboard/poli/data')->with('alert-success','Data Berhasil');
       
}


// rekam medis
function  rekam(){
    $data=Rekam::orderBy('id','desc')->get();
        return view('admin.rekam_data',[
            'data' =>$data
        ]);
}
function  rekam_add(){
    return view('admin.rekam_add');
}
function  rekam_act(Request $request){
    $request->validate([
            'pasien' => 'required',
    ]);
    $kode_rekam=mt_rand(100000, 999999);

        $date=date('Y-m-d');
        if($request->cek_rujuk == "1"){
            // jika dirujuk

             DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'id_dokter' => $request->dokter,

                    'kode_rekam'=> $kode_rekam,
                    'id_poli'=> $request->poli,
                    'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 1,
                    'status' => 1
            ]);

             DB::table('rujukan')->insert([
                 'kartu_berobat'=> $request->kartu,
                 'id_pasien' => $request->pasien,
                 'id_rekam'=> $kode_rekam,
                'rs_tujuan' => $request->rs_rujuk,
                'tgl_surat' => $request->tgl_rujuk
            ]);

        }else{
            if($request->kartu == "3"){
              DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'id_dokter' => $request->dokter,

                    'kode_rekam'=> $kode_rekam,
                    'id_poli'=> $request->poli,
                     'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'uang_diterima'=>"30000",
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 0,
                    'status' => 1
            ]);  

            }else{
                DB::table('rekam')->insert([
                    'id_pasien' => $request->pasien,
                    'id_dokter' => $request->dokter,

                    'kode_rekam'=> $kode_rekam,
                    'id_poli'=> $request->poli,
                     'petugas' => $request->pegawai,
                    'uang_diterima'=>"0",
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 0,
                    'status' => 1
            ]);
            }
           
        }
    

        return redirect('/dashboard/rekam/data')->with('alert-success','Data sudah terkirim');


}
function  rekam_edit($id){
   $data=Rekam::where('id',$id)->get();
    return view('admin.rekam_edit',[
        'data' =>$data
    ]);

}
function  rekam_update(Request $request){
    $request->validate([
            'pasien' => 'required',
    ]);
    $kode_rekam=$request->kode_rekam;
    $data_rujuk=Rekam::where('kode_rekam',$kode_rekam)->first();
    $date=date('Y-m-d');

    if($data_rujuk->status_rujuk == "0"){
        if($request->cek_rujuk == "1"){
            // jika dirujuk

             DB::table('rekam')->where('kode_rekam',$kode_rekam)->update([
                    'id_pasien' => $request->pasien,
                    'id_dokter' => $request->dokter,

                    'id_poli'=> $request->poli,
                    'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 1,
                    'status' => 1
            ]);

             DB::table('rujukan')->where('id_rekam',$kode_rekam)->update([
                 'kartu_berobat'=> $request->kartu,
                 'id_pasien' => $request->pasien,
                'rs_tujuan' => $request->rs_rujuk,
                'tgl_surat' => $request->tgl_rujuk
            ]);

        }else{
              DB::table('rekam')->where('kode_rekam',$kode_rekam)->update([
                    'id_pasien' => $request->pasien,
                    'id_poli'=> $request->poli,
                     'petugas' => $request->pegawai,
                    'kartu_berobat' => $request->kartu,
                    'tanggal' => $date,
                    'diagnosa' => $request->diagnosa,
                    'pengobatan' => $request->pengobatan,
                    'tanggal_keluar' =>$request->tgl_keluar,
                    'status_rujuk' => 0,
                    'status' => 1
            ]);
        }


    }

        return redirect('/dashboard/rekam/data')->with('alert-success','Data sudah terkirim');


}
function  rekam_delete(){}


// data rujukan
function  rujukan(){
   $data=Rekam::orderBy('id','desc')->where('status_rujuk','1')->get();
        return view('admin.rujukan',[
            'data' =>$data
        ]);
}


function cetak_kwitansi($id){
    $dt=Rekam::where('id',$id)->first();
    return view('cetak.kwitansi',[
        'dt'=> $dt
    ]);
}

function cetak_rujukan($id){
    $dt=Rujukan::where('id_rekam',$id)->first();

    return view('cetak.surat_rujuk',[
        'dt'=> $dt
    ]);
}


 function cek_rujuk(Request $request){
    $cek_status=$request->cek_rujuk;

    if($cek_status == 1){
        echo"
         <div class='form-group'>
            <label >Rumah Sakit Rujukan</label>
            <input type='text' class='form-control'  name='rs_rujuk' value='Rumah Sakit Umum Hasanuddin Kuta Cane' readonly>
        </div>
        <div class='form-group'>
            <label >Tanggal surat</label>
            <input type='date' class='form-control'  name='tgl_rujuk'>
        </div>
        ";
    }else{
        
    }

 }

    function cetak_rujukan_data(){
            $year=date('Y');
                $data=Rekam::whereYear('tanggal',$year)->get();
                return view('cetak.cetak_rujukan',[
                    'data'=> $data
                ]);

        }

        function kunjungan(){
        $data=Rekam::orderBy('id','asc')->get();
        return view('admin.kunjungan',[
            'data' =>$data
        ]);
    }
        function cetak_kunjungan(){
            $year=date('Y');
             $data=Rekam::whereYear('tanggal',$year)->get();
            return view('cetak.cetak_kunjungan',[
                'data'=> $data
            ]);
        } 



 function profile(){
    return view('admin.v_profile');
 }

  function struktur(){
    return view('admin.v_struktur');
 }

   function pelayanan(){
    return view('admin.v_pelayanan');
 }
    function visimisi(){
    return view('admin.v_visimisi');
 }

   function galeri(){
    return view('admin.v_galeri');
 }


 function role(){
     $data=Admin::orderBy('id','asc')->get();
     return view('admin.r_role_data',[
         'data' =>$data
     ]);
 }

  function role_edit($id){
     $data_user=Admin::where('id',$id)->first();
     $data=Admin::orderBy('id','asc')->get();

     return view('admin.r_role_data',[
         'data' =>$data,
         'd_user' =>$data_user
     ]);
 }

  function role_update(Request $request){
    $request->validate([
         'username' => 'required',
         'password' => 'required',
         'role' => 'required',
    ]);
    $cek_admin=Admin::where('level',1)->count();
    $cek_kapus=Admin::where('level',2)->count();

    if($cek_admin < 3 || $cek_kapus < 1){
        if($request->role == 1){
            Admin::insert([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'level' => 1,
                'status' => 1,
            ]);
     return redirect('/dashboard/role/data')->with('alert-success','data telah berhasil ditambahkan');

         }elseif($request->role == 2){
        Admin::insert([
             'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => 2,
            'status' => 1
        ]);
     return redirect('/dashboard/role/data')->with('alert-success','data telah berhasil ditambahkan');

    }
    }else{

     return redirect('/dashboard/role/data')->with('alert-success','maaf data sudah maksimal');

    }
    
 }

 function role_delete($id){
     Admin::where('id',$id)->delete();
     return redirect('/dashboard/role/data')->with('alert-success','Data telah terhapus');

 }



 function pengaturan(){
     $username= Session::get('adm_username');
    $data= Admin::where('username',$username)->first();
    return view('admin.pengaturan',[
        'data'=> $data
    ]);

 }

  function pengaturan_update(Request $request){
     $username= Session::get('adm_username');
   
     if($request->password == ""){
        return redirect('/dashboard')->with('alert-success','Tidak Ada perubahan');
     }else{
         Admin::where('level','1')->update([
             'password' =>bcrypt($request->password)
         ]);
        return redirect('/dashboard/pengaturan/data')->with('alert-success','Password telah berubah');

     }

 }






}
