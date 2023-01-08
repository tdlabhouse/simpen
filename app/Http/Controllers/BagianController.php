<?php

namespace App\Http\Controllers;

use App\Models\model_bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class BagianController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $dtBagian = model_bagian::all()->sortBy('kd_bagian');
        return view('bagian.data-bagian', compact('dtBagian'));
    }
    public function addbagian()
    {
        // 
        return view('bagian.add-bagian');
    }
    public function simpanbagian(Request $request)
    {
        // 

        try {
            $validator = Validator::make($request->all(), [
                'namabagian' => 'required',
                'telepon' => 'required|numeric',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $max_bagian = DB::table('bagian')->max('kd_bagian');
            if (!isset($max_bagian)) {
                $kode = '01';
            } else {
                $urut_bagian = substr($max_bagian, 3);
                $kode_bagian = $urut_bagian + 1;
                $jml_kar = strlen($kode_bagian);
                if ($jml_kar == 1) {
                    $nol = '0';
                }
                if ($jml_kar == 2) {
                    $nol = '';
                }
                $kode = $nol . $kode_bagian;
            }
            $kode_bagian = substr($request->namabagian, 0, 3);
            $data = new model_bagian();
            $data->kd_bagian = strtoupper($kode_bagian) . $kode;
            $data->nm_bagian = $request->namabagian;
            $data->tlp_bagian = $request->telepon;
            $data->email = $request->email;
            $data->save();

            return redirect('bagian')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }

    public function editbagian($kode)
    {
        // 
        $bgn = model_bagian::where('kd_bagian', $kode)->first();
        return view('bagian.edit-bagian', compact('bgn'));
    }

    public function updatebagian($kode, Request $request)
    {
        // 
        try {
            $validator = Validator::make($request->all(), [
                'namabagian' => 'required',
                'telepon' => 'required|numeric',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            model_bagian::where('kd_bagian', $kode)
                ->update([
                    'nm_bagian' => $request->namabagian,
                    'tlp_bagian' => $request->telepon,
                    'email' =>  $request->email,
                ]);

            return redirect('bagian')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }

    public function deletebagian($kode)
    {
        try {
            $bagian = model_bagian::where('kd_bagian', $kode);
            $bagian->delete();
            return back()->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }

    public function combobagian()
    {
        $katdb = model_bagian::lists('kd_bagian', 'nm_bagian');
        return View::make('combo')->with('dcom', $katdb);
    }
}
