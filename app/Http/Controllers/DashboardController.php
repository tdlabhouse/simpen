<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        // 

        $dtfpb =  DB::table('fpb as f')
            ->select(
                'f.tgl_fpb',
                'f.no_fpb',
                'f.tgl_diperlukan',
                'f.pemohon'

            )
            ->orderBy('f.created_at', 'desc')
            ->get();

        $brg = DB::table('barang')->orderBy('created_at')->get();
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

        $invo = DB::table('invoice as pd')
            ->select('pd.JmlInv')->get();

        if (count($invo) != 0) {
            foreach ($invo as $dtp) {
                // 
                $jml_invo[] = $dtp->JmlInv;
            }
        }

        $jml_invoice = array_sum($jml_invo);
        return view('dashboard')->with([
            "databrg" => count($brg),
            "po" => count($dtpo),
            "inv" => $jml_invoice,
            "permintaan" => count($dtfpb),
        ]);
    }
}
