<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('po.add-po')->with([
            'data' => $dtpo,
            'detail' =>  $detail,
            'brg' =>  $brg,
        ]);
        // return view('po.add-po', compact('dtpo'));
    }
}
