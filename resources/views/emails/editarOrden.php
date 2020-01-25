<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="utf-8">
   	</head>
   	<body>
    	<h5><?php echo $fecha ?></h5>
      <h4><?php echo $detail ?></h4>
      <h5>Sr(a). <?php echo $name." ".$surname ?></h5>
    	<h5>Este mensaje es para informarle que se ha modificado una orden de servicio</h5>
      <h4>Ponga atención a la siguiente información</h4>
      <h5>Nueva orde de <?php echo $tipo ?></h5>
      <h5>Inmueble Hubicado en: <?php echo $direccion ?></h5>
      <h5>Por este servicio usted recibira la suma de $ <?php echo $costo ?></h5>
    	<h4>La fecha de orden: <?php echo $fecha; ?></h4>
		  <h5>Cordial saludo</h5>
	  </body>
</html>