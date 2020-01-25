<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="utf-8">
   	</head>
   	<body>
      <h4><?php echo $detail ?></h4>
      <h5>Sr(a). <?php echo $name." ".$surname ?></h5>
    	<h5>Este mensaje es para confirmarle que se le ha asignado una nueva orden de servicio de <?php echo $tipo ?> para el Inmueble Hubicado en: <?php echo $direccion ?>.</h5>
      <h5>Por este servicio usted recibira la suma de $ <?php echo $costo ?></h5>
    	<h4>La fecha en la que debe de ser atendida la orden es: <span class="badge bg-aqua"><?php echo $fecha ?></span></h4>
		  <h5>Muchas gracias y esperamos sea puntual</h5>
		  <h5>Cordial saludo</h5>
	  </body>
</html>





 