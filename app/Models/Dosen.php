<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen_pembimbing';
    protected $fillable = ['nama', 'nik','gelar_depan','gelar_belakang', 'program_studi'];
}
