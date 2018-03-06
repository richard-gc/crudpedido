<?php 
session_start();
if( isset($_SESSION['dataUser'])){
     header("location:pedidointerno.php");
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
        <div class="container">
            <div class="col-sm-10" style="width: 600px; margin-left: 250px; margin-top: 50px;">
                <div class="jumbotron">
                    <div class="form-group">
                        <h1 class="text-center">Iniciar Sesión</h1>
                    </div>
                    <form action="" id="formlg" class= "form-horizontal" style="margin-left: 50px;">
                        <div class="form-group input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
                        </div>
                        <div class="form-group input-group">
                            <input type="password"  class="form-control" name="pass" id="pass" placeholder="Contraseña">
                        </div>
                        <div class="form-group text-center">
                            <input type="submit"  class="btn btn-success" name="sesion" value="Entrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="sesion/js.js"></script>
</body>
</html>