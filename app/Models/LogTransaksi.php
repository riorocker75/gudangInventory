<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTransaksi extends Model
{
    use HasFactory;
    protected $table= "log_transaksi";
    public $timestamps = false;
}
