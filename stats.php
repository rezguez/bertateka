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
include_once 'clases/RankingModelo.php';
include_once 'clases/FichaForm.php';

// *************** Para mensaje de ACCION REALIZADA *************
$mimensaje='0';
include_once 'inc/head.inc';
include_once 'inc/index.inc';
include_once 'inc/main.inc';
echo "<!-- EMPIEZA FILA PRINCIPAL -->\n
<div class='row'>\n\n";
echo "	<!-- EMPIEZA COL IZQUIERDA -->\n<div class='col-4'>\n";

// *********************************************
// CONTENIDO PRINCIPAL IZQUIERDA
// *********************************************
$Ranking = new RankingModelo();
$datosranking = $Ranking->leer();
$Ges_Obras= new FichaCard('ges_lector', "RANKING DE OBRAS", null, 'button', '#nuevolector', $baseclass);
$body1 = "<!-- tabla -->\n<table id='example' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
							<th class='m-0  ".$baseclass."th'>OBRA</th>
							<th class='m-0  ".$baseclass."th'>LECTURAS</th>
						</tr>
					</thead>
				<tbody>";
for ($n = 0; $n < count($datosranking); $n++) {
    
    $body1 .= "<tr><td ><div  class='marca fld-LIBRO'>".$datosranking[$n]['OBRA']."</div></td>";

//     $body1 .= "<td style='text-align:center'><div  class='marca fld-CURSO'>".$datosranking[$n]['CICLO']."</div></td>";
    $body1 .= "<td style='text-align:center'><div  class='marca fld-CURSO'>".$datosranking[$n]['TT_LEC']."</div></td>";
    $body1 .= '</tr>';
}

$body1 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Ges_Obras->setCard($body1);
echo $Ges_Obras->getCard();


echo "</div><!-- FIN COL IZQUIERDA -->\n\n<!-- EMPIEZA COL CENTRO -->\n<div class='col-4'>\n";

// *********************************************
// CONTENIDO DERECHA
// *********************************************
$datosranking = $Ranking->leerciclos();
$Ges_Ciclo= new FichaCard('ges_lector', "RANKING POR CICLO", null, 'button', '#nuevolector', $baseclass);
$body1 = "<div class='input-group input-group-sm mb-1'>
						<div class='input-group-prepend'>
						<span class='input-group-text $baseclass col-form-label col-form-label-sm '>CICLO</span></div>
        						<select class='form-control form-control-sm ' id='SELCICLO' name='SELCICLO' onchange='rellena()'>
        							<option value='0 INF'>INFANTIL</option>
        							<option value='1 CICLO'>PRIMER CICLO</option>
        							<option value='2 CICLO'>SEGUNDO CICLO</option>
        							<option value='3 CICLO'>TERCER CICLO</option>
        							<option value='4 ESO'>ESO</option>
        							<option value='5 OTROS'>OTROS</option>
        						</select>
            </div>
<!-- tabla -->\n<table id='ciclo' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
			     			<th class='m-0  text-center ".$baseclass."th'>CICLO</th>
							<th class='m-0 text-center  ".$baseclass."th'>OBRA</th>
							    
							<th class='m-0 text-center  ".$baseclass."th'>LECTURAS</th>
						</tr>
					</thead>
				<tbody>";
for ($n = 0; $n < count($datosranking); $n++) {
    
    $body1 .= "<tr><td><div  class='marca fld-CURSO'>".$datosranking[$n]['CICLO']."</div></td>";
    $body1 .= "<td ><div  class='marca fld-LIBRO'>".$datosranking[$n]['OBRA']."</div></td>";
    $body1 .= "<td style='text-align:center'><div  class='marca fld-CURSO'>".$datosranking[$n]['TT_LEC']."</div></td>";
    $body1 .= '</tr>';
}

$body1 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Ges_Ciclo->setCard($body1);
echo $Ges_Ciclo->getCard();
echo "</div><!-- FIN COL CENTRO -->\n\n<!-- EMPIEZA COL DERECHA -->\n<div class='col-4'>\n";
$datosranking = $Ranking->leereditorial();
$Ges_Ciclo= new FichaCard('ges_lector', "RANKING POR EDITORIAL", null, 'button', '#nuevolector', $baseclass);
$body1 = "<div class='input-group input-group-sm mb-1'>
						<div class='input-group-prepend'>
						<span class='input-group-text $baseclass col-form-label col-form-label-sm '>CICLO</span></div>
        						<select class='form-control form-control-sm ' id='SELCICLO2' name='SELCICLO' onchange='rellenaed()'>
        							<option value='0 INF'>INFANTIL</option>
        							<option value='1 CICLO'>PRIMER CICLO</option>
        							<option value='2 CICLO'>SEGUNDO CICLO</option>
        							<option value='3 CICLO'>TERCER CICLO</option>
        							<option value='4 ESO'>ESO</option>
        							<option value='5 OTROS'>OTROS</option>
        						</select>
            </div>
