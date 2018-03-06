<?php
    session_start();
    if( isset($_SESSION['dataUser'])){
        
    }else{
        header("location:index.php");
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
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
    <div class="py-3 container">
        <h1 class="text-center">Pedidos internos</h1> 
        <ul class="nav nav-pills nav-fill">
            <div class="col-md-4">
                <li class="nav-item">
                <a class="nav-link  btn btn-secondary" href="area.php">Departamentos</a>
                </li>
            </div>
            <div class="col-md-4">
                <li class="nav-item">
                <a class="nav-link  btn btn-primary" href="pedido.php">Pedidos internos</a>
                </li>
            </div>
            <div class="col-md-4">
                <li class="nav-item">
                <a class="nav-link  btn btn-danger" href="sesion/logout.php">Cerrar sesión</a>
                </li>
            </div>
        </ul>
    </div>
    
 <div id="carousell" class="carousel slide" data-ride="carousel"
 style="width: 800px; margin-left: 250px; margin-top: 10px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/peot.jpg" alt="First slide">
    </div>
  </div>
</div>
</body>
</html>