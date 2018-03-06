<?php
   session_start();
   if( isset($_SESSION['dataUser'])){
       
   }else{
       header("location:index.php");
   }
require 'conexion.class.php';
if(isset($_GET['id'])){
    $bd= new Conexion();
    $id=$_GET['id'];
    $query="SELECT * FROM area WHERE area_id=$id";
    $res=$bd->query($query);
    $datos=mysqli_fetch_array($res);
}else{
  header("location: area.php");
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

</head>
<body>
<center>
    <h2> Editar area </h2>
    <form action='crudarea.php' method= 'post'>
    <div class="col-md-2">
    <p>Código <input type="text" name="area_id" value="<?php echo $datos['area_id']?>"></p>
    <p>Nombre <input type="text" name="nombre" value="<?php echo $datos['nombre']?>"></p>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="editar" class="btn btn-primary" value="guardar">
    </div>
    </from>
</center>
</body>
</html>