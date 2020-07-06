// MENSAJE TOAST DE ACCION REALIZADA 
 $('#aviso').toast({animation: true, delay: 4000});
 $('#aviso').toast('show');
 

//     JS ADIOS VENTANA MIENTRAS SE CARGA PAGINA NUEVA 
function despedida(texto){

	if (texto!=null) document.getElementById("mensajeadios").innerHTML= texto;
	$('#adios').modal('show');
};

// PARA QUITAR LAS MARCAS DIV A LOS RESULTADOS DE LAS CELDAS DE LAS TABLAS
function limpiar(dato){
	if (dato == null) return '';
	var n = dato.search(">");

	  if (n<0) res=dato;
	 	 else  res = dato.substr(n+1);
	  var m = res.search("<");
	  if (m<0) fin=res;
	  	else  fin = res.substr(0,m); 
    return fin;
};

function despedidalibro(texto){

	if (texto!=null) document.getElementById("mensajeadios").innerHTML="Devolución de <div class='marca fld-LIBRO m-1'>"+texto+"</div>";
	$('#adios').modal('show');
};