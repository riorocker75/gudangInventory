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
use App\Models\Admin;

class LoginCtrl extends Controller
{
   
    

    public function index(){
        return view('login.login');
    }
    
    function cek_login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $data = Admin::where('username',$username)->first();

        if($data){
           if($data->level == "1"){
            Session::flush();
                
                if(Hash::check($password,$data->password)){
                    Session::put('adm_username', $data->username);
                    Session::put('level', 1);
                    Session::put('login-adm',TRUE);
                    return redirect('/')->with('alert-success','Selamat Datang Kembali Admin');
                }else{
                    return redirect('/login')->with('alert-danger','Password atau Email, Salah !');
                }
           }elseif($data->level == "2"){
                Session::flush();
                
                if(Hash::check($password,$data->password)){
                    Session::put('kp_username', $data->username);
                    Session::put('level', 2);
                    Session::put('login-kp',TRUE);
                    return redirect('/dashboard/kapus')->with('alert-success','Selamat Datang Kembali');
                }else{
                    return redirect('/login')->with('alert-danger','Password atau Email, Salah !');
                }
           }     

        }else{
            return redirect('/login')->with('alert-danger','Password atau Email, Salah !');
        }



    }

    function logout(){
         Session::flush();
        return redirect('/login')->with('alert-success','Logout berhasil');
    }





}
