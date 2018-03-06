<?php
require 'conexion.class.php';
session_start();
if( isset($_SESSION['dataUser'])){
    
}else{
    header("location:index.php");
}
if(isset($_GET['id'])){
    $bd= new Conexion();
    $id=$_GET['id'];
    $squery="SELECT * FROM pedido WHERE npedido=$id";
    $res=$bd->query($squery);
    $datos=mysqli_fetch_array($res);
}else{
  header("location: pedido.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="mainjs/bootstrap.min.js"></script>
</head>
<body>
<h2 class="text-center py-4" > Editar Pedido </h2>
<div class="container">
    <form action='crudpedido.php' method= 'post' class="row justify-content-center">
    <div class="form-grup col-md-2">
        <p>N° pedido <input type="text" name="npedido" value="<?php echo $datos['npedido']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Area_Id <input type="text" name="area_id" value="<?php echo $datos['area_id']?>" > </p>
    </div>
    <div class="form-grup col-md-2">
        <p>Descripcion <input type="text" name="descripcion" value="<?php echo $datos['descripcion']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Cantidad <input type="text" name="cantidad" value="<?php echo $datos['cantidad']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Unidad <input type="text" name="unidad" value="<?php echo $datos['unidad']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Tipo <input type="text" name="tipo" value="<?php echo $datos['tipo']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Cod. PPTO <input type="text" name="cod_ppto" value="<?php echo $datos['cod_ppto']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Cod. POMDIHMA <input type="text" name="cod_pomdihma" value="<?php echo $datos['cod_pomdihma']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Fecha_pedido <input type="date" name="fecha" value="<?php echo $datos['fecha']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Fecha atendido<input type="date" name="fecha_atendido" value="<?php echo $datos['fecha_atendido']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Fecha compra/servicio<input type="date" name="fecha_pc" value="<?php echo $datos['fecha_pc']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Seguimiento<input type="text" name="seguimiento" value="<?php echo $datos['seguimiento']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Costo estimado <input type="text" name="costo_estimado" value="<?php echo $datos['costo_estimado']?>"></p>
    </div>
    <div class="form-grup col-md-2">
        <p>Costo real<input type="text" name="costo_real" value="<?php echo $datos['costo_real']?>"></p>
    </div>
    <div class="form-grup col-md-2">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    </div>
    <div class="col-md-12">
        <div class="text-center">
        <input type="submit" name="editar" class="btn btn-primary" value="guardar">
        </div>
    </div>
    </from>
</div>
</body>
</html>