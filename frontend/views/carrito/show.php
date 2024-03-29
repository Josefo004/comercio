<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Productos a Ordenar';

$carrito = Yii::$app->session->get('carrito');
//dd($carrito);
$total = array_sum(array_column($carrito, 'Total'));

$comi = number_format($comision,2) ;
$total = number_format($total, 2);
$totalG = $total + $comi;
$totalG = number_format($totalG, 2);
//dd($comi);

$script = <<<JS
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
	<div class="card mb-3">
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
									<?= $form->field($modeloOrden, 'IdPersona')->textInput(['class' => 'form-control form-control-sm', 'autocomplete' => 'off']) ?>
								</div>
								<div class="col-md-5">
									<?= $form->field($modeloOrden, 'Celular')->textInput(['class' => 'form-control form-control-sm', 'autocomplete' => 'off']) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<?= $form->field($modeloOrden, 'Email')->textInput(['class' => 'form-control form-control-sm', 'autocomplete' => 'off']) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<?= $form->field($modeloOrden, 'NombreCompleto')->textInput(['style' => 'text-transform: uppercase', 'class' => 'form-control form-control-sm', 'autocomplete' => 'off']) ?>
									<!-- <?= $form->field($modeloOrden, 'Confirmar')->checkbox(['checked' => true,'uncheck' => null])->label("Comisión $comi Bs.");?>  -->
									<?= $form->field($modeloOrden, 'CodigoUsuario')->hiddenInput()->label(false) ?>
									<?= $form->field($modeloOrden, 'TotalOrden')->hiddenInput(['value' => $total])->label(false) ?>
									<?= $form->field($modeloOrden, 'Confirmar')->hiddenInput(['value' => true])->label(false) ?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<?php Modal::begin([
											'title' => 'Confirmación',
											'id' => 'myModalSiNo',
											'size' => yii\bootstrap4\Modal::SIZE_LARGE, // Tamaño grande del modal
											'bodyOptions' => ['class' => 'modal-body-custom'],
											'options' => ['class' => 'modal-dialog-custom'],

										]);

										?>
										<div class="modal-body overflow-auto">
											<div class="row">
												<div class="col-md-2"></div>
												<div class="col-md-10 mb-3 form-check">
													<?= $form->field($modeloOrden, 'Confirmar')->checkbox([
														'checked' => false,
														'uncheck' => null,
													]); ?> <?= $comi; ?>
												</div>
												
											</div>
										</div>

										<div class="modal-footer">
											<?= Html::submitButton('Consolidar Pedido <i class="fa fa-cart-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success']) ?>
										</div>

									<?php Modal::end(); ?>
									<!-- <?= Html::button('Hacer Pedido <i class="fa fa-cart-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success', 'onclick' => "$('#myModalSiNo').modal('show')" ]); ?> -->
									<?= Html::submitButton('Consolidar Pedido <i class="fa fa-cart-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success']) ?>
								</div>
							</div>
							<?php ActiveForm::end(); ?>
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
									<tr>
										<td colspan="7" align="right">Total Productos</td>
										<td align="right">
											<strong><?= $total ?></strong>
										</td>
										<th></th>
									</tr>
									<tr>
										<td colspan="7" align="right">Comisión Bancaria</td>
										<td align="right">
											<strong><?= $comi ?></strong>
										</td>
										<th></th>
									</tr>
									<tr>
										<td colspan="7" align="right">Total a Pagar</td>
										<td align="right">
											<strong><?= $totalG ?></strong>
										</td>
										<th></th>
									</tr>
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

