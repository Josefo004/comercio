<div class="card border-info  h-100 w-75">
    <a href="<?php echo \yii\helpers\Url::to(['/carrito/index','id'=>$model->IdProducto]) ?>" class="img-wrapper" >
        <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" >
    </a>
    <div class="card-body">
        <h5 class="card-title">
            <a href="<?php echo \yii\helpers\Url::to(['/carrito/index','id'=>$model->IdProducto]) ?>" class="text-dark"><?php echo $model->NombreProducto ?></a>
        </h5>
        <table cellpadding = '10px' cellspacing="5px" class="table" width='50%'>
        <tr>
            <td class="table-success"><h6><?php echo Yii::$app->formatter->asCurrency($model->Precio) ?></h6>
                <span class='badge badge-success'> Precio <br> Normal</span>
            </td>
            <td class="table-warning">
                    <h6><?php echo Yii::$app->formatter->asCurrency($model->PrecioPreventa) ?></h6> 
                    <span class='badge badge-warning'>Venta<br> Anticipada</span>
            </td>
            <td class="table-info">
                <h6><?php echo Yii::$app->formatter->asCurrency($model->PrecioReserva) ?></h6>
                <span class='badge badge-info'>Precio <br> Reserva</span>
            </td>
        </tr>
        </table>
        <div class="card-text">
            <?php echo $model->getShortDescription() ?>
        </div>
    </div>
</div>