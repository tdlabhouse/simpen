<?php

namespace App\Http\Controllers;

use App\Models\model_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class BarangController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $dtBarang = model_barang::all()->sortBy('kd_barang');
        return view('barang.data-barang', compact('dtBarang'));
    }
    public function addbarang(Request $request)
    {
        // 
        return view('barang.add-barang');
    }
    public function simpanbarang(Request $request)
    {
        // 

        try {
            $validator = Validator::make($request->all(), [
                'hargasatuan' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $max_barang = DB::table('barang')->max('kd_barang');
            if (!isset($max_barang)) {
                $kode = '0001';
            } else {
                $urut_barang = substr($max_barang, 1);
                $kode_barang = $urut_barang + 1;
                $jml_kar = strlen($kode_barang);
                if ($jml_kar == 1) {
                    $nol = '000';
                }
                if ($jml_kar == 2) {
                    $nol = '00';
                }
                if ($jml_kar == 3) {
                    $nol = '0';
                }
                if ($jml_kar == 4) {
                    $nol = '';
                }
                $kode = $nol . $kode_barang;
            }
            $kode_barang = substr($request->namabarang, 0, 1);
            $data = new model_barang();
            $data->kd_barang = strtoupper($kode_barang) . $kode;
            $data->nm_barang = $request->namabarang;
            $data->hrg_satuan = $request->hargasatuan;
            $data->satuan = $request->satuan;
            $data->jenis_barang = $request->jenisbarang;
            $data->created_at = date("Y-m-d H:i:s");
            $data->save();

            return redirect('barang')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }
    public function editbarang($kode)
    {
        // 
        $brg = model_barang::where('kd_barang', $kode)->first();
        return view('barang.edit-barang', compact('brg'));
    }

    public function updatebarang($kode, Request $request)
    {
        // 
        try {
            $validator = Validator::make($request->all(), [
                'hargasatuan' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            model_barang::where('kd_barang', $kode)
                ->update([
                    'nm_barang' => $request->namabarang,
                    'hrg_satuan' => $request->hargasatuan,
                    'satuan' =>  $request->satuan,
                    'jenis_barang' =>  $request->jenisbarang,
                ]);

            return redirect('barang')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }

    public function deletebarang($kode)
    {
        $barang = model_barang::where('kd_barang', $kode);
        $barang->delete();
        return back()->with('toast_success', 'Success!');
    }
}
