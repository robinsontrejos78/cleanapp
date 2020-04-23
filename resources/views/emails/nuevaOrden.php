<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="utf-8">
   	</head>
   	<body>
    	<h5><?php echo $fecha ?></h5>
      <h4><?php echo $detail ?></h4>
      <h5>Sr(a). <?php echo $name." ".$surname ?></h5>
    	<h5>Este mensaje es para informarle que se ha generado una nueva orden de servicio</h5>
      <h4>Preste atención a la siguiente información</h4>
      <h5>Nueva orden de <?php echo $tipo ?></h5>
      <h5>Inmueble ubicado en: <?php echo $direccion ?></h5>
      <h5>El(la) cliente es : <?php echo $cliente ?></h5>
      <h5>El Teléfono es : <?php echo $telcliente ?></h5>
      <h5>El Celular es : <?php echo $celcliente ?></h5>
    	<h4>La fecha de orden: <?php echo $fecha; ?></h4>
		  <h5>Cordial saludo</h5>
	  </body>
</html>