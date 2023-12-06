<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tu negocio en un click Mailing</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700italic,700,600,400italic,300italic,300,600italic,800italic,800' rel='stylesheet' type='text/css'>
</head>
<body style="font-family: 'Open Sans', sans-serif; font-size: 12px; background-color: #eaeaea; color: #363636; margin-top: 50px;">
<div style="background-color:#fff; border: solid 1px #dedede; border-radius: 5px; max-width: 625px; width: auto; margin: auto;">
    <div style="padding: 25px 25px 5px; text-align: center">
        <a href="{{ url('/') }}"><img src="{{ Voyager::image('logo.jpg') }}" width="150" height="100"></a>
    </div>

    <div style="padding: 15px 25px 0; text-align: justify;">
        <p>Ha recibido un mensaje a través del formulario de contacto de tu negocio en un click con la siguiente información: </p>
        <ul>
            <li><b>Nombre: </b>{{$name}}</li>
            <li><b>Email: </b>{{$email}}</li>
            <li><b>Mensaje: </b>{{ $messageC }}</li>
        </ul>
    </div>
</div>
</body>
</html>
