<?php
//Variables de configuracion general

//Variables de configuracion para lectores.php
$baseclass='oxb';

include_once 'inc/head.inc';
if ($_SESSION['ok']==false) header("Location: ../login.php");

include_once 'inc/nav.inc';

include_once '../clases/Modelo.php';
include_once '../clases/LectoresModelo.php';
include_once '../clases/LecturasModelo.php';
include_once '../clases/FichaForm.php';




// *************** Para mensaje de ACCION REALIZADA *************
$mimensaje='0';
$Lectores = new LectoresModelo();

// ************ ACCIONES CON DATOS ENVIADOS MEDIANTE UN FORM *************

if ( isset($_GET['action'])) {
    $accion='';
    switch ($_GET['action']) {
        case 'modificar' :
            $Lectores->modificar($_POST) ;
            $accion="actualizado";
            break;
        case 'borrar' :
            $Lectores->borrar($_POST['CODIGOLECTOR']) ;
            $accion="borrado";
            break;
        case 'add' :
            $Lectores->crear($_POST) ;
            $accion="a�adido";
            break;
    }
    $mimensaje="<p>Se ha $accion a </p><p class='".$baseclass."'>". $_POST['APELLIDOS'] . ", " . $_POST['NOMBRE'] . " (" . $_POST['CODIGOLECTOR']. ")</p>";
}

$datoslectores = $Lectores->leer();
$Lecturas = new LecturasModelo();
$datoslecturas = $Lecturas->leer();

include_once 'inc/lectores.inc';
include_once 'inc/funciones.inc';
include_once 'inc/main.inc';

echo "<!-- EMPIEZA FILA PRINCIPAL -->\n
<div class='row'>\n\n";

echo "	<!-- EMPIEZA COL IZQUIERDA -->\n<div class='col-6'>\n";
// *********************************************
// CONTENIDO PRINCIPAL IZQUIERDA
// *********************************************
$body1 = "<!-- tabla -->\n<table id='example' class='table-striped display compact'
					style='width: 100%'>
					<thead>
						<tr>
							<th class='m-0  ".$baseclass."th'>CODIGO</th>
							<th class='m-0  ".$baseclass."th'>LECTOR-A</th>
							<th class='m-0  ".$baseclass."th'>CURSO</th>
							<th class='m-0  ".$baseclass."th'>APELLIDOS</th>
							<th class='m-0  ".$baseclass."th'>NOMBRE</th>
							<th class='m-0  ".$baseclass."th'>FECHAALTA</th>
                            <th class='m-0  ".$baseclass."th'>NACIMIENTO</th>
						</tr>
					</thead>
				    <tbody>";
for ($n = 0; $n < count($datoslectores); $n++) {
    $body1 .= "<tr>";
    $body1 .= "<td><div class='marca fld-CODIGOLECTOR m-1'>".$datoslectores[$n]['CODIGOLECTOR']."</div></td>";
    $body1 .= "<td><div class='marca fld-ALIAS m-1'>". ($datoslectores[$n]['APELLIDOS']. ", ".$datoslectores[$n]['NOMBRE']) ."</div></td>";
    $body1 .= "<td><div class='marca fld-CURSO m-1'>".($datoslectores[$n]['CURSO'])."</div></td>";
    $body1 .= "<td>".($datoslectores[$n]['APELLIDOS'])."</td>";
    $body1 .= "<td>".($datoslectores[$n]['NOMBRE'])."</td>";
    $body1 .= "<td>".($datoslectores[$n]['FECHAALTA'])."</td>";
    $body1 .= "<td>".($datoslectores[$n]['NACIMIENTO'])."</td>";
    $body1 .= '</tr>';
}
$body1 .= "\n</tbody>\n</table><!-- FIN tabla -->\n\n";


$Ges_Lector->setCard($body1);
echo $Ges_Lector->getCard();




echo "</div><!-- FIN COL IZQUIERDA -->\n\n<!-- EMPIEZA COL DERECHA -->\n<div class='col-6'>\n";

// *********************************************
// CONTENIDO DERECHA
// *********************************************

$footer2= "<!-- tabla -->


<table id='leidos'	class='table-striped display compact' style='width:100%'>
<thead>
<tr>
<th class='th m-0 ".$baseclass."th '>NUMPRES</th>
<th class='th m-0 ".$baseclass."th '>FECHA</th>
<th class='th m-0 ".$baseclass."th '>LIBRO</th>
<th class='th m-0 ".$baseclass."th '>CODLEC</th>
<th class='th m-0 ".$baseclass."th '>ESTADO</th>
</tr>
</thead>
<tbody>";


for ($n = 0; $n < count($datoslecturas); $n++) {
    $prestamo_id = $datoslecturas[$n]['NUMPRES'];
    $ejemplar_id = $datoslecturas[$n]['CODEJ'];
    
    $footer2 .= "<td >".$datoslecturas[$n]['NUMPRES']."</td>";
    $footer2 .= "<td style='text-align:center'><div  class='marca fld-FECHA'>".$datoslecturas[$n]['FECHA']."</div></td>";
    $footer2 .= "<td ><div  class='marca fld-LIBRO'>". $datoslecturas[$n]['LIBRO'] ."</div></td>";
    $footer2 .= "<td >". $datoslecturas[$n]['CODLEC'] ."</td>";
    if ( $datoslecturas[$n]['ESTADO'] == 'DEVUELTO' ) {
        $footer2 .= "<td></td>";
    }
    else {
        $footer2 .= "<td><a href='prestamos.php?action=devolver&idprestamo=$prestamo_id&idejemplar=$ejemplar_id' class='marca fld-WARNING m-0 p-1' onclick='despedida()'>Devolver</a></td>";
    }
    
    $footer2 .= '</tr>';
}



$footer2 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Derecha->setFormCard($footer2);
echo $Derecha->getFormCard();





echo "</div><!-- FIN mainbox -->\n</div><!-- FIN container -->\n</main><!-- FIN MAIN -->\n";

// *********************************************
// CONTENIDO MODAL "EMERGENTE"
// *********************************************

echo $Emergente->getFormModal();

include_once 'inc/footer.inc';
?>

<!-- Mis scpts -->
<script type="text/javascript" src="js/lectores.js"></script>