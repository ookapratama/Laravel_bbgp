<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiPpnpn extends Model
{
    use HasFactory;
    protected $table = 'pegawaiPpnpns';
    protected $fillable = [
    'name',  
    'jabatan',  
    ];
}
