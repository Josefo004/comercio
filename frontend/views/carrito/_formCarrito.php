<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

$precio = 0; $validez = "";
switch ($tprecio) {
  case 'pn':
    $precio = Yii::$app->formatter->asCurrency($producto->Precio);
    $ppp = $producto->Precio;
    break;
  case 'pp':
    $precio = Yii::$app->formatter->asCurrency($producto->PrecioPreventa);
    $validez = " -- valido hasta: ".Yii::$app->formatter->asDate($producto->FechaCaducidadPreVenta, 'dd-MM-Y');
    $ppp = $producto->PrecioPreventa;
    break;
  case 'pr':
    $precio = Yii::$app->formatter->asCurrency($producto->PrecioReserva);
    $validez = " -- valido hasta: ".Yii::$app->formatter->asDate($producto->FechaCaducidadReserva, 'dd-MM-Y');
    $ppp = $producto->PrecioReserva;
    break;
}
$ppp = number_format($ppp,2);
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
        <div class="col-md-4 border border-dark rounded-sm p-2 m-1 bg-danger text-white"> <strong><?= $precio ?></strong> <small><?= $validez ?></small></div>
      </div>
      <div class="row">
        <div class="col-md-11 p-1 m-1"><?=$producto->Descripcion ?></div>
      </div>
      <hr>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
          <div class="col-md-11">
            <?= $form->field($modeloCarrito, 'Idtalla')->radioList($tallas, ['id' => 'tallas-list']) ?>
            <?= $form->field($modeloCarrito, 'IdProducto')->hiddenInput(['value'=> $producto->IdProducto])->label(false);?>
            <?= $form->field($modeloCarrito, 'CodigoProducto')->hiddenInput(['value'=> $producto->CodigoProducto])->label(false);?>
            <?= $form->field($modeloCarrito, 'ProductoPara')->hiddenInput(['value'=> $producto->idCategoriaGenero->Descripcion])->label(false);?>
            <?= $form->field($modeloCarrito, 'NombreProducto')->hiddenInput(['value'=> $producto->NombreProducto])->label(false);?>
            <?= $form->field($modeloCarrito, 'Talla')->hiddenInput(['value'=> ""])->label(false);?>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <?= $form->field($modeloCarrito, 'Cantidad')->textInput(['type' => 'number']) ?>
            <?= $form->field($modeloCarrito, 'Precio')->hiddenInput(['value'=> $ppp])->label(false);?>
            <?= $form->field($modeloCarrito, 'Precio')->hiddenInput(['value'=> $ppp])->label(false);?>
          </div>
          <div class="col-md-4">
            <?= $form->field($modeloCarrito, 'Total', ['inputOptions' => ['value' => number_format($modeloCarrito->Total, 2)]])->textInput(['readonly'=> true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <?= Html::submitButton('Añadir al Carrito <i class="fa fa-cart-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success']) ?>
          </div>
        </div>
        <?php 
          ActiveForm::end(); 

          $this->registerJs(
            new JsExpression("
              $(document).ready(function(){
                $('#carritoform-cantidad').on('change', function(){
                  var valor = $(this).val();
                  var vv = 0;
                  if ((valor>0)&&(valor<11)){
                    vv = $('#carritoform-precio').val() * valor;
                  }
                  $('#carritoform-total').val(vv.toFixed(2));
                });

                $(document).ready(function(){
                  $('#tallas-list input[type=\"radio\"]').click(function(){
                      var textoSeleccionado = $(this).next('label').text();
                      console.log(\"Texto seleccionado: \" + textoSeleccionado);
                      $('#carritoform-talla').val(textoSeleccionado);
                  });
              });

              });
            ")
        );
        ?>
        
      <!-- <p class="card-text"><small class="text-muted"><?= $producto->FechaHoraActualizacion ?></small></p> -->
    </div>
  </div>
</div>
</div>