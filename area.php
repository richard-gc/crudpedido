<?php
    require ('conexion.class.php');
    session_start();
    if( isset($_SESSION['dataUser'])){
        
    }else{
        header("location:index.php");
    }

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        !is_numeric($id)? die ('error al eliminar') : '';
        $query="DELETE FROM `area` WHERE area_id= $id ";
        $bd = new Conexion();
        $bd->query($query);
        if($bd->affected_rows>0){
            header("location: area.php");
        }else{
            header("location: area.php?error=hubo un problema");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <title>Area</title>
</head>
<body>

    <div class="form-grup  text-center">
    <div class="container">
            <h3 class="panel-title py-4">Area</h3>
        <div class="panel-body">
            <form action="crudarea.php" method="post">
                <p>Código: <input type="texto"  name="area_id"></p>
                <p>Nombre: <input type="texto" name="nombre"></p>
                <div class="py-3">
                <input type="submit" name="registrar"  class="btn btn-primary" value="registrar">
                </div>
                </form>
    <?php
    if(isset($_GET['error'])){
        $mensaje=$_GET['error'];
        echo htmlentities($mensaje);
    }
    ?>
    <table class="table table-hover">
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Editar</th>
        <th>Eliminar</th>
        <?php
        $bd= new Conexion();
        $query= "SELECT DISTINCT * FROM area";
        $res= $bd-> query($query);
        $table='';
        while($row= mysqli_fetch_array($res)){
            $table.="<tr>";
            $table.="<td>$row[area_id]</td>";
            $table.="<td>$row[nombre]</td>";
            $table.="<td><a href=\"editarea.php?id=$row[area_id]\">editar</a></td>";
            $table.="<td><a href=\"area.php?id=$row[area_id]\">eliminar</a></td>";
            $table.="</tr>";
        }
        echo $table;
    ?>
    </table>
    </div>
    </div>
    </div>
</body>
</html>
