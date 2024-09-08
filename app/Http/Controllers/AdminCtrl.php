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
                return redirect('/login')->with('alert-danger','Silahkan Login');
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
        
        function barang_detail($id){
            $data = Barang::where('id',$id)->get();
            return view('admin.barang_detail',[
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
            Transaksi::where('barang_id',$id)->delete();
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
         $barang= Barang::where('barcode',$request->code)->first();

         if (!$barang) {
            return redirect()->back()->with('alert-danger', 'Barcode tIdak ditemukan');
        }
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
         $barang= Barang::where('barcode',$request->code)->first();
         if (!$barang) {
            return redirect()->back()->with('alert-danger', 'Barcode tIdak ditemukan');
        }
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
        $trs=Transaksi::where('id',$id)->first();

        $barang= Barang::where('id',$trs->barang_id)->first();
        $barang_id=$barang->id;

        $total=$barang->jumlah - $trs->jumlah;
       
        DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total
         ]);

        Transaksi::where('id',$id)->delete();
        return redirect('/dashboard/barang_masuk/data')->with('alert-danger','Data dihapus');

    }

    // ajax barang masuk dari kode
    function ajax_kode(Request $request){
        $kode=$request->kode;
        $dbr = Barang::where('barcode',$kode)->first();
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
         $barang= Barang::where('barcode',$request->code)->first();
         if (!$barang) {
            return redirect()->back()->with('alert-danger', 'Barcode tIdak ditemukan');
        }
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
         $barang= Barang::where('barcode',$request->code)->first();
         if (!$barang) {
            return redirect()->back()->with('alert-danger', 'Barcode tIdak ditemukan');
        }
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
        $trs=Transaksi::where('id',$id)->first();

        $barang= Barang::where('id',$trs->barang_id)->first();
        $barang_id=$barang->id;

        $total=$barang->jumlah +  $trs->jumlah;
       
        DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total
         ]);

        Transaksi::where('id',$id)->delete();
        return redirect('/dashboard/barang_keluar/data')->with('alert-danger','Data dihapus');

    }


   //transaksi 

   function transaksi(){
        $data = Transaksi::orderBy('id','desc')->get();
        return view('admin.transaksi_data',[
            'data' =>$data
        ]);
    }
    function transaksi_detail($id){
        $data = Transaksi::where('id',$id)->get();
        $trs = Transaksi::where('id',$id)->first();
        $data_barang=Barang::where('id',$trs->barang_id)->get();
        return view('admin.transaksi_detail',[
            'data' =>$data,
            'data_barang' => $data_barang
        ]);
    }

    function transaksi_delete($id){
        $trs=Transaksi::where('id',$id)->first();

        $barang= Barang::where('id',$trs->barang_id)->first();
        $barang_id=$barang->id;
        
        if($trs->ket == "masuk"){
            $total=$barang->jumlah -  $trs->jumlah;
        }elseif($trs->ket == "keluar"){
            $total=$barang->jumlah +  $trs->jumlah;
        }
       
        DB::table('barang')->where('id',$barang_id)->update([
            'jumlah' => $total
         ]);

        Transaksi::where('id',$id)->delete();
        return redirect('/dashboard/transaksi/data')->with('alert-danger','Data dihapus');
    }
// cetak barcode

function cetak_barcode_peritem(Request $request){
    $jumlah=$request->cetak;
    $id=$request->id;
    $barang=Barang::where('id',$id)->first();
    $barcode=$barang->barcode;
    $data=array();
    
    for($i=0;$i<$jumlah;$i++){
       $data[]= $barcode; 
    }

    return view('cetak.cetak_item_br',[
        'data' =>$data
    ]);

}
   


// cetak laporan
function cetak_barang(Request $request){
    $dari =$request->dari;
    $sampai =$request->sampai;  

    $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
    $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

    $cek_data=DB::table('barang')
            ->whereBetween('tgl', [$dari, $sampai])
            ->orderBy('tgl','desc')
            ->get();

    if(count($cek_data) < 1){
         return redirect()->back();
    }
            
    return view('cetak.cetak_barang',[
        'data' =>$cek_data,
        'dari' => $fdari,
        'sampai' => $fsampai,

    ]);
}

function cetak_barang_masuk(Request $request){
    $dari =$request->dari;
    $sampai =$request->sampai;  

    $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
    $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

    $cek_data=DB::table('transaksi')
            ->where('ket',"masuk")
            ->whereBetween('tgl', [$dari, $sampai])
            ->orderBy('tgl','desc')
            ->get();

    if(count($cek_data) < 1){
         return redirect()->back();
    }
            
    return view('cetak.cetak_barang_masuk',[
        'data' =>$cek_data,
        'dari' => $fdari,
        'sampai' => $fsampai,

    ]);
}


function cetak_barang_keluar(Request $request){
    $dari =$request->dari;
    $sampai =$request->sampai;  

    $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
    $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

    $cek_data=DB::table('transaksi')
            ->where('ket',"keluar")
            ->whereBetween('tgl', [$dari, $sampai])
            ->orderBy('tgl','desc')
            ->get();

    if(count($cek_data) < 1){
         return redirect()->back();
    }
            
    return view('cetak.cetak_barang_keluar',[
        'data' =>$cek_data,
        'dari' => $fdari,
        'sampai' => $fsampai,

    ]);
}

function cetak_transaksi(Request $request){
    $dari =$request->dari;
    $sampai =$request->sampai;  

    $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
    $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

    $cek_data=DB::table('transaksi')
            ->whereBetween('tgl', [$dari, $sampai])
            ->orderBy('tgl','desc')
            ->get();

    if(count($cek_data) < 1){
         return redirect()->back();
    }
            
    return view('cetak.cetak_transaksi',[
        'data' =>$cek_data,
        'dari' => $fdari,
        'sampai' => $fsampai,

    ]);
}

function uji_data(){
    $data = Barang::orderBy('id','asc')->get();
    return view('admin.uji_barang',[
        'data' => $data
    ]);
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
