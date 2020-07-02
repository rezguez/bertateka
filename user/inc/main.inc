
<!-- *************- MAIN *************--> 
<main style='background-color:#ffeeca'>

<!-- ************ HEADER *************-->
<header class='p-0 m-0 ' style='color: #ffeeca; background-color:#584D46'>
<div class='col-1'></div>
<div class='col-3'><div class='marca bagde-pill bertateka <?=$baseclass; ?>th'>Bertateka</div></div>
<div class='col-4'>Biblioteca escolar del CEIP Berta Wilhelmi</div>
<div class='col-3 '>
<?php 

    echo "<span class='badge badge-pill $baseclass"."th align-items-center'><i class='fa fa-user-circle p-0  pr-2' style='font-size:32px;''></i>"; 
    echo ($_SESSION['nombre']). "<span class='marca  $baseclass ml-2'>". $_SESSION['role'];
    echo "</span></div><div class='col-1'><span class='badge badge-pill $baseclass"."th'><a href='../logout.php'><i class='fas fa-power-off p-1 pl-2 pr-2 ' style='font-size:24px; color: #ffeeca;'></i></a></span> ";

?> 
</div>
</header><!-- FIN HEADER -->

<?php
if ($mimensaje!='0') draw_toast($mimensaje,'aviso',$st_accion, $baseclass);
?>
<!-- EMPIEZA container -->
<div class='container'>
    
<!-- EMPIEZA mainbox -->
<div  style='margin-top:20px;'	class='mainbox  mx-auto'>
    

