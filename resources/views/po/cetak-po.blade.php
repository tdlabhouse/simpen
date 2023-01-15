<style>
    /* Housekeeping */
    body {
        font-size: 12px;
    }

    .spreadSheetGroup {
        /*font:0.75em/1.5 sans-serif;
    font-size:14px;
  */
        color: #333;
        background-color: #fff;
        padding: 1em;
    }

    /* Tables */
    .spreadSheetGroup table {
        width: 100%;
        margin-bottom: 1em;
        border-collapse: collapse;
    }

    .spreadSheetGroup .proposedWork th {
        background-color: #eee;
    }

    .tableBorder th {
        background-color: #eee;
    }

    .spreadSheetGroup th,
    .spreadSheetGroup tbody td {
        padding: 0.5em;

    }

    .spreadSheetGroup tfoot td {
        padding: 0.5em;

    }

    .spreadSheetGroup td:focus {
        border: 1px solid #fff;
        -webkit-box-shadow: inset 0px 0px 0px 2px #5292F7;
        -moz-box-shadow: inset 0px 0px 0px 2px #5292F7;
        box-shadow: inset 0px 0px 0px 2px #5292F7;
        outline: none;
    }

    .spreadSheetGroup .spreadSheetTitle {
        font-weight: bold;
    }

    .spreadSheetGroup tr td {
        text-align: center;
    }

    /*
.spreadSheetGroup tr td:nth-child(2){
  text-align:left;
  width:100%;
}
*/

    /*
.documentArea.active tr td.calculation{
  background-color:#fafafa;
  text-align:right;
  cursor: not-allowed;
}
*/
    .spreadSheetGroup .calculation::before,
    .spreadSheetGroup .groupTotal::before {
        /*content: "$";*/
    }

    .spreadSheetGroup .trAdd {
        background-color: #007bff !important;
        color: #fff;
        font-weight: 800;
        cursor: pointer;
    }

    .spreadSheetGroup .tdDelete {
        background-color: #eee;
        color: #888;
        font-weight: 800;
        cursor: pointer;
    }

    .spreadSheetGroup .tdDelete:hover {
        background-color: #df5640;
        color: #fff;
        border-color: #ce3118;
    }

    .documentControls {
        text-align: right;
    }

    .spreadSheetTitle span {
        padding-right: 10px;
    }

    .spreadSheetTitle a {
        font-weight: normal;
        padding: 0 12px;
    }

    .spreadSheetTitle a:hover,
    .spreadSheetTitle a:focus,
    .spreadSheetTitle a:active {
        text-decoration: none;
    }

    .spreadSheetGroup .groupTotal {
        text-align: right;
    }



    table.style1 tr td:first-child {
        font-weight: bold;
        white-space: nowrap;
        text-align: right;
    }

    table.style1 tr td:last-child {
        border-bottom: 1px solid #000;
    }



    table.proposedWork td,
    table.proposedWork th,
    table.exclusions td,
    table.exclusions th {
        border: 1px solid #000;
    }

    table.proposedWork thead th,
    table.exclusions thead th {
        font-weight: bold;
    }

    table.proposedWork td,
    table.proposedWork th:first-child,
    table.exclusions th,
    table.exclusions td {
        text-align: left;
        vertical-align: top;
    }

    table.proposedWork td.description {
        width: 50%;
    }

    table.proposedWork td.amountColumn,
    table.proposedWork th.amountColumn,
    table.proposedWork td:last-child,
    table.proposedWork th:last-child {
        text-align: center;
        vertical-align: top;
        white-space: nowrap;
    }

    .amount:before,
    .total:before {
        content: "$";
    }

    table.proposedWork tfoot td:first-child {
        border: none;
        text-align: right;
    }

    table.proposedWork tfoot tr:last-child td {
        font-size: 16px;
        font-weight: bold;
    }

    table.style1 tr td:last-child {
        width: 100%;
    }

    table.style1 td:last-child {
        text-align: left;
    }

    td.tdDelete {
        width: 1%;
    }

    table.coResponse td {
        text-align: left
    }

    table.shipToFrom td,
    table.shipToFrom th {
        text-align: left
    }

    .docEdit {
        border: 0 !important
    }

    .tableBorder td,
    .tableBorder th {
        border: 1px solid #000;
    }

    .tableBorder th,
    .tableBorder td {
        text-align: center
    }

    table.proposedWork td,
    table.proposedWork th {
        text-align: center
    }

    table.proposedWork td.description {
        text-align: left
    }
</style>

<div class="document active">
    <div class="spreadSheetGroup">


        <table class="shipToFrom">
            <thead style="font-weight:bold">
                <tr>
                    <th>Supplier</th>
                    <th>Di Kirim Ke</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td contenteditable="true" style="width:50%">
                        {{$data->nm_supplier}}<br />
                        <br />
                        {{$data->almt_supplier}}.<br />
                        {{$data->email_supplier}}<br />
                        {{$data->tlp_supplier}}
                    </td>
                    <td contenteditable="true" style="width:50%">
                        PT. Sino Indonikel Primaraya <br />
                        ATTN: <br />
                        JL. ......<br />
                        .......<br />
                        Phone (310)672-3080
                    </td>
                </tr>
            </tbody>
        </table>

        <hr style="visibility:hidden" />



        <table class="proposedWork" width="100%" style="margin-top:20px">
            <thead>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>KETERANGAN</th>
                <th>QTY</th>
                <th>HARGA</th>
                <th>TOTAL</th>
            </thead>
            <tbody>
                @foreach ($detail as $db)
                <tr>
                    <td class="qty">{{$loop->iteration}}</td>
                    <td class="description">{{$db->nm_barang}}</td>
                    <td class="description">{{$db->keterangan}}</td>
                    <td class="qty">{{$db->jumlah}}</td>
                    <td class="qty">{{$db->hrg_satuan}}</td>
                    <td class="qty">{{$db->hrg_satuan * $db->jumlah}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5">TOTAL</td>
                    <td>{{$total}}</td>
                </tr>
            </tbody>
        </table>



        <table width="100%">
            <tbody>
                <tr>
                    <td style="50%" style="vertical-align:top">
                        <table style="width:100%">
                            <tbody>
                                <tr>
                                    <td style="text-align:left">
                                        <p>1. Kirimkan dua salinan faktur Anda.</p>
                                        <p>2. Masukkan pesanan ini sesuai dengan harga, syarat, cara pengiriman, dan spesifikasi yang tertera di atas.</p>
                                        <p>3. Harap beri tahu kami segera jika Anda tidak dapat mengirim seperti yang ditentukan.</p>
                                        <p>4. Kirim semua korespondensi ke:</p>
                                        <p style="padding-left:20px"> PT. Sino Indonikel Primaraya
                                            <br />
                                            535 N. Eucalyptus Ave.
                                            <br />
                                            Inglewood, CA 90302
                                            <br />
                                            Phone (714)326-3025
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding-left:40px; width:50%; vertical-align:top">
                        <table style="width:100%">
                            <tbody>
                                <tr>
                                    <td style="text-align:left">
                                        <strong>COMMENTS:</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td contenteditable="true" style="text-align:left;border: 1px solid #000">Please ship all goods to our office using our UPS account #1234</td>
                                </tr>
                                <tr>
                                    <td style="padding-top:60px">
                                        Authorized by: _____________________________ Date: __________
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>



    </div>
</div>
<script type="text/javascript">
    window.print();
</script>