<?php
  //requerimos el archivo getData
  require('functions/getData.php');
  // Realizamos la consulta para buscar los pedidos.
  $squery = "SELECT  * FROM pedido";
  // Ejecutamos la función getData
  $datos=getData($squery);
  // Devuelve la información
  echo json_encode($datos);
  
?>