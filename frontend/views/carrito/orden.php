<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Orden Realizada';
dd($orden)
?>
<div>
    <div class="card mb-3">
        <div class="card-body">
            <fieldset disabled>
                <div class="row">
                <div class="col-md-2">
                    <label class="form-label">Nro. de Orden</label>
                    <input type="text" class="form-control" value="<?= $orden->IdOrden;?>">
                </div>
            </fieldset>

            </div>
        </div>
    </div>
    

</div>