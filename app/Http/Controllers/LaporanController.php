<?php

namespace App\Http\Controllers;

use App\Models\model_barang;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //
    public function laporanPenermintaanGet()
    {
        // 
        return view('laporan.data-permintaan');
    }

    public function laporanPenerimaanGet()
    {
        // 
        return view('laporan.data-penerimaan');
    }

    public function laporanReturGet()
    {
        return view('laporan.data-retur');
    }
    public function laporanPenermintaan(Request $request)
    {
        // 
        $dtfpb =  DB::table('fpb as f')
            ->join('bagian as bg', 'bg.kd_bagian', 'f.kd_bagian')
            ->join('fpb_detail as fd', 'fd.no_fpb', 'f.no_fpb')
            ->join('barang as br', 'br.kd_barang', 'fd.kd_barang')
            ->select(
                'f.tgl_fpb',
                'f.no_fpb',
                'bg.nm_bagian',
                'f.tgl_diperlukan',
                'f.pemohon',
                'fd.jumlah',
                'br.nm_barang',
                'br.hrg_satuan',
                DB::raw('(CASE f.status WHEN  1 THEN "TerValidasi"
                WHEN  0 THEN "Pending"
                ELSE "Pending"
                END) AS status')

            )
            ->whereBetween('tgl_fpb', [$request->startdate, $request->enddate])
            ->orderBy('f.created_at', 'desc')
            ->get();

        $cetak = PDF::loadview('laporan.permintaan-barang', ['dtfpb' => $dtfpb]);
        return $cetak->setPaper('a4', 'landscape')->stream('laporan-permintaan-barang.pdf');
    }

    public function laporanPenerimaan(Request $request)
    {
        // 
        $dtfpb =  DB::table('do as d')
            ->join('po as p', 'p.no_po', 'd.no_po')
            ->join('supplier as sp', 'sp.kd_supplier', 'p.kd_supplier')
            ->join('do_detail as dd', 'dd.no_do', 'd.no_do')
            ->join('barang as brg', 'brg.kd_barang', 'dd.kd_barang')
            ->select(
                'd.no_do',
                'd.tgl_do',
                'p.no_po',
                'sp.nm_supplier',
                'brg.nm_barang',
                'brg.hrg_satuan',
                'dd.jumlah',

            )
            ->whereBetween('tgl_do', [$request->startdate, $request->enddate])
            ->orderBy('d.tgl_do', 'desc')
            ->get();

        $cetak = PDF::loadview('laporan.penerimaan-barang', ['dtfpb' => $dtfpb]);
        return $cetak->setPaper('a4', 'landscape')->stream('laporan.penerimaan-barang.pdf');
    }

    public function laporanRetur(Request $request)
    {
        // 
        $dtfpb =  DB::table('retur as r')
            ->join('kembalikan as k', 'k.no_ret', 'r.no_ret')
            ->join('barang as brg', 'brg.kd_barang', 'k.kd_barang')
            ->join('do as d', 'd.no_do', 'r.no_do')
            ->join('po as p', 'p.no_po', 'd.no_po')
            ->join('supplier as s', 's.kd_supplier', 'p.kd_supplier')
            ->select(
                'r.no_ret',
                'r.tgl_ret',
                'r.no_do',
                'p.no_po',
                's.kd_supplier',
                's.nm_supplier',
                'brg.nm_barang',
                'k.jml_ret',
                'k.ket_ret'

            )
            ->whereBetween('r.tgl_ret', [$request->startdate, $request->enddate])
            ->orderBy('r.tgl_ret', 'desc')
            ->get();

        $cetak = PDF::loadview('laporan.retur-barang', ['dtfpb' => $dtfpb]);
        return $cetak->setPaper('a4', 'landscape')->stream('laporan.retur-barang.pdf');
    }
}
