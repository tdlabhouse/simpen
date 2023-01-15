<?php

namespace App\Http\Controllers;

use App\Models\model_invoice;
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
                'p.ppn',
                DB::raw(
                    '(CASE p.status WHEN  1 THEN "Dibayar"
                WHEN  0 THEN "Belum Dibayar"
                ELSE "Belum Dibayar"
                END) AS status'
                )
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
                'f.tujuan',
                'f.status',

            )
            ->orderBy('f.created_at', 'desc')
            ->first();
        $detail = DB::table('fpb_detail as de')
            ->join('barang as br', 'br.kd_barang', '=', 'de.kd_barang')
            ->select('de.jumlah', 'de.keterangan', 'de.kd_barang', 'br.nm_barang', 'br.hrg_satuan')
            ->where('de.no_fpb', $kode)->where('de.statusenabled', true)->get();


        $brg = DB::table('barang')->orderBy('created_at')
            ->pluck('hrg_satuan', 'nm_barang', 'kd_barang');

        $supl = DB::table('supplier')->orderBy('created_at')
            ->pluck('nm_supplier', 'kd_supplier');

        $po = DB::table('po')->select('no_po')->where('no_fpb', $kode)->first();

        $detail_po = DB::table('po_detail as pd')
            ->join('barang as br', 'br.kd_barang', '=', 'pd.kd_barang')
            ->select('pd.jumlah', 'pd.keterangan', 'pd.kd_barang', 'br.nm_barang', 'br.hrg_satuan')
            ->where('pd.no_po', $po->no_po)->where('pd.statusenabled', true)->get();

        foreach ($detail_po as $dtp) {
            // 
            $harga[] = $dtp->hrg_satuan;
            $jml[] = $dtp->jumlah;
        }
        $arr_harga = array_sum($harga);
        $arr_jml = array_sum($jml);
        $total =  $arr_harga * $arr_jml;

        return view('po.add-po')->with([
            'data' => $dtpo,
            'detail' =>  $detail,
            'detail_po' =>  $detail_po,
            'brg' =>  $brg,
            'supl' =>  $supl,
            'total' =>  $total,
        ]);
        // return view('po.add-po', compact('dtpo'));
    }

    public function bayarpo(Request $request, $kode)
    {
        // 
        $dtpo = DB::table('po as p')
            ->join('supplier as sp', 'sp.kd_supplier', 'p.kd_supplier')
            ->select(
                'sp.nm_supplier',
                'sp.almt_supplier',
                'sp.tlp_supplier',
                'sp.email_supplier',
                'p.no_po',
                'p.tgl_po',
                'p.kd_supplier',
                'p.kepada',
                'p.note',
                'p.ppn',

            )
            ->where('p.no_po', $kode)
            ->orderBy('p.created_at', 'desc')
            ->first();

        $detail = DB::table('po_detail as pd')
            ->join('barang as br', 'br.kd_barang', '=', 'pd.kd_barang')
            ->select('pd.jumlah', 'pd.keterangan', 'pd.kd_barang', 'br.nm_barang', 'br.hrg_satuan')
            ->where('pd.no_po', $kode)->where('pd.statusenabled', true)->get();

        foreach ($detail as $dt) {
            // 
            $harga[] = $dt->hrg_satuan;
            $jml[] = $dt->jumlah;
        }
        $arr_harga = array_sum($harga);
        $arr_jml = array_sum($jml);
        $total =  $arr_harga * $arr_jml;
        return view('po.bayar-po')->with([
            'data' => $dtpo,
            'detail' => $detail,
            'total' => $total,
        ]);
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

    public function simpanbayar(Request $request)
    {
        // 
        try {
            $validator = Validator::make($request->all(), [
                'noref' => 'required|max:15',
                'jmlinv' => 'required',
                'ketinv' => 'required',
                'nopo' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $year = date('Y');
            $yy = substr($year, 2, 2);
            $max_inv = DB::table('invoice')->max('no_inv');
            if (!isset($max_inv)) {
                $kode = '001';
            } else {
                $urut_inv = substr($max_inv, 5);
                $kode_inv = $urut_inv + 1;
                $jml_kar = strlen($kode_inv);
                if ($jml_kar == 1) {
                    $nol = '00';
                }
                if ($jml_kar == 2) {
                    $nol = '0';
                }
                if ($jml_kar == 3) {
                    $nol = '';
                }

                $kode = $nol . $kode_inv;
            }
            $no_inv = 'IV' . $yy . $kode;
            $data = new model_invoice();
            $data->no_inv = $no_inv;
            $data->tgl_inv = date('Y-m-d');
            $data->no_po = $request->nopo;
            $data->NorevInv = $request->noref;
            $data->JmlInv = $request->jmlinv;
            $data->tglbayar = date('Y-m-d');;
            $data->KetInv = $request->ketinv;
            $data->ket_ret = $request->ketinv;
            $data->save();

            $update =  DB::table('po')->where('no_po', $request->nopo)
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
            ->where('p.no_po', $kode)
            ->orderBy('p.created_at', 'desc')
            ->first();

        $detail = DB::table('po_detail as pd')
            ->join('barang as br', 'br.kd_barang', '=', 'pd.kd_barang')
            ->select('pd.jumlah', 'pd.keterangan', 'pd.kd_barang', 'br.nm_barang', 'br.hrg_satuan')
            ->where('pd.no_po', $kode)->where('pd.statusenabled', true)->get();

        foreach ($detail as $dt) {
            // 
            $harga[] = $dt->hrg_satuan;
            $jml[] = $dt->jumlah;
        }
        $arr_harga = array_sum($harga);
        $arr_jml = array_sum($jml);
        $total =  $arr_harga * $arr_jml;
        return view('po.cetak-po')->with([
            'data' => $dtpo,
            'detail' => $detail,
            'total' => $total,
        ]);
    }
}
