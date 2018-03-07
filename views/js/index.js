/*
Al tener tantos archivos js como vistas, colocamos el nombre de la vista para guardar una relacion
Ejemplo index.html -> index.js
        admin.html -> admin.js
*/ 

//Documentación de VueJS  -> https://vuejs.org/v2/guide/

//creamos la instancia vue
/*
 primero definimos el elemento (el) para relacionarlo, en nuestro caso el selector es un id app 
 en la data colocamos las variables que usaremos
 creamos los métodos en nuestro caso goLogin para realizar el login correspondiente
*/
new Vue({
  el:'#app',
  data:{
    username:'',
    password:'',
  },
  methods:{
    //metodo goLogin desencadenado por el fomulario con el evento submit
    goLogin(){
      //verificamos que los datos no estén vacíos.
      if(this.username && this.password){
        // creamos la cadena para enviar los datos 
        form = 'user='+this.username+'&pass='+this.password;
        //creamos una conexion asyncrona (AJAX)
        connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        connect.onreadystatechange = function(){
            console.log(connect.responseText)
            // la respuesta tipo 1 (usuario encontrado y sesión realizada)
            if(connect.responseText == 1){
              // recarga la página con la sesión ya creada
              location.reload();
              // la respuesta tipo -1 (no se encontro el usuario), nos muestra una alerta
            }else if(connect.responseText == 2){
              swal(
                'Error',                              //titulo de la alerta
                'Usuario o contraseña incorrecta!',   //contenido de la alerta
                'error'                               //tipo de alerta (error)
              )
            }else{
              // El último valor posible es 0, que algún campo falta
              // Esto puede ser posible si es que se llega a manipular el JS y burlar la comprobación para no enviar datos vacíos
              // Pero el servidor detecta que se envío algún dato vacío.
              swal(
                'Error',                              //titulo de la alerta
                'Los datos deben estar completos!',   //contenido de la alerta
                'error'                               //tipo de alerta (error)
              )
            }				
        }
        // definimos el método y la ruta 
        // la ruta es ajax y recibe el parametro mode que define cuál es la función que realizará 
        connect.open('POST','ajax.php?mode=login',true);
        //Definimos las cabeceras, el typo de contenido
        connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        //enviamos los datos
        connect.send(form);
      }else{
        // si los datos se encuentran vacíos mandamos una alerta con  sweetalert2
        swal(
          'Error',                              //titulo de la alerta
          'Los datos deben estar completos!',   //contenido de la alerta
          'error'                               //tipo de alerta (error)
        )
      }
    }
  }
})