<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Invitación a colaborar</title>
</head>
<body bgcolor="#fafafa" marginheight="0" marginwidth="0">

<p>Estimado {{ $invitacion->destinatario  }}: </p>
<p>{{ $invitacion->remitente->name }} le esta invitando a colaborar como {{ $invitacion->role  }}, en la administración del condominio {{ $invitacion->condominio->nombre }}.</p>
<hr>
<p>Usted puede <a href="{{ route('aceptar-invitacion', ['id' => $invitacion->id, 'condominio_id' => $invitacion->condominio_id ]) }}">Aceptar</a> o <a href="{{ route('declinar-invitacion', ['id' => $invitacion->id, 'condominio_id' => $invitacion->condominio_id]) }}">Declinar</a> esta invitación invitación. Usted tambien puede revisar las responsabilidades que tendra en este sitio, o puede consultar mas sobre el condominio en {{ route('faqs', ['responsabilidades' => $invitacion->role ]) }}.</p>
<p>Esta invitación expirará el {{ $invitacion->fecha_expiracion }}</p>

<p>
    <strong>Nota:</strong> esta invitación estaba destinada a {{ $invitacion->destinatario }}. Si no esperaba esta invitación, puede ignorar este correo electrónico. Si
    {{ $invitacion->remitente->nombre }} te envía demasiados correos electrónicos, puedes bloquearlos o denunciar un abuso.
</p>
</body>
</html>
