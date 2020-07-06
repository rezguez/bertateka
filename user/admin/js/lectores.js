//
//DataTables initialisation example LECTORES
//
$(document).ready(function() {
 var table = $('#example').DataTable( {
     "columnDefs": [
 		 { "data": "CODIGOLECTOR", "title": "CODIGO", "targets": 0  },
         { "data": "LECTOR-A", "targets": 1  },
         { "data": "CURSO", "targets": 2 },
         { "data": "APELLIDOS", "targets": 3, "visible" : false },
         { "data": "NOMBRE", "targets": 4, "visible" : false },
         { "data": "FECHAALTA", "targets": 5, "visible" : false },
         { "data": "NACIMIENTO", "targets": 6, "visible" : false },
     ],
     "order": [ 1, 'asc' ],
	   "scrollY":     350,
	    "scroller":    true,
	   "lengthMenu": [ 12, 30, 60, 100 ],
	   "pageLength": 12,
     "language": {
   	    "decimal":        "",
   	    "emptyTable":     "Sin datos",
   	    "info":           "<div class='badge badge-light m-1'> _START_ - _END_  (_TOTAL_ filas)</div>",
   	    "infoEmpty":      "<div class='badge badge-light m-1'>0 filas</div>",
   	    "infoFiltered":   "<div class='badge badge-light m-1'>de _MAX_</div>",
   	    "infoPostFix":    "",
   	    "thousands":      ",",
   	    "lengthMenu":     "<div class='badge badge-light m-1'>Muestra _MENU_ </div>",
   	    "loadingRecords": "Cargando...",
   	    "processing":     "En proceso...",
   	    "search":         "<div class='badge badge-light m-1'>Buscar:",
   	    "zeroRecords":    "No se han encontrado datos",
   	    "paginate": {
   	        "first":      "Ant",
   	        "last":       "Fin",
   	        "next":       "Sig",
   	        "previous":   "Ini"
 	  		}   
     }  
 } );

 $('#example tbody').on( 'click', 'tr', function () {
	  var data = table.row( this).data();
	  rellena(data);
 } );
} );



//
//DataTables initialisation leidos PRESTAMOD POR LECTOR
//
$(document).ready(function() {
var table2 = $('#leidos').DataTable( {
   
   "columnDefs": [
       { "data": "NUMPRES", "targets": 0, "visible": false, "searchable": false },
	  	{ "data": "FECHA", "targets": 1, "searchable": false },
       { "data": "LIBRO", "targets": 2 },
       { "data": "CODLEC", "targets": 3, "visible": false },
       { "data": "ESTADO", "targets": 4, "searchable": false  }

   ],
   "order": [ 1, 'des' ],
   "paging": false,
   "search": {
       "search": "ZZZZZZZ"
     },
	   "scrollY":     200,
	    "scroller":    true,
     "language": {
 	    "decimal":        "",
 	    "emptyTable":     "Sin datos",
 	    "info":           "<div class='badge badge-light m-1'> _END_ lecturas</div>",
 	    "infoEmpty":      "<div class='badge badge-light m-1'>0 filas</div>",
 	    "infoFiltered":   "<div class='badge badge-light m-1'>de _MAX_</div>",
 	    "infoPostFix":    "",
 	    "thousands":      ",",
 	    "lengthMenu":     "<div class='badge badge-light m-1'>Muestra _MENU_ </div>",
 	    "loadingRecords": "Cargando...",
 	    "processing":     "En proceso...",
 	    "search":         "<div style='display:none;'>Buscar:",
 	    "zeroRecords":    "No se han encontrado datos",
 	    "paginate": {
 	        "first":      "Ant",
 	        "last":       "Fin",
 	        "next":       "Sig",
 	        "previous":   "Ini"
	  		}   
   }       
} );


} );


 
//     JS Carga datos en editaModal 
function rellena(resultados){
	var cursos = ["ADULTOS","ESO 1","ESO 2","INF 3","INF 4","INF 5","OTROS","PRI 1","PRI 2","PRI 3","PRI 4","PRI 5","PRI 6"];
	var selectcursos = "<option value='ADULTOS'>ADULTOS</option>" + "<option value='ESO 1'>ESO 1</option><option value='ESO 2'>ESO 2</option>"+"<option value='INF 3'>INF 3</option><option value='INF 4'>INF 4</option><option value='INF 5'>INF 5</option>";
	selectcursos = selectcursos + "<option value='OTROS'>OTROS</option><option value='PRI 1'>PRI 1</option><option value='PRI 2'>PRI 2</option><option value='PRI 3'>PRI 3</option>";
	selectcursos = selectcursos + "<option value='PRI 4'>PRI 4</option><option value='PRI 5'>PRI 5</option><option value='PRI 6'>PRI 6</option></SELECT>";
	
	var campostxt = ["CODIGOLECTOR","APELLIDOS","NOMBRE","NACIMIENTO","FECHAALTA"];
	var camposselect = ["CURSO"];

	campostxt.forEach(myFunctiontxt);
	
	camposselect.forEach(myFunctionselect);

	var texto = document.getElementById("edit_lector").elements.namedItem('CODIGOLECTOR').value;
	$('#leidos').DataTable().search( texto ).draw();

	function myFunctiontxt(item, index) {
	
	 document.getElementById("edit_lector").elements.namedItem(item).value=limpiar(resultados[item]); 
	}

	function myFunctionselect(item, index) {
		var opt = "'"+limpiar(resultados[item])+"'";
		var res = selectcursos.replace(opt, opt + "selected");
	 document.getElementById("edit_lector").elements.namedItem(item).innerHTML= res; 
	}
}
