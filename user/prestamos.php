<?php

//Variables de configuracion general


//Variables de configuracion para prestamos.php
$baseclass='ocr';

include_once 'inc/head.inc';
if ($_SESSION['ok']==false) header("Location: ../login.php");

include_once 'inc/nav.inc';

include_once '../clases/Modelo.php';
include_once '../clases/EjemplaresModelo.php';
include_once '../clases/LectoresModelo.php';
include_once '../clases/PrestamosModelo.php';
include_once '../clases/LecturasModelo.php';
include_once '../clases/FichaForm.php';

// echo "<style> div.dataTables_wrapper div.dataTables_paginate ul.pagination .page-item.active .page-link:focus
// 	{	background-color: #3B5270;}\n
// </style>";


// *************** Para mensaje de ACCION REALIZADA *************
$mimensaje='0';
$Prestamos = new PrestamosModelo();
$Ejemplares = new EjemplaresModelo();
$datosejemplares = $Ejemplares->leer();

// ************ ACCIONES CON DATOS ENVIADOS MEDIANTE UN FORM *************

if ( isset($_GET['action'])) {
    $accion='';
    switch ($_GET['action']) {
        case 'modificar' :
            $Prestamos->modificar($_POST) ;
            $mimensaje="<p>Se ha actualizado</p><p class='".$baseclass."'>". $_POST['TITULO'] . " (" . $_POST['CODEJ']. ")</p>";
            break;
        case 'devolver' :
            $Prestamos->devolver($_GET['idprestamo'], $_GET['idejemplar']) ;
            $mimensaje="<p>Se ha devuelto</p><p class='".$baseclass."'>". " (" . $_GET['idejemplar']. ")</p>";
            break;
        case 'add' :
            $Prestamos->crear($_POST) ;
            $mimensaje="<p>Se ha añadido</p><p class='".$baseclass."'>". $_POST['TITULO'] . " (" . $_POST['CODEJ']. ")</p>";
            break;
    }
    
}

$Lectores = new LectoresModelo();
$datoslectores = $Lectores->leer();
$Lecturas = new LecturasModelo();
$datoslecturas = $Lecturas->leer();

include_once 'inc/prestamos.inc';
include_once 'inc/funciones.inc';
include_once 'inc/main.inc';

// construyo los select secundarios
$nuevoarray=array();

for ($n = 0; $n < count($datoslectores); $n++) {
    
    $k=$datoslectores[$n]['CURSO'];
    $cod=$datoslectores[$n]['CODIGOLECTOR'];
    $ape=$datoslectores[$n]['APELLIDOS'].", ".$datoslectores[$n]['NOMBRE'];
    
    $v['CODIGOLECTOR'] = $cod;
    $v['APELLIDOS'] = $ape;
    
    $nuevoarray[$k][$n]= $v;
    
}
$cursos=array_keys($nuevoarray);

for ($n = 0; $n < count($cursos); $n++) {
    $txthtml[$cursos[$n]] = "<option value=''>Seleccione lector/a</option>";
    foreach ($nuevoarray[$cursos[$n]] as  $value) {
        $txthtml[$cursos[$n]] .= "<option value='".$value['CODIGOLECTOR']."'>".$value['APELLIDOS']."</option>";
    }
    $txthtml[$cursos[$n]] .= "</select>";
}



echo "<!-- EMPIEZA FILA PRINCIPAL -->\n
<div class='row'>\n\n";
    
echo "	<!-- EMPIEZA COL IZQUIERDA -->\n<div class='col-12 mx-auto'>\n";
// *********************************************
// CONTENIDO PRINCIPAL NI IZQ NI DERECHA
// *********************************************

$footer2= "<!-- tabla -->
    
    
<table id='example'	class='table-striped display compact' style='width:100%'>
<thead>
<tr>
<th class='th  ".$baseclass."th '>NUMPRES</th>
<th class='th  ".$baseclass."th '>FECHA</th>
<th class='th  ".$baseclass."th '>ENTREGA</th>
<th class='th  ".$baseclass."th '>LECTOR</th>
<th class='th  ".$baseclass."th '>LIBRO</th>

<th class='th  ".$baseclass."th '>CURSO</th>
<th class='th  ".$baseclass."th '>CODLEC</th>
<th class='th  ".$baseclass."th '>ESTADO</th>
</tr>
</thead>
<tbody>";


