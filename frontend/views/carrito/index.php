<?php
$precio = 0;
switch ($tprecio) {
  case 'pn':
    $precio = Yii::$app->formatter->asCurrency($producto->Precio);
    break;
  case 'pp':
    $precio = Yii::$app->formatter->asCurrency($producto->PrecioPreventa);
    break;
  case 'pr':
    $precio = Yii::$app->formatter->asCurrency($producto->PrecioReserva);
    break;
}
$genero = ($producto->IdCategoriaGenero!=1)?" - ".$producto->idCategoriaGenero->Descripcion:"";
?>
<div class="card mb-3" >
<div class="row g-0">
  <div class="col-md-4">
    <img src="<?php echo $producto->getImageUrl() ?>" class="img-fluid rounded-start" alt="<?=$producto->NombreProducto ?>">
  </div>
  <div class="col-md-8">
    <div class="card-body">
      <div class="row">
        <div class="col-md-7 border border-dark rounded-sm p-2 m-1 bg-secondary text-white">
          <small><strong><?= $producto->CodigoProducto?></strong> <?= $genero?> </small> <?=$producto->NombreProducto ?>
        </div>
        <div class="col-md-4 border border-dark rounded-sm p-2 m-1 bg-danger text-white"> <strong><?= $precio ?></strong></div>
      </div>
      <div class="row">
        <div class="col-md-11 p-1 m-1"><?=$producto->Descripcion ?></div>
        <p class="card-text"><small class="text-muted"><?= $producto->idCategoriaGenero->Descripcion ?></small></p>
      </div>
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
      <
      <p class="card-text"><small class="text-muted"><?= $producto->FechaHoraActualizacion ?></small></p>
    </div>
  </div>
</div>
</div>