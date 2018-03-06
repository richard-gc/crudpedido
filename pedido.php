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
    <form action="pedidointerno.php" class="form-grup py-2">
    <input type="submit" name="inicio" class="btn btn-link" value="Inicio ">
    <h2 class="text-center">Registrar Pedido</h2>
    </form>
    
    <?php
        require 'conexion.class.php';
        $bd=new Conexion();
        $query="SELECT DISTINCT area_id, nombre FROM area";
        $res= $bd-> query($query);
        $option='';
            while($row= mysqli_fetch_array($res)){
                $option .= "<option value=\"$row[area_id]\">$row[area_id] </option>";

            }  
    ?>
    <div class="container">
    <form action="" method="post" id="form_pedido" class="row justify-content-center">
        <div class="form-grup col-md-2">
            <p> N° pedido <input type="text" name="npedido"></p>
        </div>
        <div class="form-grup col-md-2">
            <p>Seleccionar area <select name="area_id">
            <option value="-"></option>
            <?php echo $option?>
             </select></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Descripcion <input type="text" name="descripcion"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Cantidad <input type="text" name="cantidad"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Unidad <input type="text" name="unidad"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Tipo <input type="text" name="tipo"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Cod. ppto <input type="text" name="cod_ppto"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Cod. POMDIHMA <input type="text" name="cod_pomdihma"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Fecha<input type="date" name="fecha"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Fecha atendido<input type="date" name="fecha_atendido"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Fecha compra/servicio<input type="date" name="fecha_pc"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Seguimiento<input type="text" name="seguimiento"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Costo estimado <input type="text" name="costo_estimado"></p>
        </div>
        <div  class="form-grup col-md-2">
            <p> Costo real <input type="text" name="costo_real"></p>
        </div>
        <div  class="form-grup col-md-2 py-3">
            <input type="submit" name="registrar" id="btn_registrar"  class="btn btn-primary" value="registrar" >
        </div>
        <div  class="form-grup col-md-2 py-3">
            <input type="submit" name="buscar"  id="btn_buscar" class="btn btn-info" value="buscar ">
        </div>
        <div id="result"></div>
        
    </form>
    </div>
    <?php
    if(isset($_GET['error'])){
        $mensaje=$_GET['error'];
        echo htmlentities($mensaje);
    }
    ?>
   <script>
        // xhr me permite realizar peticiones ajax
        let xhr = new XMLHttpRequest();
        let form = new FormData();  // puedo obtener los datos del formulario
        let data = document.getElementById('form_pedido'); // obtiene el formularios (con etiquetas)
        // selecciono el boton buscar por su id y escucho el evento click
        document.getElementById('btn_buscar').addEventListener('click',(e)=>{
            //del formulario obtengo los datos
            let form = new FormData(data);
            form.append('buscar',true);
            // abro una petición de metodo POST y le paso la ruta crudpedido.php
            xhr.open('POST','crudpedido.php');
            // esta es la petición AJAX y ejecuta una función
            xhr.onload = ()=>{
                // si la petición es correcta el status es 200
                if(xhr.status===200){
                    // alert('Hola mundo');
                    // muestro la información en una alerta
                    // alert(xhr.responseText);
                    const result = JSON.parse(xhr.responseText);
                    
                    let data = ``;
                    for (let i in result){
                        data+=`
                        <tr>
                            <td>${result[i].npedido}</td>
                            <td>${result[i].area_id}</td>
                            <td>${result[i].descripcion}</td>
                            <td>${result[i].cantidad}</td>
                            <td>${result[i].unidad}</td>
                            <td>${result[i].tipo}</td>
                            <td>${result[i].cod_ppto}</td>
                            <td>${result[i].cod_pomdihma}</td>
                            <td>${result[i].fecha}</td>
                            <td>${result[i].fecha_atendido}</td>
                            <td>${result[i].fecha_pc}</td>
                            <td>${result[i].seguimiento}</td>
                            <td>${result[i].costo_estimado}</td>
                            <td>${result[i].costo_real}</td>
                         <td> <a href='editpedido.php?id=${result[i].npedido}'>editar</a></td>
                        </tr>
                        `
                    }
                    let urlData = JSON.stringify(result);
                    let table = `
                    <div style="height: 400px; width: 1200px; margin-left: 50px; margin-top: 30px; overflow: scroll;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">N° pedido</th>
                            <th scope="col">Area Id</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Cod. ppto</th>
                            <th scope="col">Cod. POMDIHMA</th>
                            <th scope="col">Fecha de pedido</th>
                            <th scope="col">Fecha atendido</th>
                            <th scope="col">Fecha compra/servicio</th>
                            <th scope="col">Seguimiento</th>
                            <th scope="col">Costo estimado</th>
                            <th scope="col">Costo Real</th>
                            </tr>
                        </thead>
                        <tbody>                            
                             ${data}                          
                        </tbody>
                        </table>
                        </div>
                        <a href="exportar.php" class="btn btn-success" target="_blank"> exportar </a>
                        
                        
                    `
                    document.getElementById('result').innerHTML = table;
                }else{

                }
            }
            // le envio la los datos del formulario
            xhr.send(form);
            //previene el evento submit que me recarga la página 
            e.preventDefault();
        })
        document.getElementById('btn_registrar').addEventListener('click',(e)=>{
            let form = new FormData(data);
            form.append('registrar',true);
            // abro una petición de metodo POST y le paso la ruta crudpedido.php
            xhr.open('POST','crudpedido.php');
            // esta es la petición AJAX y ejecuta una función
            xhr.onload = ()=>{
                // si la petición es correcta el status es 200
                if(xhr.status===200){
                    console.log('Registrado!')
                }else{

                }
            }
            // le envio la los datos del formulario
            xhr.send(form);
            //previene el evento submit que me recarga la página 
            e.preventDefault();
        })

       
   </script>

</body>
</html>