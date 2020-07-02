<?php
//Variables de configuracion general

// variables de mensaje global
$st_despedida='Procesando petición...';
$st_consulta='Abriendo consulta pública de ejemplares';
$st_stats='Abriendo las estadísticas públicas';

//Variables de configuracion para index.php
$baseclass='vin';

//Clases necesarias para index.php
include_once 'clases/Modelo.php';
include_once 'clases/EjemplaresModelo.php';
include_once 'clases/FichaForm.php';

// *************** Para mensaje de ACCION REALIZADA *************
$mimensaje='0';

include_once 'inc/head.inc';
include_once 'inc/index.inc';
include_once 'inc/main.inc';

echo "<!-- EMPIEZA FILA PRINCIPAL -->\n";
echo "<div class='row'>\n\n";
echo "<div class='col col-12'>\n\n";

// *********************************************
// CONTENIDO PRINCIPAL
// *********************************************
$Ejemplares = new EjemplaresModelo();
$datosejemplares=$Ejemplares->leer();
$body1 = "<table id='example' class='table-striped invisible compact'
					style='width: 100%'>
					<thead>
						<tr>
					       	<th class='m-0  ".$baseclass."th'>CODEJEM</th>
							<th class='m-0  ".$baseclass."th'>TITULO</th>
                            <th class='m-0  ".$baseclass."th'>EDITORIAL</th>

							<th class='m-0  ".$baseclass."th'>SERIE</th>
							<th class='m-0  ".$baseclass."th'>AUTOR</th>
							
							<th class='m-0  ".$baseclass."th'>UBIC</th>
							<th class='m-0  ".$baseclass."th'>PRESTADO</th>
							<th class='m-0  ".$baseclass."th'>IDIOMA</th>
							<th class='m-0  ".$baseclass."th'>FONDO</th>
							<th class='m-0  ".$baseclass."th'>TIPO</th>
							<th class='m-0  ".$baseclass."th'>FECHAALTA</th>
						</tr>
					</thead>
				    </tbody>";
for ($n = 0; $n < count($datosejemplares); $n++) {
    $body1 .= "<tr>";
    $body1 .= "<td><span class='marca fld-CODIGOLECTOR m-1'>".$datosejemplares[$n]['CODEJEM']."</span></td>";
    $body1 .= "<td><span class='marca fld-LIBRO m-1'>". ($datosejemplares[$n]['TITULO']) ."</span></td>";
    $body1 .= "<td><span class='marca fld-EDITORIAL m-1'>".($datosejemplares[$n]['EDITORIAL'])."</span></td>";

    $body1 .= "<td><span class='marca fld-SERIE m-1'>".($datosejemplares[$n]['SERIE'])."</span></td>";
    $body1 .= "<td><span class='marca fld-ALIAS m-1'>".($datosejemplares[$n]['AUTOR'])."</span></td>";

    $body1 .= "<td><span class='marca fld-CURSO m-1'>".$datosejemplares[$n]['UBIC']."</span></td>";
    $body1 .= "<td><span class='marca fld-".$datosejemplares[$n]['PRESTADO']." m-1'>". $datosejemplares[$n]['PRESTADO'] ."</span></td>";
    $body1 .= "<td>".$datosejemplares[$n]['IDIOMA']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['FONDO']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['TIPO']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['FECHAALTA']."</td>";
    $body1 .= '</tr>';
}
$body1 .= "\n</tbody>\n</table><!-- FIN tabla -->\n\n";

$Ges_Ejemplar->setCard($body1);
echo $Ges_Ejemplar->getCard();

echo "</div>
</div><!-- FIN PRINCIPAL -->

</div><!-- FIN mainbox -->
</div><!-- FIN container -->
</main><!-- FIN MAIN -->\n";

// *********************************************
// CONTENIDO MODAL "EMERGENTE"
// *********************************************

echo $Derecha->FichaModal->getCard();
include_once 'inc/footer.inc';
?>

<!-- Mis scpts -->

<script type="text/javascript"> 
<!-- ************ JS Carga datos en editaModal ************* -->
function rellena(resultados){
	var campostxt = ["CODEJEM","TITULO","SERIE","AUTOR","EDITORIAL","FECHAALTA","PRESTADO","IDIOMA","FONDO","TIPO","UBIC"];

	campostxt.forEach(myFunctiontxt);

	function myFunctiontxt(item, index) {
	 document.getElementById("edit_ejemplar").elements.namedItem(item).value=limpiar(resultados[item]); 
	}


}

//
//DataTables initialisation example LECTORES
//
$(document).ready(function() {
    $('#adios').modal('hide');
    document.getElementById('example').classList.remove('invisible');
var table = $('#example').DataTable( {
   "columnDefs": [
  	{ "data": "CODEJEM", "targets": 0 },
		{ "data": "TITULO", "targets": 1 },
		{ "data": "EDITORIAL", "targets": 2},

		{ "data": "SERIE", "targets": 3 },
		{ "data": "AUTOR", "targets": 4 },
		{ "data": "UBIC", "targets": 5},
		{ "data": "PRESTADO", "targets": 6 },
		{ "data": "IDIOMA", "targets": 7, "visible": false },
		{ "data": "FONDO", "targets": 8, "visible": false },
		{ "data": "TIPO", "targets": 9, "visible": false },
		{ "data": "FECHAALTA", "targets": 10, "visible": false, "searchable": false  }
   	    
   ],
   "order": [ 1, 'asc' ],
	   "scrollY":     400,
	    "scroller":    true,
	   "lengthMenu": [ 12, 30, 60, 100 ],
	   "pageLength": 12,
   "language": {
 	    "decimal":        "",
 	    "emptyTable":     "Sin datos",
 	    "info":           "<div class='badge badge-light m-1'> _START_ - _END_  (_TOTAL_ ejemplares)</div>",
 	    "infoEmpty":      "<div class='badge badge-light m-1'>0 ejemplares</div>",
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
	 $('#detalleejemplar').modal('show');
	  var data = table.row( this).data();
	  rellena(data);
} );
} );
$('#adios').modal('show');
</script>
