<?php

namespace App\Http\Controllers;

use App\Models\model_barang;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //
    public function laporanPenermintaan(Request $request)
    {
        // 
        $dtfpb =  DB::table('fpb as f')
            ->join('bagian as bg', 'bg.kd_bagian', 'f.kd_bagian')
            ->select(
                'f.tgl_fpb',
                'f.no_fpb',
                'bg.nm_bagian',
                'f.tgl_diperlukan',
                'f.pemohon',
                DB::raw('(CASE f.status WHEN  1 THEN "TerValidasi"
                WHEN  0 THEN "Pending"
                ELSE "Pending"
                END) AS status')

            )
            ->orderBy('f.created_at', 'desc')
            ->get();

        $cetak = PDF::loadview('laporan.permintaan-barang', ['dtfpb' => $dtfpb]);
        return $cetak->setPaper('a4', 'landscape')->stream('laporan-permintaan-barang.pdf');
    }
}
