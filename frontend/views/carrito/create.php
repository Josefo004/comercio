<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Añadir al Carrito';
// $this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_formCarrito', [
        'producto' => $producto,
        'tallas' => $tallas,
        'tprecio' => $tprecio,
        'modeloCarrito' => $modeloCarrito,
    ]) ?>

</div>
