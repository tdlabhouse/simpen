<?php

namespace App\Http\Controllers;

use App\Models\model_po;
use App\Models\model_po_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PoController extends Controller
{
    //
    public function index(Request $request)
    {
        // 
        $dtpo =  DB::table('po as p')
            ->join('supplier as sp', 'sp.kd_supplier', 'p.kd_supplier')
            ->select(
                'p.no_po',
                'p.tgl_po',
                'sp.nm_supplier',
                'p.no_fpb',
                'p.kepada',
                'p.note',
                'p.ppn'

            )
            ->get();
        return view('po.data-po', compact('dtpo'));
    }

    public function addpo($kode)
    {
        // 
        $dtpo = DB::table('fpb as f')
            ->join('bagian as bg', 'bg.kd_bagian', 'f.kd_bagian')
            ->select(
                'f.tgl_fpb',
                'f.no_fpb',
                'bg.nm_bagian',
                'f.tgl_diperlukan',
                'f.pemohon',
                'f.tujuan'

            )
            ->orderBy('f.created_at', 'desc')
            ->first();
        $detail = DB::table('fpb_detail as de')
            ->join('barang as br', 'br.kd_barang', '=', 'de.kd_barang')
            ->select('de.jumlah', 'de.keterangan', 'de.kd_barang', 'br.nm_barang')
            ->where('de.no_fpb', $kode)->where('de.statusenabled', true)->get();


        $brg = DB::table('barang')->orderBy('created_at')
            ->pluck('nm_barang', 'kd_barang');

        $supl = DB::table('supplier')->orderBy('created_at')
            ->pluck('nm_supplier', 'kd_supplier');

        return view('po.add-po')->with([
            'data' => $dtpo,
            'detail' =>  $detail,
            'brg' =>  $brg,
            'supl' =>  $supl,
        ]);
        // return view('po.add-po', compact('dtpo'));
    }

    public function simpanpo(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'npfpb' => 'required',
                'supplier' => 'required',
                'kepada' => 'required',
                'note' => 'required',
                'ppn' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $year = date('Y');
            $yy = substr($year, 2, 2);
            $max_po = DB::table('po')->max('no_po');
            if (!isset($max_po)) {
                $kode = '001';
            } else {
                $urut_fpb = substr($max_po, 5);
                $kode_fpb = $urut_fpb + 1;
                $jml_kar = strlen($kode_fpb);
                if ($jml_kar == 1) {
                    $nol = '00';
                }
                if ($jml_kar == 2) {
                    $nol = '0';
                }
                if ($jml_kar == 3) {
                    $nol = '';
                }

                $kode = $nol . $kode_fpb;
            }
            $no_po = 'PO' . $yy . $kode;
            $data = new model_po();
            $data->no_po = $no_po;
            $data->tgl_po = date('Y-m-d');
            $data->kd_supplier = $request->supplier;
            $data->no_fpb = $request->npfpb;
            $data->kepada = $request->kepada;
            $data->note = $request->note;
            $data->ppn = $request->ppn;
            $data->save();

            foreach ($request->addMoreInputFields as $det) {
                // 
                $detail = new model_po_detail();
                $detail->no_po = $no_po;
                $detail->kd_barang = $det['barang'];
                $detail->jumlah = $det['jumlah'];
                $detail->keterangan = $det['keterangan'];
                $detail->statusenabled = true;
                $detail->save();
            }

            $update =  DB::table('fpb')->where('no_fpb', $request->npfpb)
                ->update(
                    [
                        'status' => true,
                    ]
                );

            return redirect('po')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            return back()->with('toast_error', 'Gagal!');
            // dd($e->getMessage());
        }
    }
    public function cetakpo(Request $request, $kode)
    {
        // 
        $dtpo = DB::table('po as p')
            ->join('supplier as sp', 'sp.kd_supplier', 'p.kd_supplier')
            ->select(
                'sp.nm_supplier',
                'sp.almt_supplier',
                'sp.tlp_supplier',
                'sp.email_supplier'

            )
            ->orderBy('p.created_at', 'desc')
            ->first();

        $detail = DB::table('po_detail as pd')
            ->join('barang as br', 'br.kd_barang', '=', 'pd.kd_barang')
            ->select('pd.jumlah', 'pd.keterangan', 'pd.kd_barang', 'br.nm_barang')
            ->where('pd.no_po', $kode)->where('pd.statusenabled', true)->get();

        return view('po.cetak-po')->with([
            'data' => $dtpo,
            'detail' => $detail,
        ]);
    }
}
