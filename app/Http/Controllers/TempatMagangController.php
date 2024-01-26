<?php

namespace App\Http\Controllers;

use App\Models\TempatMagang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TempatMagangController extends Controller
{
    public function index(){
        return view('tempat-magang.index',[
            'tempat_magang' => TempatMagang::all(),
        ]);
    }
    public function create(){
        return view('tempat-magang.create');
    }
    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama_tempat' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        TempatMagang::create([
            'nama_tempat' => $request->nama_tempat,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'telepon' => $request->telepon,
        ]);
        return redirect()->route('tempat-magang.index');
    }
    public function edit($id){
        $data = TempatMagang::find($id);
        return view('tempat-magang.edit',compact('data'));
    }
    public function update(Request $request, $id){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama_tempat' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'telepon' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        TempatMagang::whereId($id)->update([
            'nama_tempat' => $request->nama_tempat,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'telepon' => $request->telepon,
        ]);
        return redirect()->route('tempat-magang.index');
    }
    public function delete(Request $request, $id){
        $data = TempatMagang::find($id);
        if($data){
            $data->delete();
        }
        return redirect()->route('tempat-magang.index');
        
    }
    public function print_pdf()
    {
        $data = TempatMagang::all();
        $pdf = PDF::loadview('tempat-magang.print', [
            'tempat_magang' => $data
        ]);
        return $pdf->stream();
    }
}