for ($n = 0; $n < count($datoslecturas); $n++) {
    $prestamo_id = $datoslecturas[$n]['NUMPRES'];
    $ejemplar_id = $datoslecturas[$n]['CODEJ'];
    $libroutf=$datoslecturas[$n]['LIBRO'];
    $entrega="<div  class='marca fld-FECHA'>".$datoslecturas[$n]['ENTREGA']."</div>";
    if ($datoslecturas[$n]['ENTREGA']=='0000-00-00') $entrega='';
    
    $footer2 .= '<tr>';
    $footer2 .= "<td>".$datoslecturas[$n]['NUMPRES']."</td>";
    $footer2 .= "<td style='text-align:center'><div  class='marca fld-FECHA'>".$datoslecturas[$n]['FECHA']."</div></td>";
    $footer2 .= "<td style='text-align:center'>".$entrega."</td>";
    $footer2 .= "<td><div  class='marca fld-ALIAS'>". ($datoslecturas[$n]['LECTOR']) ."</div></td>";
    $footer2 .= "<td><div  class='marca fld-LIBRO'>". $datoslecturas[$n]['LIBRO'] ."</div></td>";
   
    $footer2 .= "<td><div  class='marca fld-CURSO'>". $datoslecturas[$n]['CURSO'] ."</div></td>";
    $footer2 .= "<td>". $datoslecturas[$n]['CODLEC'] ."</td>";
    if ( $datoslecturas[$n]['ESTADO'] == 'DEVUELTO' ) {
        $footer2 .= "<td></td>";
    }
    else {
        $footer2 .= "<td><a href='prestamos.php?action=devolver&idprestamo=$prestamo_id&idejemplar=$ejemplar_id' class='marca fld-WARNING m-0 p-1' onclick='despedidalibro(".chr(34).$libroutf.chr(34).")'>Devolver</a></td>";
    }
    
    $footer2 .= '</tr>';
}



$footer2 .="\n</tbody>\n</table>\n<!-- tabla -->\n";
$Ges_Prestamo->setCard($footer2);
echo $Ges_Prestamo->getCard();


echo "</div><!-- FIN mainbox -->\n</div><!-- FIN container -->\n</main><!-- FIN MAIN -->\n";
?>
<!-- ************ Modal nuevoprestamo ************* -->
<div class='modal fade sombra' id='nuevoprestamo' tabindex='-1' role='dialog'>
<div class='modal-dialog modal-lg  modal-dialog-centered' role='document'>
<div class='modal-content'>
<!-- ****** Fomulario addprestamo ***** -->
<form role='form' method='post' onsubmit="despedida()" id='addprestamo' action='prestamos.php?action=add'>
<div class='modal-header text-center <?php echo $baseclass; ?>'><h5 style='font-weight: 500;'><?php echo $st_alta; ?></h5></div>
<div class='modal-body pb-3 <?php echo $baseclass; ?>fondo' style='padding-top: 10px;'>


<!-- 		Campo fila FECHAPRESTAMO	 -->
<input type='hidden'  required  class='form-control ' name='FECHAPRESTAMO' value="<?php echo date('Y-m-d'); ?>" >
<!-- 		Select fila CURSO	 -->
					<div class='input-group input-group-sm mb-3'>
						<div class='input-group-prepend'>
						<span class='input-group-text <?php echo $baseclass; ?>label col-form-label col-form-label-sm '>CURSO</span></div>
        						<select class='form-control form-control-sm col-2' id='CURSO' name='CURSO' required>
        							<option value='ADULTOS'>ADULTOS</option>
        							<option value='ESO 1'>ESO 1</option>
        							<option value='ESO 2'>ESO 2</option>
        							<option value='INF 3'>INF 3</option>
        							<option value='INF 4'>INF 4</option>
        							<option value='INF 5'>INF 5</option>
        							<option value='OTROS'>OTROS</option>
        							<option value='PRI 1'>PRI 1</option>
        							<option value='PRI 2'>PRI 2</option>
        							<option value='PRI 3'>PRI 3</option>
        							<option value='PRI 4'>PRI 4</option>
        							<option value='PRI 5'>PRI 5</option>
        							<option value='PRI 6'>PRI 6</option>
        						</select>
						<!-- 		Select fila CODLEC	 -->
								<select required class='form-control form-control-sm col-4' id='CODLEC' name='CODLEC' value=''></select>
						<div class='input-group-prepend'>
						<span class='input-group-text <?php echo $baseclass; ?>label col-form-label-sm'>TITULO</span></div>
						<input type='text'  class='form-control form-control-sm col-4' id='TITULO' name='TITULO' placeholder='' value='' >
					</div>
							
							
						
					

					<!-- 		Campo fila CODEJ	 -->
