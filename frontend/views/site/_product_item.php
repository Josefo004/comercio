<?php
date_default_timezone_set('America/La_Paz');
$fechaa = date('Y-m-d');
$fechapv = $model->FechaCaducidadPreVenta;
$fechare = $model->FechaCaducidadReserva;
$valFePre = (strtotime($fechapv)>=strtotime($fechaa))?"S":"N";
$valFeRes = (strtotime($fechare)>=strtotime($fechaa))?"S":"N";
$genero = ($model->IdCategoriaGenero!=1)?" - ".$model->idCategoriaGenero->Descripcion:"";
//dd($valFePre)
?>
<div class="card border-dark  h-100 w-100">
    <div class="card-header">
        <small>Código: <strong><?= $model->CodigoProducto?></strong> <?= $genero?> </small> 
    </div>
    <div class="card-body">
        <h6 class="card-title">
            <strong><?= $model->NombreProducto?> </strong> 
        </h6>
        <picture  class="img-wrapper">
            <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" >
        </picture>
        <table class="table table-sm">
            <tbody>
                <?php if (!empty($model->Precio)): ?>
                <tr>
                    <th scope="row"><?= yii\helpers\Html::a('Precio Normal: <b>'.Yii::$app->formatter->asCurrency($model->Precio).'</b>', ['/carrito/create','id'=>$model->IdProducto, 'tprecio'=>'pn'], ['class'=>'btn btn-success btn-sm btn-block text-left']) ?></th>
                </tr>
                <?php endif;?>
                <?php if (!empty($model->FechaCaducidadPreVenta) && ($valFePre==="S")): ?>
                <tr>
                    <th scope="row"><?= yii\helpers\Html::a('Precio Preventa: <b>'.Yii::$app->formatter->asCurrency($model->PrecioPreventa).'</b>', ['/carrito/create','id'=>$model->IdProducto, 'tprecio'=>'pp'], ['class'=>'btn btn-warning btn-sm btn-block text-left']) ?></th>
                </tr>
                <?php endif;?>
                <?php if (!empty($model->FechaCaducidadReserva) && ($valFeRes==="S")): ?>
                <tr>
                    <th scope="row"><?= yii\helpers\Html::a('Precio Reserva: <b>'.Yii::$app->formatter->asCurrency($model->PrecioReserva).'</b>', ['/carrito/create','id'=>$model->IdProducto, 'tprecio'=>'pr'], ['class'=>'btn btn-danger btn-sm btn-block text-left']) ?></th>
                </tr>
                <?php endif;?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <?php echo $model->getShortDescription() ?>
    </div>
</div>