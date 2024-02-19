<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\bootstrap5\Modal;

use yii\grid\GridView;
use yii\data\ArrayDataProvider;

use yii\web\View;

if ($modal==1) {
  $this->registerJs("
    $(document).ready(function() {
        $('#myModalCarritoDerecha').modal('show');
    });
    ", View::POS_READY);
}

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
$this->registerJs("
  $(document).on('ready pjax:success', function() {
    $('#myModalCarritoDerecha').modal('show');
  });
", View::POS_READY);
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
          <div class="col-md-7">
            <?= $form->field($modeloCarrito, 'Idtalla')->radioList($tallas, ['id' => 'tallas-list']) ?>
            <?= $form->field($modeloCarrito, 'IdProducto')->hiddenInput(['value'=> $producto->IdProducto])->label(false);?>
            <?= $form->field($modeloCarrito, 'CodigoProducto')->hiddenInput(['value'=> $producto->CodigoProducto])->label(false);?>
            <?= $form->field($modeloCarrito, 'ProductoPara')->hiddenInput(['value'=> $producto->idCategoriaGenero->Descripcion])->label(false);?>
            <?= $form->field($modeloCarrito, 'NombreProducto')->hiddenInput(['value'=> $producto->NombreProducto])->label(false);?>
            <?= $form->field($modeloCarrito, 'Imagen')->hiddenInput(['value'=> $producto->getImageUrl()])->label(false);?>
            <?= $form->field($modeloCarrito, 'Talla')->hiddenInput(['value'=> ""])->label(false);?>
          </div>
          <div class="col-md-4">
            <?= Html::button('Guia de Tallas', ['id' => 'modalButton', 'class' => 'btn btn-info', 'onclick' => "$('#myModal').modal('show')" ]) ?>
            <!-- <?= Html::button('Abrir Modal', ['class' => 'btn btn-primary', 'id' => 'btn-abrir-modal', 'onclick' => "$('#myModalDerecha').modal('show')"]) ?> -->
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

<?php Modal::begin([
    'title' => 'Guia de Tallas '. $genero,
    'id' => 'myModal',
    'size' => yii\bootstrap4\Modal::SIZE_LARGE, // Tamaño grande del modal
    'bodyOptions' => ['class' => 'modal-body-custom'],
    'options' => ['class' => 'modal-dialog-custom'],
    // Otras opciones de configuración si es necesario
]); 

$urlimg = Yii::$app->urlManager->baseUrl . '/img/tallas_guia.png';

/** Array de tallas */
$tallad = [
  ['Talla'=>'14', 'Pecho-Axila'=>'44 cm', 'Largo'=>'57 cm', 'Espalda-Hombro'=>'35.5 cm'],
  ['Talla'=>'S', 'Pecho-Axila'=>'46 cm', 'Largo'=>'61 cm', 'Espalda-Hombro'=>'37.5 cm'],
  ['Talla'=>'M', 'Pecho-Axila'=>'50 cm', 'Largo'=>'65 cm', 'Espalda-Hombro'=>'40.5 cm'],
  ['Talla'=>'L', 'Pecho-Axila'=>'52 cm', 'Largo'=>'68 cm', 'Espalda-Hombro'=>'42.5 cm'],
  ['Talla'=>'XL', 'Pecho-Axila'=>'55 cm', 'Largo'=>'72 cm', 'Espalda-Hombro'=>'43.5 cm'],
  ['Talla'=>'XXL', 'Pecho-Axila'=>'58 cm', 'Largo'=>'74 cm', 'Espalda-Hombro'=>'46.5 cm'],
];

$tallav = [
  ['Talla'=>'S', 'Pecho-Axila'=>'48 cm', 'Largo'=>'63 cm', 'Espalda-Hombro'=>'37.5 cm'],
  ['Talla'=>'M', 'Pecho-Axila'=>'52 cm', 'Largo'=>'67 cm', 'Espalda-Hombro'=>'40.5 cm'],
  ['Talla'=>'L', 'Pecho-Axila'=>'54 cm', 'Largo'=>'70 cm', 'Espalda-Hombro'=>'42.5 cm'],
  ['Talla'=>'XL', 'Pecho-Axila'=>'56 cm', 'Largo'=>'73 cm', 'Espalda-Hombro'=>'43.5 cm'],
  ['Talla'=>'XXL', 'Pecho-Axila'=>'59 cm', 'Largo'=>'75 cm', 'Espalda-Hombro'=>'46.5 cm'],
  ['Talla'=>'XXXL', 'Pecho-Axila'=>'63 cm', 'Largo'=>'78 cm', 'Espalda-Hombro'=>'47.5 cm'],
];

$gtallas = [];
switch ($producto->IdCategoriaGenero) {
  case 2:
    $gtallas = $tallad;
    break;
  case 3:
    $gtallas = $tallav;
    break;
}

$dataProvider = new ArrayDataProvider([
  'allModels' => $gtallas,
  'pagination' => false,
]);

?>

<div class="modal-body overflow-auto">
  <div class="row">
    <div class="col">
      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'showFooter' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Talla',
            [
              'label' => 'Pecho',
              'attribute' => 'Pecho-Axila',
            ],
            'Largo',
            [
              'label' => 'Espalda',
              'attribute' => 'Espalda-Hombro',
            ],
        ],
        'options' => [
          'class' => 'table-sm',
        ],
      ]); 
      ?>
    </div>
    <div class="col">
      <img src="<?= $urlimg ?>" class="img-fluid rounded" alt="guia de tallas">
    </div>
  </div>
 
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <!-- Puedes agregar más botones aquí si lo deseas -->
</div>

<?php Modal::end(); ?>

<?php
Modal::begin([
    // 'title' => 'Modal a la Derecha',
    'id' => 'myModalDerecha',
    'closeButton' => false,
    'size' => 'md',
    'bodyOptions' => ['class' => 'modal-body'],
    'options' => ['class' => 'modal modal-right'],
]);
?>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
          <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'showFooter' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'Talla',
                'Pecho-Axila',
                'Largo',
                'Espalda-Hombro',
            ],
            'options' => [
              'class' => 'table-sm',
            ],
          ]); 
          ?>
        </div>
        <div class="col-md-6">
          <img src="<?= $urlimg ?>" class="img-fluid rounded" alt="guia de tallas">
        </div>
      </div>

    </div>
<?php Modal::end(); ?>

