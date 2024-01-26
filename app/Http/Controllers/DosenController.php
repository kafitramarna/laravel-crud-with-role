<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index(Request $request){
        $data = Dosen::query()
        ->join('prodi', 'prodi.id', '=', 'dosen_pembimbing.program_studi')
        ->select('dosen_pembimbing.*','prodi.prodi');
        if($request->search){
            $data = $data->where('dosen_pembimbing.nama', 'LIKE', '%'.$request->search.'%');
            $data = $data->orWhere('dosen_pembimbing.nik', 'LIKE', '%'.$request->search.'%');
        }
        $data = $data->paginate(3);
        // dd($data->get());
        return view('dosen.index',[
            'dosen' => $data
        ]);
    }
    public function create(){
        return view('dosen.create',[
            'prodi' => Prodi::all()
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'nama' => 'required',
            'gelar_belakang' => 'required',
            'prodi' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        Dosen::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'program_studi' => (int)$request->prodi,
        ]);
        $user = new User();
        $user->username = $request->nik;
        $user->password = Hash::make("dosen");
        $user->role = "dosen";
        $user->save();
        return redirect()->route('dosen.index');
    }
    public function edit($id){
        $data = Dosen::find($id);
        return view('dosen.edit',[
            'prodi' => Prodi::all(),
        ],compact('data'));
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'nama' => 'required',
            'gelar_belakang' => 'required',
            'prodi' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        Dosen::whereId($id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'program_studi' => (int)$request->prodi,
        ]);
        return redirect()->route('dosen.index');
    }
    public function delete(Request $request, $id){
        $data = Dosen::find($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('dosen.index');
    }
    public function print_pdf()
    {
        $data = $data = Dosen::query()
        ->join('prodi', 'prodi.id', '=', 'dosen_pembimbing.program_studi')
        ->select('dosen_pembimbing.*','prodi.prodi')
        ->get();
        $pdf = PDF::loadview('dosen.print', [
            'dosen' => $data
        ]);
        return $pdf->stream();
    }
}
