new Vue({
  el:'#app',
  data:{
    areas:[],  
    orders:[],
    newOrder:{},
    valor:'',
    filterMode:'all',
    mode: 0, // modo 0: añadir , 1 :actualizar
    showModal: false //mostrar modal para actualizar o añadir pedido
  },
  mounted(){
    this.getAreas();
    this.getOrders();
  },
  computed:{
    filterOrders(){
      switch(this.filterMode){
        case 'all'         : return this.orders;break;
        case 'area'        : return this.orders.filter(order=>order.area_id==this.valor); break;
        case 'tipo'        : return this.orders.filter(order=>order.tipo==this.valor);break;
        case 'seguimiento' : return this.orders.filter(order=>order.seguimiento==this.valor);break;
        default            : return this.orders; 
      }
    }
  },
  methods:{
    // la función get Areas realiza una petición get para obtener las áreas.
    getAreas(){
      // enviamos la petición por la URL con fetch
      fetch('ajax.php?mode=getAreas')
      // las respuesta que obtenemos la pasamos a un json
      .then(res=>res.json())
      // asignamos el valor obtenido a nuestro arreglo areas
      .then(res=>this.areas=res)
    },
    // la función/método getOrders realiza una petición get para obtener los pedidos
    getOrders(){
      // enviamos la petición por la url con fetch
      fetch('ajax.php?mode=getOrders')
      // la respuesta obtenida la pasamos a json
      .then(res=>res.json())
      // asignamos el valor obtenido a nuestro arrego orders
      .then(res=>this.orders=res)
    },
    addOrder(){
      if(
        this.newOrder.area_id &&
        this.newOrder.cantidad &&
        this.newOrder.cod_pomdihma &&
        this.newOrder.cod_ppto &&
        this.newOrder.costo_estimado &&
        this.newOrder.costo_real &&
        this.newOrder.descripcion &&
        this.newOrder.fecha &&
        this.newOrder.npedido &&
        this.newOrder.seguimiento &&
        this.newOrder.tipo &&
        this.newOrder.unidad
      ){
        // creamos la cadena con las variables para enviar por petición post
        form =  'area_id=' + this.newOrder.area_id +
                '&cantidad=' + this.newOrder.cantidad +
                '&cod_pomdihma=' + this.newOrder.cod_pomdihma +
                '&cod_ppto=' + this.newOrder.cod_ppto +
                '&costo_estimado=' + this.newOrder.costo_estimado +
                '&costo_real=' + this.newOrder.costo_real +
                '&descripcion=' + this.newOrder.descripcion +
                '&fecha=' + this.newOrder.fecha +
                '&fecha_atendido=' + this.newOrder.fecha_atendido +
                '&fecha_pc=' + this.newOrder.fecha_pc +
                '&npedido=' + this.newOrder.npedido +
                '&seguimiento=' + this.newOrder.seguimiento +
                '&tipo=' + this.newOrder.tipo +
                '&unidad=' + this.newOrder.unidad;
        // con el api fetch enviamos a la url, luego colamos un objeto
        fetch('ajax.php?mode=addOrder',{
          // define el método que usamos
          method:'post',
          // define la cabecera, como enviamos la información
          headers:{
            'Content-Type':'application/x-www-form-urlencoded'
          },
          // la información viaja en el cuerpo (body)
          body:form
        })
        .then(res=>res.json())
        .then(res=>{
          if(res==0){
            swal(
              'Error',                              //Título de la alerta
              'Los datos deben estar completos!',   //Texto de la alerta
              'error'                               //tipo de alerta (error)
            )
          }else if(res==1){
            swal(
              'Error',                              //Título de la alerta
              'Algunos datos deben ser númericos!', //Texto de la alerta
              'error'                               //tipo de alerta (error)
            )
          }else if(res==2){
            swal(
              'Error',                                    //Título de la alerta
              'Datos incorrectos, por favor verifica!',   //Texto de la alerta
              'error'                                     //tipo de alerta (error)
            )
          }else if(res==3){
            swal(
              'Error',                                //Título de la alerta
              'Ocurrió un error al agregar pedido!',  //Texto de la alerta
              'error'                                 //tipo de alerta (error)
            )
          }else{
            swal(
              'Bien',                               //Título de la alerta
              'Se ha agregado un nuevo pedido',     //Texto de la alerta
              'success'                             //Tipo de alerta (success)
            )
            this.newOrder={}
            this.showModal=false
            this.getOrders()
          }
        })
      }else{
        swal(
          'Error',                              //Título de la alerta
          'Los datos deben estar completos!',   //Texto de la alerta
          'error'                               //tipo de alerta (error)
        )
      }
    },
    //la función/método showUpdateOrder muestra el modal y asigna la order que es pasada como parametro para que sea actualizada
    //setea el modo a 1, para actualizar el area asignada y muestra el modal
    showUpdateOrder(order){
      this.mode = 1;
      this.newOrder = order;
      this.showModal = true;
    },
    updateOrder(){
      if(
        this.newOrder.area_id &&
        this.newOrder.cantidad &&
        this.newOrder.cod_pomdihma &&
        this.newOrder.cod_ppto &&
        this.newOrder.costo_estimado &&
        this.newOrder.costo_real &&
        this.newOrder.descripcion &&
        this.newOrder.fecha &&
        this.newOrder.fecha_atendido &&
        this.newOrder.fecha_pc &&
        this.newOrder.npedido &&
        this.newOrder.seguimiento &&
        this.newOrder.tipo &&
        this.newOrder.unidad
      ){
        // creamos la cadena con las variables para enviar por petición post
        form =  'area_id=' + this.newOrder.area_id +
                '&cantidad=' + this.newOrder.cantidad +
                '&cod_pomdihma=' + this.newOrder.cod_pomdihma +
                '&cod_ppto=' + this.newOrder.cod_ppto +
                '&costo_estimado=' + this.newOrder.costo_estimado +
                '&costo_real=' + this.newOrder.costo_real +
                '&descripcion=' + this.newOrder.descripcion +
                '&fecha=' + this.newOrder.fecha +
                '&fecha_atendido=' + this.newOrder.fecha_atendido +
                '&fecha_pc=' + this.newOrder.fecha_pc +
                '&npedido=' + this.newOrder.npedido +
                '&seguimiento=' + this.newOrder.seguimiento +
                '&tipo=' + this.newOrder.tipo +
                '&unidad=' + this.newOrder.unidad;
        // con el api fetch enviamos a la url, luego colamos un objeto
        fetch('ajax.php?mode=updateOrder',{
          // define el método que usamos
          method:'post',
          // define la cabecera, como enviamos la información
          headers:{
            'Content-Type':'application/x-www-form-urlencoded'
          },
          // la información viaja en el cuerpo (body)
          body:form
        })
        .then(res=>res.json())
        .then(res=>{
          if(res==0){
            swal(
              'Error',                              //Título de la alerta
              'Los datos deben estar completos!',   //Texto de la alerta
              'error'                               //tipo de alerta (error)
            )
          }else if(res==1){
            swal(
              'Error',                              //Título de la alerta
              'Algunos datos deben ser númericos!', //Texto de la alerta
              'error'                               //tipo de alerta (error)
            )
          }else if(res==2){
            swal(
              'Error',                                    //Título de la alerta
              'Datos incorrectos, por favor verifica!',   //Texto de la alerta
              'error'                                     //tipo de alerta (error)
            )
          }else if(res==3){
            swal(
              'Error',                                //Título de la alerta
              'Ocurrió un error al actualizar el pedido!',  //Texto de la alerta
              'error'                                 //tipo de alerta (error)
            )
          }else{
            swal(
              'Bien',                               //Título de la alerta
              'Se ha actualizado el pedido',     //Texto de la alerta
              'success'                             //Tipo de alerta (success)
            )
            this.newOrder={}
            this.showModal=false
            this.getOrders()
          }
        })
      }else{
        swal(
          'Error',                              //Título de la alerta
          'Los datos deben estar completos!',   //Texto de la alerta
          'error'                               //tipo de alerta (error)
        )
      }
    },
    //la función/método execSubmit ejecuta el submit del formulario,
    /*
    a partir del formulario se pueden ejecutar don funciones (actualizar y registrar), según el modo que se encuentre
    */
    execSubmit(){
      if(this.mode==0){this.addOrder()}
      else{this.updateOrder()}
    },
    convertToCSV(objArray){
      let array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
      let str = '';
      for(let i=0; i<array.length; i++){
        let line = '';
        for(let index in array[i]){
          if(line!='') line +=','
          line += array[i][index];
        }
        str += line + '\r\n';
      }
      return str;
    },
    exportCSVFile(headers,items,fileTitle){
      if(headers){
        items.unshift(headers);
      }
      //Convertir Object a JSON
      let jsonObject = JSON.stringify(items);
      let csv = this.convertToCSV(jsonObject);
      let exportedFilename = fileTitle+'.csv' || 'export.csv';
      let blob = new Blob([csv],{type:'text/csv;charset=utf-8;'});
      if(navigator.msSaveBlob){
        navigator.msSaveBlob(blob,exportedFilename);
      }else{
        let link = document.createElement("a");
        if(link.download != undefined){
          let url = URL.createObjectURL(blob);
          link.setAttribute('href',url);
          link.setAttribute('download',exportedFilename);
          link.style.visibility='hidden';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }
      }
    },
    exportData(){
      let headers={
        npedido:"N Pedido",
        area_id:"ID Area",
        descripcion: "Descripcion",
        cantidad: "Cantidad",
        unidad: "Unidades",
        tipo: "Tipo",
        cod_ppto: "COD_PPTO",
        cod_pomdihma: "COD_POMDIHMA",
        fecha: "Fecha",
        fecha_atendido: "Fecha Atendido",
        fecha_pc: "Fecha PC",
        seguimiento: "Seguimiento",
        costo_estimado: "Costo Estimado",
        costo_real: "Costo Real"
      }
      this.exportCSVFile(headers,this.filterOrders,'pedidos')
    }
  }
})