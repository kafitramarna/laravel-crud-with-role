<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JadwalMagang;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\TempatMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $dataPerPage = 4;
        $jadwal_magang = JadwalMagang::getData(
            $request->input('prodi', ''),
            $request->input('dosen', ''),
            $request->input('tempat_magang', ''),
            $request->input('jadwal_mulai_magang', ''),
            $request->input('jadwal_selesai_magang', ''),
            $dataPerPage
        );
        return view('index.index', [
            'jadwal_magang' => $jadwal_magang,
            'prodi' => Prodi::all(),
            'dosen' => Dosen::all(),
            'tempat_magang' => TempatMagang::all(),
        ]);
    }
    public function create()
    {
        return view('index.create', [
            'mahasiswa' => Mahasiswa::all(),
            'dosen' => Dosen::all(),
            'tempat_magang' => TempatMagang::all(),
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_mahasiswa' => 'required',
            'jadwal_mulai_magang' => 'required',
            'jadwal_selesai_magang' => 'required',
            'id_dosen' => 'required',
            'id_tempat_magang' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        JadwalMagang::create([
            'mahasiswa_id' => $request->id_mahasiswa,
            'jadwal_mulai_magang' => $request->jadwal_mulai_magang,
            'jadwal_selesai_magang' => $request->jadwal_selesai_magang,
            'id_dosen' => $request->id_dosen,
            'id_tempat_magang' => $request->id_tempat_magang,
        ]);
        return redirect()->route('dashboard.index');
    }
    public function edit( Request $request,$id){
        $data = JadwalMagang::find($id);
        // dd($data);
        return view('index.edit',[
            'dosen' => Dosen::all(),
            'mahasiswa' => Mahasiswa::find($data->mahasiswa_id),
            'tempat_magang' => TempatMagang::all(),
        ],compact('data'));
    }
    public function update(Request $request, $id){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id_mahasiswa' => 'required',
            'jadwal_mulai_magang' => 'required',
            'jadwal_selesai_magang' => 'required',
            'id_dosen' => 'required',
            'id_tempat_magang' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        JadwalMagang::whereId($id)->update([
            'mahasiswa_id' => $request->id_mahasiswa,
            'jadwal_mulai_magang' => $request->jadwal_mulai_magang,
            'jadwal_selesai_magang' => $request->jadwal_selesai_magang,
            'id_dosen' => $request->id_dosen,
            'id_tempat_magang' => $request->id_tempat_magang,
        ]);
        
        return redirect()->route('dashboard.index');
    }
    public function delete(Request $request,$id){
        $data = JadwalMagang::find($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('dashboard.index');
    }
    public function indexMahasiswa(){
        $data = JadwalMagang::query()
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
        )
        ->where('mahasiswa.nim','=',Auth::user()->username)
        ->get();
        // dd($data);
        return view('index.mahasiswa',[
            'jadwal_magang' => $data
        ]);
    }
    public function indexDosen(){
        $data = JadwalMagang::query()
        ->join('mahasiswa', 'mahasiswa.id', '=', 'jadwal_magang.mahasiswa_id')
        ->join('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'jadwal_magang.id_dosen')
        ->join('tempat_magang', 'tempat_magang.id', '=', 'jadwal_magang.id_tempat_magang')
        ->join('prodi', 'prodi.id', '=', 'mahasiswa.program_studi')
        ->select(
            'jadwal_magang.*',
            'mahasiswa.nama as nama_mahasiswa',
            'mahasiswa.nim',
            'dosen_pembimbing.nik',
            'dosen_pembimbing.nama as nama_dosen',
            'dosen_pembimbing.gelar_depan',
            'dosen_pembimbing.gelar_belakang',
            'tempat_magang.nama_tempat',
            'prodi.id as prodi_id',
            'prodi.prodi'
        )
        ->where('dosen_pembimbing.nik','=',Auth::user()->username)
        ->get();
        // dd($data);
        return view('index.dosen',[
            'jadwal_magang' => $data
        ]);
    }
    public function print_pdf(){
        $data = JadwalMagang::getAllData();
        $pdf = PDF::loadview('index.print',[
            'jadwal_magang' => $data
        ]);
        return $pdf->stream();
    }
}
