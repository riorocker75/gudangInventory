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

use App\Imports\BarangImport;
use Maatwebsite\Excel\Facades\Excel;


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

  // barang

// upload dari ecell

public function barang_import_excell(Request $request) {
// validasi
    $this->validate($request, [
        'file' => 'required|mimes:csv,xls,xlsx'
    ]);

    // menangkap file excel
    $file = $request->file('file');

    // membuat nama file unik
    $nama_file = rand().$file->getClientOriginalName();

    // upload ke folder file_barang di dalam folder public
    $file->move('file_barang',$nama_file);

    // import data
    Excel::import(new BarangImport, public_path('/file_barang/'.$nama_file));

    return redirect('/dashboard/barang/data')->with('alert-success','Data sudah terkirim');


}

  function barang(){
    $data = Barang::orderBy('id','desc')->get();
        return view('admin.barang_data',[
            'data' =>$data
        ]);
        
    }

        function barang_add(){
            return view('admin.barang_add');

        }

        function barang_act(Request $request){
            $request->validate([
                'nama' => 'required',
                'jumlah' => 'required',
                'beli' => 'required',
                'jual' => 'required',
                'lokasi' => 'required'
            ]);

            $barcode=mt_rand(100000, 999999);

                 DB::table('barang')->insert([
                    'nama' => $request->nama,
                    'code' => $request->code,
                    'barcode' => $barcode,
                    'beli' => $request->beli,
                    'jual' => $request->jual,
                    'lokasi' => $request->lokasi,
                    'jumlah' => $request->jumlah,
                    'tgl' => Date('Y-m-d'),
                    'status' => 1
            ]);

            return redirect('/dashboard/barang/data')->with('alert-success','Data sudah terkirim');


        }

        function barang_edit($id){
            $data = Barang::where('id',$id)->get();
            return view('admin.barang_edit',[
                'data' =>$data
            ]);
        }

        function barang_update(Request $request){
            $request->validate([
                'nama' => 'required',
                'jumlah' => 'required',
                'beli' => 'required',
                'jual' => 'required',
                'lokasi' => 'required'
            ]);

            $id=$request->id;
            DB::table('barang')->where('id',$id)->update([
                'nama' => $request->nama,
                'code' => $request->code,
                'beli' => $request->beli,
                'jual' => $request->jual,
                'lokasi' => $request->lokasi,
                'jumlah' => $request->jumlah,
        ]);
        return redirect('/dashboard/barang/data')->with('alert-success','Data sudah terkirim');


        }

        function barang_delete($id){
            Barang::where('id',$id)->delete();
                    return redirect('/dashboard/barang/data')->with('alert-success','Data Berhasil dihapus');  
        }

        // lokasi
        function lokasi(){
            $data = Lokasi::orderBy('id','desc')->get();
                return view('admin.lokasi_data',[
                    'data' =>$data
                ]);
                
            }
            function lokasi_act(Request $request){
                $request->validate([
                    'nama' => 'required',
                 ]);

                 DB::table('lokasi')->insert([
                    'nama'=> $request->nama,
                    'desc' => $request->desc,
                    'status' => 1
                 ]);
                 return redirect('/dashboard/lokasi/data')->with('alert-success','Data sudah terkirim');

            }

                function lokasi_edit($id){
                    $data = Lokasi::where('id',$id)->get();
                        return view('admin.lokasi_edit',[
                            'data' =>$data
                        ]);     
                }
        
                function lokasi_update(Request $request){
                    $request->validate([
                        'nama' => 'required',
                    ]);    
                    $id=$request->id;
                    DB::table('lokasi')->where('id',$id)->update([
                        'nama' => $request->nama,
                        'desc' =>$request->desc,
                        'status' => 1
                    ]);
                    return redirect('/dashboard/lokasi/data')->with('alert-success','Data Berhasil diubah');  

                }
        
                function lokasi_delete($id){
                    Lokasi::where('id',$id)->delete();
                    return redirect('/dashboard/lokasi/data')->with('alert-success','Data Berhasil dihapus');  
                }

    // barang masuk
    function barang_masuk(){
        $data = Transaksi::where('ket','masuk')->orderBy('id','desc')->get();
        return view('admin.masuk_data',[
            'data' =>$data
        ]);
    }
   
    function barang_masuk_add(){
        // $data = Transaksi::where('ket','masuk')->orderBy('id','desc')->get();
        return view('admin.masuk_add');
    }

    function barang_masuk_act(Request $request){
        $request->validate([
            'code' => 'required',
            'jumlah' => 'required',
         ]);
         $barang= Barang::where('code',$request->code)->first();
         $barang_id=$barang->id;

         $total=$request->jumlah + $barang->jumlah;
         DB::table('transaksi')->insert([
            'barang_id'=> $barang_id,
            'jumlah' => $request->jumlah,
            'ket' => "masuk",
            'tgl' => date('Y-m-d'),
            'status' => 1
         ]);

         DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total,
         ]);
         return redirect('/dashboard/barang_masuk/data')->with('alert-success','Data sudah terkirim');

    }

    function barang_masuk_edit($id){
        $data = Transaksi::where('id',$id)->get();
        $trs = Transaksi::where('id',$id)->first();
        $data_barang=Barang::where('id',$trs->barang_id)->get();
        return view('admin.masuk_edit',[
            'data' =>$data,
            'data_barang'=> $data_barang
        ]);
    }

    function barang_masuk_update(Request $request){
        $request->validate([
            'code' => 'required',
            'jumlah' => 'required',
         ]);
         $id=$request->id;
         $barang= Barang::where('code',$request->code)->first();
         $barang_id=$barang->id;

         $trs=Transaksi::where('id',$id)->first();

         $awal=$barang->jumlah -  $trs->jumlah;
         $total= $awal + $request->jumlah;

         DB::table('transaksi')->where('id',$id)->update([
            'barang_id'=> $barang_id,
            'jumlah' => $request->jumlah,
            'tgl' => date('Y-m-d'),
            'status' => 1
         ]);

         DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total
         ]);
         return redirect('/dashboard/barang_masuk/data')->with('alert-success','Data sudah terkirim');

      
    }

    function barang_masuk_delete($id){
        Transaksi::where('id',$id)->delete();
        return redirect('/dashboard/barang_masuk/data')->with('alert-danger','Data dihapus');

    }

    // ajax barang masuk dari kode
    function ajax_kode(Request $request){
        $kode=$request->kode;
        $dbr = Barang::where('code',$kode)->first();
        $nama=$dbr->nama;
        $harga_beli=rupiah_format($dbr->beli);
        $harga_jual=rupiah_format($dbr->jual);
        $lokasi=$dbr->lokasi;

        echo"
          <div class='form-group'>
                <label for='exampleInputEmail1'>Nama Item: $nama</label>
          </div>
         <div class='form-group'>
                <label for='exampleInputEmail1'>Harga Beli: $harga_beli</label>
          </div>
           <div class='form-group'>
                <label for='exampleInputEmail1'>Harga Jual: $harga_jual</label>
          </div>
          <div class='form-group'>
                <label for='exampleInputEmail1'>Lokasi: $lokasi</label>
          </div>
        ";


    }


    // barang keluar
    function barang_keluar(){
        $data = Transaksi::where('ket','keluar')->orderBy('id','desc')->get();
        return view('admin.keluar_data',[
            'data' =>$data
        ]);
    }
   
    function barang_keluar_add(){
        // $data = Transaksi::where('ket','keluar')->orderBy('id','desc')->get();
        return view('admin.keluar_add');
    }

    function barang_keluar_act(Request $request){
        $request->validate([
            'code' => 'required',
            'jumlah' => 'required',
         ]);
         $barang= Barang::where('code',$request->code)->first();
         $barang_id=$barang->id;

         $total=$barang->jumlah - $request->jumlah;
         DB::table('transaksi')->insert([
            'barang_id'=> $barang_id,
            'jumlah' => $request->jumlah,
            'ket' => "keluar",
            'tgl' => date('Y-m-d'),
            'status' => 1
         ]);

         DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total,
         ]);
         return redirect('/dashboard/barang_keluar/data')->with('alert-success','Data sudah terkirim');

    }

    function barang_keluar_edit($id){
        $data = Transaksi::where('id',$id)->get();
        $trs = Transaksi::where('id',$id)->first();
        $data_barang=Barang::where('id',$trs->barang_id)->get();
        return view('admin.keluar_edit',[
            'data' =>$data,
            'data_barang'=> $data_barang
        ]);
    }

    function barang_keluar_update(Request $request){
        $request->validate([
            'code' => 'required',
            'jumlah' => 'required',
         ]);
         $id=$request->id;
         $barang= Barang::where('code',$request->code)->first();
         $barang_id=$barang->id;

         $trs=Transaksi::where('id',$id)->first();

         $awal=$barang->jumlah +  $trs->jumlah;
         $total=$awal - $request->jumlah;

         DB::table('transaksi')->where('id',$id)->update([
            'barang_id'=> $barang_id,
            'jumlah' => $request->jumlah,
            'tgl' => date('Y-m-d'),
            'status' => 1
         ]);

         DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total
         ]);
         return redirect('/dashboard/barang_keluar/data')->with('alert-success','Data sudah terkirim');

      
    }

    function barang_keluar_delete($id){
        Transaksi::where('id',$id)->delete();
        return redirect('/dashboard/barang_keluar/data')->with('alert-danger','Data dihapus');

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
