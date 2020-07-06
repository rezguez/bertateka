<?php
//Variables de configuracion general

//Variables de configuracion para ejemplares.php
$baseclass='lil';

include_once 'inc/head.inc';
if ($_SESSION['ok']==false) header("Location: ../login.php");

include_once 'inc/nav.inc';

include_once '../clases/Modelo.php';
include_once '../clases/EjemplaresModelo.php';
include_once '../clases/LecturasModelo.php';
include_once '../clases/FichaForm.php';


// *************** Para mensaje de ACCION REALIZADA *************
$mimensaje='0';
$Ejemplares = new EjemplaresModelo();

// ************ ACCIONES CON DATOS ENVIADOS MEDIANTE UN FORM *************

if ( isset($_GET['action'])) {
    $accion='';
    switch ($_GET['action']) {
        case 'modificar' :
            $Ejemplares->modificar($_POST) ;
            $accion="actualizado";
            break;
        case 'borrar' :
            $Ejemplares->borrar($_POST['CODEJEM']) ;
            $accion="borrado";
            break;
        case 'add' :
            $Ejemplares->crear($_POST) ;
            $accion="a�adido";
            break;
    }
    $mimensaje="<p>Se ha $accion a </p><p class='".$baseclass."'>". $_POST['TITULO'] . " (" . $_POST['CODEJEM']. ")</p>";
}

$datosejemplares=$Ejemplares->leer();
$Lecturas = new LecturasModelo();
$datoslecturas = $Lecturas->leer();

include_once 'inc/ejemplares.inc';
include_once 'inc/funciones.inc';
include_once 'inc/main.inc';

echo "<!-- EMPIEZA FILA PRINCIPAL -->\n
<div class='row'>\n\n";

echo "	<!-- EMPIEZA COL IZQUIERDA -->\n<div class='col-8'>\n";
// *********************************************
// CONTENIDO PRINCIPAL IZQUIERDA
// *********************************************
$body1 = "<table id='example' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
					       	<th class='m-0  ".$baseclass."th'>CODEJEM</th>
							<th class='m-0  ".$baseclass."th'>TITULO</th>
                            <th class='m-0  ".$baseclass."th'>EDITORIAL</th>
							<th class='m-0  ".$baseclass."th'>PRESTADO</th>
							<th class='m-0  ".$baseclass."th'>SERIE</th>
							<th class='m-0  ".$baseclass."th'>AUTOR</th>
							
							<th class='m-0  ".$baseclass."th'>FILA</th>
							<th class='m-0  ".$baseclass."th'>COLUMNA</th>
							<th class='m-0  ".$baseclass."th'>IDIOMA</th>
							<th class='m-0  ".$baseclass."th'>FONDO</th>
							<th class='m-0  ".$baseclass."th'>TIPO</th>
							<th class='m-0  ".$baseclass."th'>FECHAALTA</th>
						
						</tr>
					</thead>
				    </tbody>";
for ($n = 0; $n < count($datosejemplares); $n++) {
    $body1 .= "<tr>";
    $body1 .= "<td><div class='marca fld-CODIGOLECTOR m-1'>".$datosejemplares[$n]['CODEJEM']."</div></td>";
    $body1 .= "<td><div class='marca fld-LIBRO m-1'>". ($datosejemplares[$n]['TITULO']) ."</div></td>";
    $body1 .= "<td><div class='marca fld-LIBRO m-1'>".($datosejemplares[$n]['EDITORIAL'])."</div></td>";
    $body1 .= "<td><div class='badge fld-".$datosejemplares[$n]['PRESTADO']." m-1'>". $datosejemplares[$n]['PRESTADO'] ."</div></td>";
    $body1 .= "<td>".($datosejemplares[$n]['SERIE'])."</td>";
    $body1 .= "<td>".($datosejemplares[$n]['AUTOR'])."</td>";

    $body1 .= "<td>".$datosejemplares[$n]['FILA']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['COLUMNA']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['IDIOMA']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['FONDO']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['TIPO']."</td>";
    $body1 .= "<td>".$datosejemplares[$n]['FECHAALTA']."</td>";
    $body1 .= '</tr>';
}
$body1 .= "\n</tbody>\n</table><!-- FIN tabla -->\n\n";

$Ges_Ejemplar->setCard($body1);
echo $Ges_Ejemplar->getCard();




echo "</div><!-- FIN COL IZQUIERDA -->\n\n<!-- EMPIEZA COL DERECHA -->\n<div class='col-4'>\n";

// *********************************************
// CONTENIDO DERECHA
// *********************************************
$body2= "<ul class='list-group  list-group-flush'><li class='list-group-item ".$baseclass."label' id='mititulo'> </li></ul>\n";
$body2 .= "<!-- tabla -->


