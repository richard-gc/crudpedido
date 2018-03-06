document.getElementById('formlg').addEventListener('submit',e=>{
	console.log("submit")
	e.preventDefault();
	let user,pass,form,connect;
	user = document.getElementById('user').value;
	pass = document.getElementById('pass').value;
	form = 'user='+user+'&pass='+pass;
	connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	connect.onreadystatechange = function(){
      if(connect.responseText == 1){
        location.reload();
      }				
	}
	connect.open('POST','sesion/login.php',true);
	connect.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	connect.send(form);
})