//
//DataTables initialisation example LECTORES
//
$(document).ready(function() {
 var table = $('#example').DataTable( {
     "columnDefs": [
    	{ "data": "CODEJEM", "targets": 0 },
		{ "data": "TITULO", "targets": 1 },
		{ "data": "EDITORIAL", "targets": 2},
		{ "data": "PRESTADO", "targets": 3  },
		{ "data": "SERIE", "targets": 4 },
		{ "data": "AUTOR", "targets": 5 },
		{ "data": "FILA", "targets": 6 },
		{ "data": "COLUMNA", "targets": 7 },
		{ "data": "IDIOMA", "targets": 8 },
		{ "data": "FONDO", "targets": 9 },
		{ "data": "TIPO", "targets": 10 },
		{ "data": "FECHAALTA", "targets": 11 }
		
     ],
     "order": [ 1, 'asc' ],
	   "scrollY":     350,
	   "scrollX":     true,
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
	  $('#grupo').show();
 } );
} );



//
//DataTables initialisation leidos PRESTAMOD POR LECTOR
//
$(document).ready(function() {
var table2 = $('#leidos').DataTable( {
   
   "columnDefs": [
	   	{ "data": "NUMPRES", "targets": 0, "visible": false, "searchable": false },
	  	{ "data": "FECHA", "targets": 1 },

       { "data": "LIBRO", "targets": 2 , "visible": false },
       { "data": "LECTOR", "targets": 3},
       { "data": "CODLEC", "targets": 4, "visible": false },
       { "data": "ESTADO", "targets": 5, "searchable": false  }

   ],
   "dom": "<<t>i>",
   "paging": false,
   "search": {
       "search": "ZZZ"
     },
	   "scrollY":     300,
	    "scroller":    true,
     "order": [ 1, 'des' ],
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