<table id='leidos'	class='table-striped display compact' style='width:100%'>
<thead>
<tr>
<th class='th m-0 ".$baseclass."th '>NUMPRES</th>
<th class='th m-0 ".$baseclass."th '>FECHA</th>

<th class='th m-0 ".$baseclass."th '>LIBRO</th>
<th class='th m-0 ".$baseclass."th '>LECTOR</th>
<th class='th m-0 ".$baseclass."th '>CODLEC</th>
<th class='th m-0 ".$baseclass."th '>ESTADO</th>
</tr>
</thead>
<tbody>";


for ($n = 0; $n < count($datoslecturas); $n++) {
    $prestamo_id = $datoslecturas[$n]['NUMPRES'];
    $ejemplar_id = $datoslecturas[$n]['CODEJ'];
    $libroutf=utf8_encode($datoslecturas[$n]['LIBRO']);
    
    $body2 .= "<td >".$datoslecturas[$n]['NUMPRES']."</td>";
    $body2 .= "<td style='text-align:center'><div  class='marca fld-FECHA'>".$datoslecturas[$n]['FECHA']."</div></td>";

    $body2 .= "<td >". $datoslecturas[$n]['LIBRO'] ."</td>";
    $body2 .= "<td ><div  class='marca fld-ALIAS'>". ($datoslecturas[$n]['LECTOR']) ."</div></td>";
    $body2 .= "<td >". $datoslecturas[$n]['CODLEC'] ."</td>";
    if ( $datoslecturas[$n]['ESTADO'] == 'DEVUELTO' ) {
        $body2 .= "<td></td>";
    }
    else {
        $body2 .= "<td><a href='prestamos.php?action=devolver&idprestamo=$prestamo_id&idejemplar=$ejemplar_id' class='marca fld-WARNING m-0 p-1' onclick='despedidalibro(".chr(34).$libroutf.chr(34).")'>Devolver</a></td>";
    }
    
    $body2 .= '</tr>';
}



$body2 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Historial->setCard($body2);
echo $Historial->getCard();





echo "</div><!-- FIN mainbox -->\n</div><!-- FIN container -->\n</main><!-- FIN MAIN -->\n";

// *********************************************
// CONTENIDO MODAL "EMERGENTE"
// *********************************************

echo $Emergente->getFormModal();
echo $Derecha->getFormModal();
include_once 'inc/footer.inc';
?>

<!-- Mis scpts -->
<script type="text/javascript" src="js/ejemplares.js"></script>
<script type="text/javascript"> 
<!-- ************ JS Carga datos en editaModal ************* -->
function rellena(resultados){

	var optselec = [];

	<?php 
			echo "optselec[".chr(34)."COLUMNA".chr(34)."] = ".chr(34);
			foreach($global_columna as $n) {
			echo "<option value='$n'>$n</option>";
			    }
			 echo chr(34)."; \n";   
			 echo "optselec[".chr(34)."FILA".chr(34)."] = ".chr(34);
			 foreach($global_fila as $n) {
			     echo "<option value='$n'>$n</option>";
			 }
			 echo chr(34).";\n ";
			 echo "optselec[".chr(34)."FONDO".chr(34)."] = ".chr(34);
			 foreach($global_fondo as $n) {
			     echo "<option value='$n'>$n</option>";
			 }
			 echo chr(34).";\n ";
			 echo "optselec[".chr(34)."TIPO".chr(34)."] = ".chr(34);
			 foreach($global_tipo as $n) {
			     echo "<option value='$n'>$n</option>";
			 }
			 echo chr(34).";\n ";
			 echo "optselec[".chr(34)."IDIOMA".chr(34)."] = ".chr(34);
			 foreach($global_idioma as $n) {
			     echo "<option value='$n'>$n</option>";
			 }
			 echo chr(34).";\n";
			?>
	
	var campostxt = ["CODEJEM","TITULO","SERIE","AUTOR","EDITORIAL","FECHAALTA","PRESTADO"];
	var camposselect = ["IDIOMA","FONDO","TIPO","FILA","COLUMNA"];

	campostxt.forEach(myFunctiontxt);
	camposselect.forEach(myFunctionselect);

	var texto = limpiar(document.getElementById("edit_ejemplar").elements.namedItem('CODEJEM').value);
	var titulo = limpiar(document.getElementById("edit_ejemplar").elements.namedItem('TITULO').value);
	document.getElementById("mititulo").innerHTML= titulo;
	$('#leidos').DataTable().search( texto ).draw();
	function myFunctiontxt(item, index) {
	 document.getElementById("edit_ejemplar").elements.namedItem(item).value=limpiar(resultados[item]); 
	}

	function myFunctionselect(item, index) {
		var opt = "'"+resultados[item]+"'";
		var res = optselec[item].replace(opt, opt + " selected");
	 document.getElementById("edit_ejemplar").elements.namedItem(item).innerHTML= res; 
	}
}
</script>
