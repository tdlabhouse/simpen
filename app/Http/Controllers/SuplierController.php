<?php

namespace App\Http\Controllers;

use App\Models\model_supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SuplierController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $dtSuplier = model_supplier::all()->sortBy('kd_supplier');
        return view('supplier.data-supplier', compact('dtSuplier'));
    }


    public function addsupplier()
    {
        // 
        return view('supplier.add-supplier');
    }
    public function simpansupplier(Request $request)
    {
        // 

        try {
            $validator = Validator::make($request->all(), [
                'namasupplier' => 'required',
                'telepon' => 'required|numeric',
                'email' => 'required|email',
                'alamat' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $max_supplier = DB::table('supplier')->max('kd_supplier');
            if (!isset($max_supplier)) {
                $kode = '01';
            } else {
                $urut_supplier = substr($max_supplier, 3);
                $kode_supplier = $urut_supplier + 1;
                $jml_kar = strlen($kode_supplier);
                if ($jml_kar == 1) {
                    $nol = '0';
                }
                if ($jml_kar == 2) {
                    $nol = '';
                }
                $kode = $nol . $kode_supplier;
            }
            $kode_supplier = substr($request->namasupplier, 0, 3);
            $data = new model_supplier();
            $data->kd_supplier = strtoupper($kode_supplier) . $kode;
            $data->nm_supplier = $request->namasupplier;
            $data->almt_supplier = $request->alamat;
            $data->tlp_supplier = $request->telepon;
            $data->email_supplier = $request->email;
            $data->save();

            return redirect('supplier')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }

    public function editsupplier($kode)
    {
        // 
        $sup = model_supplier::where('kd_supplier', $kode)->first();
        return view('supplier.edit-supplier', compact('sup'));
    }
    public function updatesupplier($kode, Request $request)
    {
        // 
        try {
            $validator = Validator::make($request->all(), [
                'namasupplier' => 'required',
                'telepon' => 'required|numeric',
                'email' => 'required|email',
                'alamat' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            model_supplier::where('kd_supplier', $kode)
                ->update([
                    'nm_supplier' => $request->namasupplier,
                    'almt_supplier' => $request->alamat,
                    'tlp_supplier' =>  $request->telepon,
                    'email_supplier' =>  $request->email,
                ]);

            return redirect('supplier')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }
    public function deletesupplier($kode)
    {
        try {
            $bagian = model_supplier::where('kd_supplier', $kode);
            $bagian->delete();
            return back()->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }
}
