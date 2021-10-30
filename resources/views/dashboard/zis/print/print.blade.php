<style type="text/css">
    h1{
        font-family:sans-serif;
        color:#ff0000;
        font-size:30px;
    }
    .table-bg{
        background-image:url('{{ public_path('asset-masjid/logo.png')}}');
        background-repeat:no-repeat;
        background-position:center;
        background-size:300px;
        opacity: 0.1;
    }
    .table-header{
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
        font: 15px Arial, sans-serif;
        padding: 10px;
    }

</style>
<div class="table-bg">
    <img style="opacity: 9;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(route('adminPrintZakatJamaah', $zis->id), 'QRCODE')}}" alt="barcode" />
    <table class="table" width="100%">
        <tr>
            <td colspan="3">Atas Nama : {{$zis->atas_nama}}</td>
        </tr>
        <tr>
            <td colspan="3">Jenis Zakat : {{$zis->jenis_zakat->zis_type}}</td>
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
        <tr>
            <td colspan="3">
                Penerima : {{$zis->data_amil->name}}
            </td>
        </tr>
    </table>
</div>
