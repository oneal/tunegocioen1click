<?php
    $path = '../storage/app/public/logo.png';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>
<table class="table">
    <tbody>
    <tr style="width: 700px;">
        <td style=" background: #ffffff; width: 350px"><img src="<?php echo $base64;?>'" style="max-width: 200px; padding-left: 20px"></td>
        <td style="width: 350px; text-align: right;">
            <h2 style="font-size:1em"> N&deg; Factura: {{ $invoice['num_invoice'] }}</h2>
            <p style="font-size:1em"><strong>Fecha factura:</strong> {{ $invoice['created_at'] }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 20px; width:50%">
            <h2 style="font-size:1.2em;color:#333;">Tu negocio en un click</h2>
            <p>
                Apartado de correos 2097<br/>
                Jaén<br/>
                23080 - Jaén <br/>
                CIF/NIF - B-23449309
            </p>
        </td>
        <td style="width:50%;">
            <h2 style="font-size:1.2em;color:#333;">{{ $invoiceClient['name'] }}</h2>
            <p>
                {{ $invoiceClient['address'] }}<br/>@if(isset($province)){{ $province->name}}@endif<br/>@if(isset($invoiceClient['phone'])){{ $invoiceClient['phone'] }}<br/>@endif @if(isset($invoiceClient['email'])){{ $invoiceClient['email'] }}<br/>@endif
            </p>
        </td>
    </tr>
    </tbody>
</table>
<table align="center" border="0" cellpadding="8" cellspacing="0" width="100%">
    <tr>
        <td>
            <table border="0" cellpadding="5" cellspacing="0" width="100%">
                <tr align="center">
                    <th>Descripción</th>
                    <th>Días</th>
                    <th>Precio</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td colspan="7"><hr></td>
                </tr>
                <tr align="center">
                    @foreach($invoiceLines as $invoiceLine)
                        <td>{{ $invoiceLine->concept }}</td>
                        <td>{{ $invoiceLine->num_element }}</td>
                        <td>{{ $invoiceLine->price }}€</td>
                        <td>{{ (int)$invoiceLine->price * (int)$invoiceLine->num_element }}€</td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="7"><hr></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="7">&nbsp;</td>
                </tr>
                <?php
                    $invoicePrice = (float)$invoice['total'];
                    $invoicePriceIva = $invoicePrice*21/100;
                    $invoicePriceBase = $invoicePrice - $invoicePriceIva;
                ?>
                <tr>
                    <td colspan="3" style="text-align: right;">BASE</td>
                    <td style="text-align: center;"><?php echo number_format($invoicePriceBase, 2, ',', '.')."€"; ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">IVA 21%</td>
                    <td style="text-align: center;"><?php echo number_format($invoicePriceIva, 2, ',', '.')."€";?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">TOTAL</td>
                    <td style="text-align: center;"><?php echo $invoice['total'];?> </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
