<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Productos a Ordenar';
// $this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$carrito = Yii::$app->session->get('carrito');
//dd($carrito);
$total = array_sum(array_column($carrito, 'Total'));
$total = number_format($total,2);

$script = <<< JS
$(document).ready(function() {
    $('#ordenform-idpersona').on('change', function() {
        var idPersona = $(this).val();
        
        // Realizar la solicitud AJAX
        $.ajax({
            //url: 'http://localhost:3000/api/v0/personas/'+idPersona, // Reemplaza 'url-de-tu-api-rest/buscar' con la URL de tu API REST
            url: 'http://172.16.1.251/consultasapi/v0/personas/'+idPersona,
            method: 'GET',
            //data: { idPersona: idPersona },
            success: function(response) {
                // Rellenar los campos con la respuesta
                console.log(response);
                (response.IdPersona!="")?$('#ordenform-idpersona').val(response.IdPersona):$('#ordenform-idpersona').val(idPersona);
                $('#ordenform-celular').val(response.Celular);
                $('#ordenform-email').val(response.Email);
                $('#ordenform-nombrecompleto').val(response.NombreCompleto);
                $('#ordenform-codigousuario').val(response.CodigoUsuario);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Manejar errores aquí
            }
        });
    });
});
JS;

$this->registerJs($script);


?>
<div>
    <div class="card mb-3" > 
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                    <div class="card-header">
                        Datos del Solicitante
                    </div>  
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col-md-7">
                                <?= $form->field($modeloOrden, 'IdPersona')->textInput(['class' => 'form-control form-control-sm']) ?>
                            </div>
                            <div class="col-md-5">
                                <?= $form->field($modeloOrden, 'Celular')->textInput(['class' => 'form-control form-control-sm']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?= $form->field($modeloOrden, 'Email')->textInput(['class' => 'form-control form-control-sm']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?= $form->field($modeloOrden, 'NombreCompleto')->textInput(['style' => 'text-transform: uppercase', 'class' => 'form-control form-control-sm']) ?>
                                <?= $form->field($modeloOrden, 'CodigoUsuario')->hiddenInput()->label(false) ?>
                                <?= $form->field($modeloOrden, 'TotalOrden')->hiddenInput(['value'=>$total])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?= Html::submitButton('Consolidar Pedido <i class="fa fa-cart-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end();?>
                    </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                    <div class="card-header">
                        <?= Html::encode($this->title) ?>
                    </div>  
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Talla</th>
                                    <th>Para</th>
                                    <th>Nombre Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 0;
                                    foreach ($carrito as $key => $item): 
                                    $i++;
                                ?>
                                    <tr>
                                        <th><?= $i ?></th>
                                        <td><?= $item['CodigoProducto'] ?></td>
                                        <td><?= $item['Talla'] ?></td>
                                        <td><?= $item['ProductoPara'] ?></td>
                                        <td><?= $item['NombreProducto'] ?></td>
                                        <td><?= $item['Precio'] ?></td>
                                        <td><?= $item['Cantidad'] ?></td>
                                        <td><?= $item['Total'] ?></td>
                                        <td>
                                            <?= Html::a('<span class="fa fa-trash-o"></span>', ['eliminar2', 'id' => $key], [
                                                'class' => 'btn btn-danger btn-sm',
                                                'data' => [
                                                    'confirm' => '¿Estás seguro de que quieres eliminar este elemento de la orden?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                <th><?= $total ?></th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>   
                    </div>
                </div>
            </div>
        </div> 
        <div class="card-footer">
            <div class="col-md-12 text-right">
                <?= Html::a('<span class="fa fa-home"></span> Página Principal', ['site/index'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

</div>