<input type='hidden'  required class='form-control id='CODEJ' name='CODEJ' value='' >



<!-- 		Campo fila TITULO	 -->
<!-- <div class='input-group  mb-3'> -->
<!-- <div class='input-group-prepend'><span class='input-group-text <?php echo $baseclass; ?>label col-form-label '>TITULO</span></div> -->
<!-- <input type='text'  class='form-control ' id='TITULO' name='TITULO' placeholder='' value='' ></div> -->
 
 
<!-- tabla -->
<table id='dtBasicExample' class='table-striped display compact'
	style='width: 100%'>
<thead>
	<tr>
		<th class='th  m-0  <?php echo $baseclass; ?>th '>CODEJEM</th>
		<th class='th  m-0  <?php echo $baseclass; ?>th '>TITULO</th>
		<th class='th  m-0 <?php echo $baseclass; ?>th '>PRESTADO</th>
	</tr>
</thead>
<tbody>
<?php 
for ($n = 0; $n < count($datosejemplares); $n++) {
    echo "<tr><td><div  class='marca fld-CODIGOLECTOR'>" .$datosejemplares[$n]['CODEJEM'] . "</div></td>";
    echo "<td><div  class='marca fld-LIBRO'>" .($datosejemplares[$n]['TITULO']) . "</div></td>";
    echo "<td><div class='badge fld-".$datosejemplares[$n]['PRESTADO']." m-1'>". $datosejemplares[$n]['PRESTADO'] ."</div></td>";
    echo "</tr>\n";
}
?>

</tbody>
</table>
 
 

</div>
<div class='modal-footer <?php echo $baseclass; ?>fondo' style='width: 100%'>
          <div></div><button class='btn btn-dark' class='close' data-dismiss='modal'>
            Cancelar</button> <button class='btn <?php echo $baseclass; ?>' type='submit'>Guardar</button></div>
</form></div>


            <!-- ****** Final del Fomulario addprestamo ***** -->
</div>
</div>
<div></div>


            <!-- ************ FIN Modal  nuevoprestamo ************* -->
<?php 

 
include_once 'inc/footer.inc';

// construyo los select secundrios
$nuevoarray=array();

for ($n = 0; $n < count($datoslectores); $n++) {
    
    $k=$datoslectores[$n]['CURSO'];
    $cod=$datoslectores[$n]['CODIGOLECTOR'];
    $ape=$datoslectores[$n]['APELLIDOS'].", ".$datoslectores[$n]['NOMBRE'];
    
    $v['CODIGOLECTOR'] = $cod;
    $v['APELLIDOS'] = $ape;
    
    $nuevoarray[$k][$n]= $v;
    
}
$cursos=array_keys($nuevoarray);

for ($n = 0; $n < count($cursos); $n++) {
    $txthtml[$cursos[$n]] = "<option value=''>Seleccione lector/a</option>";
    foreach ($nuevoarray[$cursos[$n]] as  $value) {
        $txthtml[$cursos[$n]] .= "<option value='".$value['CODIGOLECTOR']."'>".$value['APELLIDOS']."</option>";
    }
    //     $txthtml[$cursos[$n]] .= "</select>";
    $txthtml[$cursos[$n]] = utf8_encode( $txthtml[$cursos[$n]]);
}


?>

<!-- Mis scpts -->
<script type="text/javascript" src="js/prestamos.js"></script>
<script type="text/javascript">
function recargarLista(){
	
	var seleccion = <?php echo json_encode($txthtml, JSON_HEX_QUOT); ?>;
	var key = $('#CURSO').val();

	$('#CODLEC').html(seleccion[key]);

};
</script>

<script type="text/javascript"> 
<!-- ************ JS Carga datos en addprestamo ************* -->
function recuperalibro(resultados){
	if ( limpiar(resultados['PRESTADO'])=='PRESTADO') {
		document.getElementById("addprestamo").elements.namedItem('CODEJ').value='';
		document.getElementById("addprestamo").elements.namedItem('TITULO').value='';
		alert('Ya prestado');		
	} else {
		document.getElementById("addprestamo").elements.namedItem('CODEJ').value=limpiar(resultados['CODEJEM']);
		document.getElementById("addprestamo").elements.namedItem('TITULO').value=limpiar(resultados['TITULO']);
	}
};


</script>
