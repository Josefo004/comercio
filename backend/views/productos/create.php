<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Nuevo Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 
        'aGeneros' => $aGeneros,
        'aProductos' => $aProductos,
    ]) ?>

</div>
