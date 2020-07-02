<?php



function draw_toast($mimensaje, $idtoast = "aviso", $titulo = "ACCIÓN REALIZADA", $class = 'vin')
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