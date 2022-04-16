
<style type="text/css">
    .hidden-print{
        width:100%;
        padding:20px 0px;
        font-size:40px;
    }
    @media print {
    .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }
    h1{
        font-family:sans-serif;
        color:#ff0000;
        font-size:30px;
    }
    /*Paper Size*/
    .box{
        width:215px;
        border: solid 0.3px #000;
        font: 10px Arial, sans-serif;

    }
    .table-header{
        background-image:url('{{ public_path('asset-masjid/logo.png')}}');
        border-bottom:solid 1px #e3e6f0;
        padding: 5px 0px;
        font-family:sans-serif;
    }
    .table-header-data{
        background-color:#e3e6f0;
        font-family:sans-serif;
    }
    .table-body{
        border-bottom:solid 1px #e3e6f0;
        font-family:sans-serif;
    }
    .table td{
        border-bottom:solid 1px #ccc;
        font: 10px Arial, sans-serif;
    }
    @media print
    {
        * {-webkit-print-color-adjust:exact;}
    }

</style>
<div class="box">
    <table class="table" width="100%">
        <tr>
            <td colspan="2" style="height:60px;text-align:center;background:url({{asset('/img/logo.png')}});background-position:left;background-size:50px;background-repeat:no-repeat;">
                <b>Panitia ZIS Masjid <br/>{{$dataMasjid->nama_masjid}} <br/>Faktur ZIS {{date('Y', strtotime($zis->hijri))}}</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">Atas Nama : {{$zis->atas_nama}}</td>
        </tr>
        <tr>
            <td colspan="3">Jenis Zakat : {{$zis->jenis_zakat->zis_type}}</td>
        </tr>
        <tr>
            <td colspan="3">Jumlah Jiwa : {{$zis->jumlah_jiwa}}</td>
        </tr>
        <tr>
            <td><b>Uang</b></td>
            <td colspan="1"><b>Beras</b></td>
        </tr>
        <tr width="50%">
            <td>Zakat : {{number_format($zis->uang)}}</td>
            <td colspan="1">Zakat : {{$zis->beras}}</td>
        </tr>
        <tr width="50%">
            <td>Infaq : {{number_format($zis->uang_infaq)}}</td>
            <td colspan="1">Infaq : {{$zis->beras_infaq}}</td>
        </tr>
    </table>
    <center>
    <img width="90px" style="opacity: 9;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(route('adminPrintZakatJamaah', $zis->id), 'QRCODE')}}" alt="barcode" />

    </center>
    
    <hr>
    Penerima : {{$zis->data_amil->name}}<br/>
    Tanggal Input : {{date('d-m-Y', strtotime($zis->created_at))}}
</div>
<button id="btnPrint" class="hidden-print">Print</button>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>
