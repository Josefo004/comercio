<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Actualizar Producto: ' . $model->IdProducto;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->IdProducto, 'url' => ['view', 'IdProducto' => $model->IdProducto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'aGeneros' => $aGeneros,
        'aProductos' => $aProductos,
        'tallas' => $tallas,
    ]) ?>

</div>