<!-- tabla -->\n<table id='editorial' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
			     			<th class='m-0  text-center ".$baseclass."th'>CICLO</th>
							<th class='m-0  text-center ".$baseclass."th'>EDITORIAL</th>
							    
							<th class='m-0 text-center  ".$baseclass."th'>LECTURAS</th>
						</tr>
					</thead>
				<tbody>";
for ($n = 0; $n < count($datosranking); $n++) {
    
    $body1 .= "<tr><td><div  class='marca fld-CURSO'>".$datosranking[$n]['CICLO']."</div></td>";
    $body1 .= "<td ><div  class='marca fld-EDITORIAL'>".$datosranking[$n]['EDITORIAL']."</div></td>";
    $body1 .= "<td style='text-align:center'><div  class='marca fld-CURSO'>".$datosranking[$n]['TT_LEC']."</div></td>";
    $body1 .= '</tr>';
}

$body1 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Ges_Ciclo->setCard($body1);
echo $Ges_Ciclo->getCard();
echo "</div><!-- EMPIEZA FILA segunda -->\n
<div class='row col-8 mx-auto'>\n\n";
echo "	<!-- EMPIEZA COL IZQUIERDA -->\n<div class='col-6'>\n";

// *********************************************
// CONTENIDO SEGUNDA IZQUIERDA
// *********************************************
$datosranking = $Ranking->leerserie();
$Ges_Ciclo= new FichaCard('ges_lector', "RANKING POR SERIE", null, 'button', '#nuevolector', $baseclass);
$body1 = "<div class='input-group input-group-sm mb-1'>
						<div class='input-group-prepend'>
						<span class='input-group-text $baseclass col-form-label col-form-label-sm '>CICLO</span></div>
        						<select class='form-control form-control-sm ' id='SELCICLO3' name='SELCICLO' onchange='rellenase()'>
        							<option value='0 INF'>INFANTIL</option>
        							<option value='1 CICLO'>PRIMER CICLO</option>
        							<option value='2 CICLO'>SEGUNDO CICLO</option>
        							<option value='3 CICLO'>TERCER CICLO</option>
        							<option value='4 ESO'>ESO</option>
        							<option value='5 OTROS'>OTROS</option>
        						</select>
            </div>
<!-- tabla -->\n<table id='serie' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
			     			<th class='m-0 text-center  ".$baseclass."th'>CICLO</th>
							<th class='m-0 text-center  ".$baseclass."th'>SERIE</th>
							    
							<th class='m-0 text-center  ".$baseclass."th'>LECTURAS</th>
						</tr>
					</thead>
				<tbody>";
for ($n = 0; $n < count($datosranking); $n++) {
    
    $body1 .= "<tr><td><div  class='marca fld-CURSO'>".$datosranking[$n]['CICLO']."</div></td>";
    $body1 .= "<td ><div  class='marca fld-EDITORIAL'>".$datosranking[$n]['SERIE']."</div></td>";
    $body1 .= "<td style='text-align:center'><div  class='marca fld-CURSO'>".$datosranking[$n]['TT_LEC']."</div></td>";
    $body1 .= '</tr>';
}

$body1 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Ges_Ciclo->setCard($body1);
echo $Ges_Ciclo->getCard();
echo "</div><!-- FIN COL IZQUIEDA -->\n\n<!-- EMPIEZA COL DERECHA -->\n<div class='col-6'>\n";
$datosranking = $Ranking->leerautor();
$Ges_Ciclo= new FichaCard('ges_lector', "RANKING POR AUTOR", null, 'button', '#nuevolector', $baseclass);
$body1 = "<div class='input-group input-group-sm mb-1'>
						<div class='input-group-prepend'>
						<span class='input-group-text $baseclass col-form-label col-form-label-sm '>CICLO</span></div>
        						<select class='form-control form-control-sm ' id='SELCICLO4' name='SELCICLO' onchange='rellenaau()'>
        							<option value='0 INF'>INFANTIL</option>
        							<option value='1 CICLO'>PRIMER CICLO</option>
        							<option value='2 CICLO'>SEGUNDO CICLO</option>
        							<option value='3 CICLO'>TERCER CICLO</option>
        							<option value='4 ESO'>ESO</option>
        							<option value='5 OTROS'>OTROS</option>
        						</select>
            </div>
<!-- tabla -->\n<table id='autor' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
			     			<th class='m-0 text-center ".$baseclass."th'>CICLO</th>
							<th class='m-0 text-center  ".$baseclass."th'>AUTOR-A</th>
							    
							<th class='m-0 text-center  ".$baseclass."th'>LECTURAS</th>
						</tr>
					</thead>
				<tbody>";
