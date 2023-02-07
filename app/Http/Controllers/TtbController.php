<?php

namespace App\Http\Controllers;

use App\Models\model_do;
use App\Models\model_do_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class TtbController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $dtdo =  DB::table('do as d')
            ->select(
                'd.no_do',
                'd.tgl_do',
                'd.no_po',
                'd.NoRefDo',
                'd.retur'
            )
            ->get();

        return view('do.data-do', compact('dtdo'));
    }

    public function addttb(Request $request)
    {
        // 
        $ids = DB::table('po')->orderBy('created_at')
            ->pluck('no_po', 'no_po');

        $brg = DB::table('barang')->orderBy('created_at')
            ->pluck('nm_barang', 'kd_barang');

        return view('do.add-do')->with([
            'data' => $ids,
            'databrg' => $brg,
        ]);
    }

    public function simpanttb(Request $request)
    {
        // 
        try {
            $validator = Validator::make($request->all(), [
                'no_po' => 'required',
                'noref' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $year = date('Y');
            $yy = substr($year, 2, 2);
            $max_do = DB::table('do')->max('no_do');
            if (!isset($max_do)) {
                $kode = '001';
            } else {
                $urut_do = substr($max_do, 5);
                $kode_do = $urut_do + 1;
                $jml_kar = strlen($kode_do);
                if ($jml_kar == 1) {
                    $nol = '00';
                }
                if ($jml_kar == 2) {
                    $nol = '0';
                }
                if ($jml_kar == 3) {
                    $nol = '';
                }

                $kode = $nol . $kode_do;
            }
            $no_do = 'DO' . $yy . $kode;
            $data = new model_do();
            $data->no_do = $no_do;
            $data->tgl_do = date('Y-m-d');
            $data->no_po = $request->no_po;
            $data->NoRefDo = $request->noref;
            $data->save();

            foreach ($request->addMoreInputFields as $det) {
                // 
                $detail = new model_do_detail();
                $detail->no_do = $no_do;
                $detail->kd_barang = $det['barang'];
                $detail->jumlah = $det['jumlah'];
                $detail->keterangan = $det['keterangan'];
                $detail->statusenabled = true;
                $detail->save();
            }

            return redirect('ttb')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
            // dd($e->getMessage());
        }
    }
    public function detailttb(Request $request, $kode)
    {
        // 
        // 
        $dtdo =  DB::table('do as d')
            ->select(
                'd.no_do',
                'd.tgl_do',
                'd.no_po',
                'd.NoRefDo'
            )
            ->where('d.no_do', $kode)
            ->first();

        $detail = DB::table('do_detail as dd')
            ->join('barang as brg', 'brg.kd_barang', 'dd.kd_barang')
            ->select('brg.nm_barang', 'brg.hrg_satuan', 'dd.jumlah', 'dd.keterangan')
            ->where('dd.no_do', $kode)
            ->where('dd.statusenabled', true)
            ->get();

        return view('do.detail-do')->with([
            'data' =>  $dtdo,
            'detail' => $detail,
        ]);
    }
}
