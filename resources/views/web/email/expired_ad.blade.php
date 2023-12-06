<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>Tu negocio en un click Mailers</title>
</head>
<body id="page-top" class="index">

<table style="width:100%;font-size:14px;font-family:Quicksand, Calibri, Arial, Verdana, sans-serif;background: #f5f6fa;color:#738196;line-height: 21px;padding: 30px;" cellspacing="0" cellpadding="0" border="0">
    <tbody>
    <tr>
        <td>
            <table style="background: #ffffff;width:500px;padding: 20px;margin: 0 auto;box-shadow: 0px 1px 10px 13px #2d313703;border-radius: 8px;font-weight: 500;">
                <tbody>
                <tr style="background: #ffffff;">
                    <td>
                        <img src="{{ Voyager::image('logo.jpg') }}" width="150" height="84">
                    </td>
                </tr>
                <tr>
                    <td style="height: 5px;line-height: 2px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 24px;color:#000;font-weight: bold;line-height: 30px;">El siguiente anuncio va a caducar en {{ $days }} días. Si está interesado en seguir mostrando tu anuncio en la web, por favor, contacte con la empresa en destaca@oficinadeprofesionales.com<br>Gracias por su confianza.</td>
                </tr>
                <tr>
                    <td style="height: 5px;line-height: 2px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size: 18px;color:#000;font-weight: bold;line-height: 26px;">Información detallada del anuncio:</td>
                </tr>
                <tr>
                    <td><strong>Posición:</strong> <span contenteditable="false">{{ $data->name }}</span></td>
                </tr>
                <tr>
                    <td><strong>Fecha inicio:</strong> <span contenteditable="false">{{ $data->date_start }}</span></td>
                </tr>
                <tr>
                    <td><strong>Fecha fin:</strong> <span contenteditable="false">{{ $data->date_end }}</span></td>
                </tr>
                <tr>
                    <td><strong>Número de días:</strong> <span contenteditable="false">{{ $data->invoice->invoiceLines->first()->num_element }}</span></td>
                </tr>
                <tr>
                    <td><strong>Coste por día:</strong> <span contenteditable="false">{{ $data->invoice->invoiceLines->first()->price }}€</span></td>
                </tr>
                <tr>
                    <td><strong>Coste total:</strong> <span contenteditable="false">{{ $data->invoice->total }}€</span></td>
                </tr>
                <tr>
                    <td><strong>Imagen anuncio:</strong> <br/><img src="{{ Voyager::image($data->image) }}" style="max-width: 200px; padding: 20px"></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 9px; color:#000;">
                        <p>oficinadeprofesionales.com</p>
                        <p>Responsable de Tratamiento: Gesfotiplay, S.L.<br>
                        </p><p>Apartado de correos 2097<br>
                            23080. Jaén. España.</p>
                        <p>Gesfotiplay, S.L., le informa que los datos de contacto recogidos en esta comunicación, han sido recabados de nuestro Registro de Actividades, en concreto del Tratamiento, Comunicaciones o facilitados voluntariamente por usted con la finalidad de poder llevar a cabo las comunicaciones de índole comercial y/o informativas que puedan ser de su interés, quedando por tanto, informado de la posibilidad de usar sus datos con fines comerciales. Igualmente le informamos a los afectados que podrán ejercitar ante el Responsable del Tratamiento o ante su Delegado de Protección de Datos, los derechos de acceso, rectificación, cancelación y portabilidad de sus datos, y la limitación u oposición a su tratamiento, retirar el consentimiento en este documento aceptado e incluso interponer reclamación ante la Agencia Española de Protección de Datos.</p>
                        <p>Este mensaje contiene información confidencial destinada para ser leída exclusivamente por el destinatario. Queda prohibida la reproducción, publicación, divulgación, total o parcial del mensaje así como el uso no autorizados por el emisor.</p>
                        <p>En caso de recibir el mensaje por error, se ruega su comunicación al remitente lo antes posible. Por favor, indique inmediatamente si usted o su empresa no aceptan comunicaciones de este tipo por Internet.</p>
                        <p>Las opiniones, conclusiones y demás información incluida en este mensaje que no esté relacionada con asuntos profesionales de Gesfotiplay, S.L., se entenderá que nunca se ha dado, ni está respaldado por el mismo.</p>
                        <p>Delegado de Protección de Datos: Datasur Protección de Datos, S.L.<br>
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
