<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use DB;
class User_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('user')->delete();
        Admin::create([
          'id' => 1,
          'username' => "admin",
          'password' =>bcrypt("admin"),
          'level' =>1,
          'status'=> 1
        ]);

        

        
    }
}
