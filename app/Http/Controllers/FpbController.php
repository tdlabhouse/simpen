<?php

namespace App\Http\Controllers;

use App\Models\model_bagian;
use App\Models\model_fpb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FpbController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        // $dtfpb = model_fpb::all()->sortBy('no_fpb');
        $dtfpb =  DB::table('fpb as f')
            ->join('bagian as bg', 'bg.kd_bagian', 'f.kd_bagian')
            ->join('barang as br', 'br.kd_barang', 'f.kd_barang')
            ->select(
                'f.tgl_fpb',
                'f.no_fpb',
                'bg.nm_bagian',
                'br.nm_barang',
                'f.jumlah',
                'f.tgl_diperlukan',
                'f.pemohon',
                DB::raw('(CASE f.status WHEN  1 THEN "Selesai"
                WHEN  0 THEN "Pending"
                ELSE "Pending"
                END) AS status')

            )
            ->orderBy('f.created_at', 'desc')
            ->get();
        return view('fpb.data-fpb', compact('dtfpb'));
    }
    public function addfpb()
    {
        $ids = DB::table('bagian')->orderBy('created_at')
            ->pluck('nm_bagian', 'kd_bagian');

        $brg = DB::table('barang')->orderBy('created_at')
            ->pluck('nm_barang', 'kd_barang');
        return view('fpb.add-fpb')->with([
            'data' => $ids,
            'databrg' => $brg,
        ]);
    }

    public function simpanfpb(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'bagian' => 'required',
                'pemohon' => 'required',
                'tanggal' => 'required',
                'tujuan' => 'required',
                'barang' => 'required',
                'keterangan' => 'required',
                'jumlah' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $year = date('Y');
            $yy = substr($year, 2, 2);
            $max_fpb = DB::table('fpb')->max('no_fpb');
            if (!isset($max_fpb)) {
                $kode = '01';
            } else {
                $urut_fpb = substr($max_fpb, 5);
                $kode_fpb = $urut_fpb + 1;
                $jml_kar = strlen($kode_fpb);
                if ($jml_kar == 1) {
                    $nol = '0';
                }
                if ($jml_kar == 2) {
                    $nol = '';
                }

                $kode = $nol . $kode_fpb;
            }
            $originalDate = $request->tanggal;
            $newDate = date("Y-m-d", strtotime($originalDate));
            $no_fpb = 'SUP' . $yy . $kode;
            $data = new model_fpb();
            $data->no_fpb = $no_fpb;
            $data->tgl_fpb = date('Y-m-d');
            $data->kd_bagian = $request->bagian;
            $data->pemohon = $request->pemohon;
            $data->tgl_diperlukan = $newDate;
            $data->tujuan = $request->tujuan;
            $data->kd_barang = $request->barang;
            $data->keterangan = $request->keterangan;
            $data->jumlah = $request->jumlah;
            $data->save();

            return redirect('fpb')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
        }
    }
}
