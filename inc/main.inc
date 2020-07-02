<?php 
function draw_toast($mimensaje, $idtoast = "aviso", $titulo = "ACCI�N REALIZADA", $class = 'vin')
{
    if (is_null($mimensaje))
        return;
        
        echo "<!-- ************ TOAST $idtoast (Poner antes de <main> ************* -->\n\n";
        
        echo "<div class='row'>
<div class='col-4'></div>
<div class='col-4'>
    <div id='aviso' class='toast' style='margin-bottom: 20px; box-shadow: 3px 4px 15px 1px rgba(0, 0, 0, 0.53);'>
        <div class='toast-header $class'>
            <div class='rounded mr-2 $class"."th' style='height: 16px; width: 16px;'></div>
                <strong class='mr-auto'>$titulo</strong> <small>info</small>
                <button type='button' class='ml-2 mb-1 close' data-dismiss='toast'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
        <div class='toast-body $class"."fondo'>
          <h5 class='text-center'>$mimensaje</h5>
	   </div>
	</div>
</div>
<div class='col-4'></div>
</div>

<!-- fin de toast -->\n\n";
}
?>

<!-- *************- MAIN *************--> 
<main style='background-color:#ffeeca'>

<!-- ************ HEADER *************-->
<header class='p-0 m-0 ' style='color: #ffeeca; background-color:#584D46'>
<div class='col-1'></div>
<div class='col-3'><div class='marca bagde-pill bertateka <?=$baseclass; ?>th'>Bertateka</div></div>
<div class='col-4'>Biblioteca escolar del CEIP Berta Wilhelmi</div>
<div class='col-3 '></div>
<div class='col-1 '>
	<span class='badge badge-pill <?php echo $baseclass; ?>th'>
		<a href='login.php'><img src='inc/login.png' class='p-1 pl-2 pr-2'></a>
	</span>
</div>
</header><!-- FIN HEADER -->
<?php
if ($mimensaje!='0') draw_toast($mimensaje,'aviso',$st_accion, $baseclass);
?>
<!-- EMPIEZA container -->
<div class='container'>
    
<!-- EMPIEZA mainbox -->
<div  style='margin-top:20px;'	class='mainbox  mx-auto'>
    

