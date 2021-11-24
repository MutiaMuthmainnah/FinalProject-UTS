<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pasien extends Model
{
    use HasFactory;   

    protected $fillable = ['nama', 'telepon', 'alamat', 'status', 'in_date_at', 'out_date_at'];
}