for ($n = 0; $n < count($datosranking); $n++) {
    
    $body1 .= "<tr><td><div  class='marca fld-CURSO'>".$datosranking[$n]['CICLO']."</div></td>";
    $body1 .= "<td ><div  class='marca fld-ALIAS'>".$datosranking[$n]['AUTOR']."</div></td>";
    $body1 .= "<td style='text-align:center'><div  class='marca fld-CURSO'>".$datosranking[$n]['TT_LEC']."</div></td>";
    $body1 .= '</tr>';
}

$body1 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Ges_Ciclo->setCard($body1);
echo $Ges_Ciclo->getCard();
echo "</div><!-- FIN mainbox -->\n</div><!-- FIN container -->\n</main><!-- FIN MAIN -->\n";

// *********************************************
// CONTENIDO MODAL "EMERGENTE"
// *********************************************

include_once 'inc/footer.inc';
?>
<!-- Mis scpts -->
<script type="text/javascript">

//
//DataTables initialisation leidos RANKING OBRAS
//
$(document).ready(function() {
var table2 = $('#example').DataTable( {
 
 "columnDefs": [
     { "data": "OBRA", "targets": 0},
	  	{ "data": "LECTURAS", "targets": 1 }
 ],
 "order": [ 1, 'des' ],
 "paging": false,
 "scrollY":     250,
 "scroller":    true,
   "language": {
	    "decimal":        "",
	    "emptyTable":     "Sin datos",
	    "info":           "<div class='badge badge-light m-1'> _END_ obras</div>",
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

//
//DataTables initialisation leidos RANKING OBRAS
//
$(document).ready(function() {
var table2 = $('#ciclo').DataTable( {
"columnDefs": [
		{ "data": "CICLO", "targets": 0, "visible": false},
	    { "data": "OBRA", "targets": 1},
	  	{ "data": "LECTURAS", "targets": 2 }
],
"dom": '<<t>i>',
"order": [ 2, 'des' ],
"paging": false,
"search": {
    "search": "0 INF"
  },
"scrollY":     250,
"scroller":    true,
 "language": {
	    "decimal":        "",
	    "emptyTable":     "Sin datos",
	    "info":           "<div class='badge badge-light m-1'> _END_ obras</div>",
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

//
//DataTables initialisation leidos RANKING OBRAS
//
$(document).ready(function() {
var table2 = $('#editorial').DataTable( {
"columnDefs": [
		{ "data": "CICLO", "targets": 0, "visible": false},
	    { "data": "EDITORIAL", "targets": 1},
	  	{ "data": "LECTURAS", "targets": 2 }
],
"dom": '<<t>i>',
"order": [ 2, 'des' ],
"paging": false,
"search": {
  "search": "0 INF"
},
"scrollY":     250,
"scroller":    true,
"language": {
	    "decimal":        "",
	    "emptyTable":     "Sin datos",
	    "info":           "<div class='badge badge-light m-1'> _END_ editoriales</div>",
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


//
//DataTables initialisation leidos RANKING OBRAS
//
$(document).ready(function() {
var table2 = $('#serie').DataTable( {
"columnDefs": [
		{ "data": "CICLO", "targets": 0, "visible": false},
	    { "data": "SERIE", "targets": 1},
	  	{ "data": "LECTURAS", "targets": 2 }
],
"dom": '<<t>i>',
"order": [ 2, 'des' ],
"paging": false,
"search": {
"search": "0 INF"
},
"scrollY":     250,
"scroller":    true,
"language": {
	    "decimal":        "",
	    "emptyTable":     "Sin datos",
	    "info":           "<div class='badge badge-light m-1'> _END_ colecciones</div>",
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


//
//DataTables initialisation leidos RANKING OBRAS
//
$(document).ready(function() {
var table2 = $('#autor').DataTable( {
"columnDefs": [
		{ "data": "CICLO", "targets": 0, "visible": false},
	    { "data": "AUTOR-A", "targets": 1},
	  	{ "data": "LECTURAS", "targets": 2 }
],
"dom": '<<t>i>',
"order": [ 2, 'des' ],
"paging": false,
"search": {
"search": "0 INF"
},
"scrollY":     250,
"scroller":    true,
"language": {
	    "decimal":        "",
	    "emptyTable":     "Sin datos",
	    "info":           "<div class='badge badge-light m-1'> _END_ autores/as</div>",
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
function rellena(){
    res=document.getElementById("SELCICLO").value;
	$('#ciclo').DataTable().search( '"'+res+'"').draw();
	
}
function rellenaed(){
    res=document.getElementById("SELCICLO2").value;
	$('#editorial').DataTable().search( '"'+res+'"').draw();
	
}
function rellenase(){
    res=document.getElementById("SELCICLO3").value;
	$('#serie').DataTable().search( '"'+res+'"').draw();
	
}
function rellenaau(){
    res=document.getElementById("SELCICLO4").value;
	$('#autor').DataTable().search( '"'+res+'"').draw();
	
}
</script>