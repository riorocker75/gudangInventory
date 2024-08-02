<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Models\Pasien;
use App\Models\Rekam;
use App\Models\Rujukan;
use App\Models\Kwitansi;
use App\Models\Pegawai;
use App\Models\Poli;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dokter;

class KapusCtrl extends Controller
{
  	public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-kp')){
                return redirect('/login')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }
    
    function index(){
        return view('kepala.kepala');
    }
    function pasien(){
        $data=Pasien::orderBy('id','asc')->get();
        return view('kepala.pasien',[
            'data' =>$data
        ]);
    }
    function cetak_pasien(){
        $year=date('Y');
          $data=Pasien::whereYear('tgl_registrasi',$year)->orderBy('id','asc')->get();
            return view('cetak.cetak_pasien',[
                'data' =>$data
            ]);
    }



      function pegawai(){
            $data=Pegawai::orderBy('id','asc')->get();
            return view('kepala.pegawai',[
                'data' =>$data
            ]);
        }
        function cetak_pegawai(){
             $year=date('Y');
          $data=Pegawai::whereYear('tanggal',$year)->orderBy('id','asc')->get();
            return view('cetak.cetak_pegawai',[
                'data' =>$data
            ]);
        }


         function dokter(){
            $data=Dokter::orderBy('id','asc')->get();
            return view('kepala.dokter',[
                'data' =>$data
            ]);
        }

        function cetak_dokter(){
              $year=date('Y');
          $data=Dokter::whereYear('tanggal',$year)->orderBy('id','asc')->get();
            return view('cetak.cetak_dokter',[
                'data' =>$data
            ]);
        }


      function poli(){
        $data=Poli::orderBy('id','asc')->get();
        return view('kepala.poli',[
            'data' =>$data
        ]);
    }

      function rujukan(){
        $data=Rekam::orderBy('id','asc')->where('status_rujuk','1')->get();
            return view('kepala.rujukan',[
                'data' =>$data
            ]);
        }
        function cetak_rujukan(){
            $year=date('Y');
                $data=Rekam::whereYear('tanggal',$year)->get();
                return view('cetak.cetak_rujukan',[
                    'data'=> $data
                ]);

        }

        function kunjungan(){
        $data=Rekam::orderBy('id','asc')->get();
        return view('kepala.kunjungan',[
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


    function pengaturan(){
        $username= Session::get('kp_username');
        $data= Admin::where('username',$username)->first();
        return view('kepala.pengaturan',[
            'data'=> $data
        ]);

    }

     function pengaturan_update(Request $request){
   
        if($request->password == ""){
            return redirect('/dashboard/kapus')->with('alert-success','Tidak Ada perubahan');
        }else{
            Admin::where('level','2')->update([
                'password' =>bcrypt($request->password)
            ]);
            return redirect('/kapus/pengaturan/data')->with('alert-success','Password telah berubah');

        }

    }




}
