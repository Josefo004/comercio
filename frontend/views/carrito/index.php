<?php

?>
<div class="card mb-3" >
<div class="row g-0">
  <div class="col-md-4">
    <img src="<?php echo $producto->getImageUrl() ?>" class="img-fluid rounded-start" alt="...">
  </div>
  <div class="col-md-8">
    <div class="card-body">
      <h5 class="card-title"><?=$producto->NombreProducto ?></h5>
    
    <?php 
    
        foreach ($detalleTallas as $detalleTalla)
        {
            echo "<br>";
            foreach($detalleTalla as $opciones)
            {
                $id=$opciones->IdTalla;
                echo <<<HTML
                <input type="radio" class="btn-check" name= 'Talla{$id}' id="btn-check-{$opciones->Opcion}" autocomplete="off">
                <label class="btn btn-outline-primary" for="btn-check-{$opciones->Opcion}">{$opciones->Opcion}</label>
HTML;
            }
        }
        
    ?>
        Cantidad : 
      <p class="card-text"><?=$producto->Descripcion ?></p>
      <p class="card-text"><small class="text-muted"><?= $producto->FechaHoraActualizacion ?></small></p>
    </div>
  </div>
</div>
</div>