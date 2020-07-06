//
//DataTables initialisation example LECTORES
//
$(document).ready(function() {
 var table = $('#example').DataTable( {
	   
	   "columnDefs": [
	       { "data": "NUMPRES", "targets": 0, "visible": false, "searchable": false },
		   { "data": "FECHA", "targets": 1},
		   { "data": "ENTREGA", "targets": 2 },
	       { "data": "LIBRO", "targets": 4},
	       { "data": "LECTOR", "targets": 3},
	       { "data": "CURSO", "targets": 5},
	       { "data": "CODLEC", "targets": 6, "visible": false },
	       { "data": "ESTADO", "targets": 7, "searchable": false  }

	   ],
	   "order": [ 1, 'des' ],
	   "scrollY":     350,
	    "scroller":    true,
	   "lengthMenu": [ 12, 30, 60, 100 ],
	   "pageLength": 12,
	   "language": {
	 	    "decimal":        "",
	 	    "emptyTable":     "Sin datos",
	 	    "info":           "<div class='badge badge-light m-1'>_START_ - _END_  (_TOTAL_ lecturas)</div>",
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

});


$(document).ready(function(){
	$('#CURSO').val();
	recargarLista();

	$('#CURSO').change(function(){
		recargarLista();
	});
});

//
//DataTables initialisation example LECTORES
//
$(document).ready(function() {
 var table = $('#dtBasicExample').DataTable( {
     "columnDefs": [
		{ "data": "CODEJEM", "targets": 0 },
		{ "data": "TITULO", "targets": 1 },
		{ "data": "PRESTADO", "targets": 2 }
     ],
     "order": [ 1, 'asc' ],
	   "scrollY":     200,
	    "scroller":    true,
	   "lengthMenu": [ 5, 30, 60, 100 ],
	   "pageLength": 5,
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
 
 $('#dtBasicExample tbody').on( 'click', 'tr', function () {
	  var data = table.row( this).data();
	  recuperalibro(data);
} );

} );	
