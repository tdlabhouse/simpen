<?php

namespace App\Http\Controllers;

use App\Models\model_kembalikan;
use App\Models\model_retur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ReturController extends Controller
{
    //
    public function addretur(Request $request, $kode)
    {
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

        foreach ($detail as $rt) {
            $jml[] = $rt->jumlah;
        }
        $jml_penerimaan = array_sum($jml);
        // dd(array_sum($jml));
        $brg = DB::table('barang')->orderBy('created_at')
            ->pluck('nm_barang', 'kd_barang');


        $retur = DB::table('retur as r')
            ->select(
                'r.no_ret'
            )
            ->where('r.no_do', $kode)
            ->get();

        if (count($retur) > 0) {
            foreach ($retur as $rt) {
                $detail_retur =  DB::table('kembalikan as km')
                    ->join('barang as brg', 'brg.kd_barang', 'km.kd_barang')
                    ->select(
                        'brg.nm_barang',
                        'brg.hrg_satuan',
                        'km.kd_barang',
                        'km.jml_ret',
                        'km.ket_ret',
                        'km.updated_at',
                    )
                    ->where('km.no_ret', $rt->no_ret)
                    ->get();

                foreach ($detail_retur as $dr) {
                    $arrdetr[] = array(
                        'nm_barang' => $dr->nm_barang,
                        'hrg_satuan' => $dr->hrg_satuan,
                        'kd_barang' => $dr->kd_barang,
                        'jml_ret' => $dr->jml_ret,
                        'ket_ret' => $dr->ket_ret,
                        'tgl' => $dr->updated_at,
                    );
                }
            }
        } else {
            $detail_retur = null;
        }
        return view('retur.add-retur')->with([
            'data' =>  $dtdo,
            'detail' => $detail,
            'brg' =>  $brg,
            'retur' =>  $retur,
            'detret' =>  $arrdetr,
            'jml' =>  $jml_penerimaan,
        ]);
    }

    public function simpanretur(Request $request)
    {
        // 
        foreach ($request->addMoreInputFields as $det) {
            $detail = DB::table('do_detail as dd')
                ->join('barang as brg', 'brg.kd_barang', 'dd.kd_barang')
                ->select('brg.nm_barang', 'brg.hrg_satuan', 'dd.jumlah', 'dd.keterangan')
                ->where('dd.no_do', $request->nodo)
                ->where('dd.kd_barang', $det['barang'])
                ->where('dd.statusenabled', true)
                ->first();

            if (isset($detail)) {
                if ($det['jumlah'] > $detail->jumlah) {
                    return back()->with('toast_error', 'Quantity melebihi penerimaan!!');
                }
            } else {
                return back()->with('toast_error', 'Barang Tidak ada di penerimaan!!');
            }
        }


        try {

            $validator = Validator::make($request->all(), [
                'nodo' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $year = date('Y');
            $yy = substr($year, 2, 2);
            $max_retur = DB::table('retur')->max('no_ret');
            if (!isset($max_retur)) {
                $kode = '001';
            } else {
                $urut_retur = substr($max_retur, 5);
                $kode_retur = $urut_retur + 1;
                $jml_kar = strlen($kode_retur);
                if ($jml_kar == 1) {
                    $nol = '00';
                }
                if ($jml_kar == 2) {
                    $nol = '0';
                }
                if ($jml_kar == 3) {
                    $nol = '';
                }

                $kode = $nol . $kode_retur;
            }
            $no_retur = 'RT' . $yy . $kode;
            $data = new model_retur();
            $data->no_ret = $no_retur;
            $data->tgl_ret = date('Y-m-d');
            $data->no_do = $request->nodo;
            $data->save();

            foreach ($request->addMoreInputFields as $det) {
                // 

                $detail_do = DB::table('do_detail as dd')
                    ->join('barang as brg', 'brg.kd_barang', 'dd.kd_barang')
                    ->select('dd.id', 'brg.nm_barang', 'brg.hrg_satuan', 'dd.jumlah', 'dd.keterangan')
                    ->where('dd.no_do', $request->nodo)
                    ->where('dd.kd_barang',  $det['barang'])
                    ->where('dd.statusenabled', true)
                    ->first();


                $update =  DB::table('do_detail')->where('no_do',  $request->nodo)->where('id',  $detail_do->id)
                    ->update(
                        [
                            'jumlah' => $detail_do->jumlah -  $det['jumlah'],
                        ]
                    );


                $detail = new model_kembalikan();
                $detail->no_ret = $no_retur;
                $detail->kd_barang = $det['barang'];
                $detail->jml_ret = $det['jumlah'];
                $detail->ket_ret = $det['keterangan'];
                $detail->save();
            }

            return redirect('ttb')->with('toast_success', 'Success!');
        } catch (\Exception $e) {
            // return back()->with('toast_error', 'Gagal!');
            dd($e->getMessage());
        }
    }
}
