<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $data = Mahasiswa::query()
            ->join('prodi', 'prodi.id', '=', 'mahasiswa.program_studi')
            ->select('mahasiswa.*', 'prodi.prodi');
        if ($request->search) {
            $data = $data->where('mahasiswa.nim', 'LIKE', '%' . $request->search . '%');
            $data = $data->orWhere('mahasiswa.nama', 'LIKE', '%' . $request->search . '%');
        }
        $data = $data->paginate(3);
        return view('mahasiswa.index', [
            'mahasiswa' => $data
        ]);
    }
    public function create()
    {
        return view('mahasiswa.create', [
            'prodi' => Prodi::all(),
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'program_studi' => (int)$request->prodi,
            'semester' => (int)$request->semester
        ]);
        $user = new User();
        $user->username = $request->nim;
        $user->password = Hash::make("mahasiswa");
        $user->role = "mahasiswa";
        $user->save();
        return redirect()->route('mahasiswa.index');
    }
    public function edit($id)
    {
        $data = Mahasiswa::find($id);
        return view('mahasiswa.edit', [
            'prodi' => Prodi::all(),
        ], compact('data'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim',
            'nama' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        Mahasiswa::whereId($id)->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'program_studi' => (int)$request->prodi,
            'semester' => (int)$request->semester
        ]);
        return redirect()->route('mahasiswa.index');
    }
    public function delete(Request $request, $id)
    {
        $data = Mahasiswa::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('mahasiswa.index');
    }
    public function print_pdf()
    {
        $data = Mahasiswa::query()
            ->join('prodi', 'prodi.id', '=', 'mahasiswa.program_studi')
            ->select('mahasiswa.*', 'prodi.prodi')
            ->get();
        $pdf = PDF::loadview('mahasiswa.print', [
            'mahasiswa' => $data
        ]);
        return $pdf->stream();
    }
}
