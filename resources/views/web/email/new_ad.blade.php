<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>Tu negocio en un click Mailers</title>
</head>

<body id="page-top" class="index">
<table border="0" cellspacing="0" cellpadding="0" style="width:100%;font-size:14px;font-family:Quicksand, Calibri, Arial, Verdana, sans-serif;background: #f5f6fa;color:#738196;line-height: 21px;padding: 30px;">
    <tbody>
    <tr>
        <td>
            <table style="background: #fff;width:500px;padding: 20px;margin: 0 auto;box-shadow: 0px 1px 10px 13px #2d313703;border-radius: 8px;font-weight: 500;">
                <tbody>
                <tr style="background: #fff;">
                    <td>
                        <img src="{{ Voyager::image('logo.jpg') }}" width="150" height="84" style="padding: 20px">
                    </td>
                </tr>
                <tr>
                    <td style="height: 5px;line-height: 2px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 18px;color:#000;font-weight: bold;line-height: 30px;">
                        <p>Vas a realizar una compra de anuncio en tu negocio en un click, aquí tiene un detalle de su compra</p>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td style="font-size: 18px;color:#000;font-weight: bold;line-height: 26px;">Información compra:</td>
                </tr>
                <tr>
                    <td>
                        <table style="background: #fff;width:500px;padding: 20px;margin: 0 auto;box-shadow: 0px 1px 10px 13px #2d313703;">
                            <tbody>
                            <tr>
                                <th align="center">Descripción</th>
                                <th align="center">Días</th>
                                <th align="center">Precio</th>
                                <th align="center">Valor</th>
                            </tr>
                            <tr>
                                <td align="center"><span contenteditable="false">{{ $invoiceLine->concept }}</span></td>
                                <td align="center"><span contenteditable="false">{{ $invoiceLine->num_element }}</span></td>
                                <td align="center"><span contenteditable="false">{{ $invoiceLine->price }}€</span></td>
                                <td align="center"><span contenteditable="false">{{ $invoice->total }}€</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td style="font-size: 18px;color:#000;font-weight: bold;line-height: 26px;">Datos para hacer transferencia</td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <p>
                            <strong>Concepto: </strong><span contenteditable="false">{{ $config['concept_cod'] }}</span><br>
                            <strong>Entidad: </strong><span contenteditable="false">{{ $config['admin_cod_entity_bank'] }}</span><br>
                            <strong>NºCuenta: </strong><span contenteditable="false">{{  $config['admin_cod_num_bank'] }}</span><br>
                            <strong>IBAN: </strong><span contenteditable="false">{{  $config['admin_cod_iban'] }}</span><br>
                            <strong>Código BIC/SWIFT: </strong><span contenteditable="false">{{  $config['admin_cod_bic_swift'] }}</span><br>
                            <strong>Beneficiario: </strong><span contenteditable="false">{{  $config['admin_cod_benify'] }}</span><br>
                            <strong>Importe: </strong><span contenteditable="false">{{ $invoice->total }}</span>
                        </p>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td style="font-size: 18px;color:#000;font-weight: bold;line-height: 26px;">Estaremos pendientes de tu pago por transferencia, pero si pasados dos días hábiles desde que la hiciste y no tienes reflejados esos créditos en tu panel, por favor, apórtanos el justificante de la operación
                        al correo <a href="mailto:conta@oficinadeprofesionales.com">conta@oficinadeprofesionales.com</a> Muchas gracias.</td>
                </tr>
                <tr>
                    <td>
                        <hr/>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 9px; color:#000;">
                        <p>oficinadeprofesionales.com</p>
                        <p>Responsable de Tratamiento: Gesfotiplay, S.L.<br/>
                        <p>Apartado de correos 2097<br/>
                            23080. Jaén. España.</p>
                        <p>Gesfotiplay, S.L., le informa que los datos de contacto recogidos en esta comunicación, han sido recabados de nuestro Registro de Actividades, en concreto del Tratamiento, Comunicaciones o facilitados voluntariamente por usted con la finalidad de poder llevar a cabo las comunicaciones de índole comercial y/o informativas que puedan ser de su interés, quedando por tanto, informado de la posibilidad de usar sus datos con fines comerciales. Igualmente le informamos a los afectados que podrán ejercitar ante el Responsable del Tratamiento o ante su Delegado de Protección de Datos, los derechos de acceso, rectificación, cancelación y portabilidad de sus datos, y la limitación u oposición a su tratamiento, retirar el consentimiento en este documento aceptado e incluso interponer reclamación ante la Agencia Española de Protección de Datos.</p>
                        <p>Este mensaje contiene información confidencial destinada para ser leída exclusivamente por el destinatario. Queda prohibida la reproducción, publicación, divulgación, total o parcial del mensaje así como el uso no autorizados por el emisor.</p>
                        <p>En caso de recibir el mensaje por error, se ruega su comunicación al remitente lo antes posible. Por favor, indique inmediatamente si usted o su empresa no aceptan comunicaciones de este tipo por Internet.</p>
                        <p>Las opiniones, conclusiones y demás información incluida en este mensaje que no esté relacionada con asuntos profesionales de Gesfotiplay, S.L., se entenderá que nunca se ha dado, ni está respaldado por el mismo.</p>
                        <p>Delegado de Protección de Datos: Datasur Protección de Datos, S.L.<br/>
                            Telf.: 958 958230. E-mail: dpd@data-sur.com</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
