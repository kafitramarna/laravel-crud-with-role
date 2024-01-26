<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class JadwalMagang extends Model
{
    use HasFactory;
    protected $table = 'jadwal_magang';
    protected $fillable = ['mahasiswa_id', 'id_dosen', 'id_tempat_magang', 'jadwal_mulai_magang', 'jadwal_selesai_magang'];
    public static function getData($prodi, $dosen, $tempat_magang, $jadwal_mulai_magang, $jadwal_selesai_magang, $dataPerPage)
    {
        $query = JadwalMagang::query()
            ->join('mahasiswa', 'mahasiswa.id', '=', 'jadwal_magang.mahasiswa_id')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'jadwal_magang.id_dosen')
            ->join('tempat_magang', 'tempat_magang.id', '=', 'jadwal_magang.id_tempat_magang')
            ->join('prodi', 'prodi.id', '=', 'mahasiswa.program_studi')
            ->select(
                'jadwal_magang.*',
                'mahasiswa.nama as nama_mahasiswa',
                'mahasiswa.nim',
                'dosen_pembimbing.nama as nama_dosen',
                'dosen_pembimbing.gelar_depan',
                'dosen_pembimbing.gelar_belakang',
                'tempat_magang.nama_tempat',
                'prodi.id as prodi_id',
                'prodi.prodi'
            );

        if ($prodi != "") {
            $query->where('prodi.id', '=', $prodi);
        }

        if ($dosen != "") {
            $query->where('dosen_pembimbing.id','=',$dosen);
        }

        if ($tempat_magang != "") {
            $query->where('tempat_magang.id','=',$tempat_magang);
        }

        if ($jadwal_mulai_magang != "") {
            $query->whereDate('jadwal_magang.jadwal_mulai_magang', '>=', Carbon::parse($jadwal_mulai_magang));
        }

        if ($jadwal_selesai_magang != "") {
            $query->whereDate('jadwal_magang.jadwal_mulai_magang', '<=', Carbon::parse($jadwal_mulai_magang));
        }
        $result = $query->paginate($dataPerPage);
        return $result;
    }
    public static function getAllData()
    {
        $query = DB::table('jadwal_magang')
            ->join('mahasiswa', 'mahasiswa.id', '=', 'jadwal_magang.mahasiswa_id')
            ->join('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'jadwal_magang.id_dosen')
            ->join('tempat_magang', 'tempat_magang.id', '=', 'jadwal_magang.id_tempat_magang')
            ->join('prodi', 'prodi.id', '=', 'mahasiswa.program_studi')
            ->select(
                'jadwal_magang.*',
                'mahasiswa.nama as nama_mahasiswa',
                'mahasiswa.nim',
                'dosen_pembimbing.nama as nama_dosen',
                'dosen_pembimbing.gelar_depan',
                'dosen_pembimbing.gelar_belakang',
                'tempat_magang.nama_tempat',
                'prodi.id as prodi_id',
                'prodi.prodi'
            )->get();
        return $query;
    }
}
