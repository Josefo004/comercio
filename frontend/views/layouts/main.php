<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

// use yii\bootstrap5\Button;
use yii\bootstrap5\Modal;
// use yii\helpers\Url;

AppAsset::register($this);
$sGeneros = Yii::$app->session->get('sGeneros');
$sProductos = Yii::$app->session->get('sProductos');
$hayCarrito = isset($_SESSION['carrito']) ? true : false;
//dd($sGeneros);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<?php
    $this->registerCssFile(Yii::getAlias('@web/css/micss.css')); //archivo CSS personalizado
?>  
</head>
<body class="d-flex flex-column h-100" style="padding-top:70px">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
        [
            'label' => 'Producto Para',
            //'items' => $this->params['aGeneros'],
            'items' => $sGeneros,
        ],
        [
            'label' => 'Tipo Producto',
            //'items' => $this->params['aProductos'],
            'items' => $sProductos,
        ],
        // ['label' => 'Acerca de', 'url' => ['/site/about']],
        // ['label' => 'Contacto', 'url' => ['/site/contact']],
        
    ];
    // if (Yii::$app->user->isGuest) {
    //     $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    // }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    if ($hayCarrito) {
        echo Html::button('<span class="fa fa-shopping-cart"></span>', [
            'class' => 'btn btn-outline-secondary btn-sm d-flex', 
            'onclick' => "$('#myModalCarritoDerecha').modal('show')"
        ]);
    }

    // if (Yii::$app->user->isGuest) {
    //     echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    // } else {
    //     echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
    //         . Html::submitButton(
    //             'Logout (' . Yii::$app->user->identity->Login . ')',
    //             ['class' => 'btn btn-link logout text-decoration-none']
    //         )
    //         . Html::endForm();
    // }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <!-- <br><br><br> -->
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start"> <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"> Desarrollado por &copy;<strong>DTIC</strong></p>
    </div>
</footer>

<?php $this->endBody() ?>
<?php
Modal::begin([
    // 'title' => 'Modal a la Derecha',
    'id' => 'myModalCarritoDerecha',
    'closeButton' => false,
    'size' => 'md',
    // 'bodyOptions' => ['class' => 'modal-body'],
    'options' => ['class' => 'modal modal-right'],
]);
?>
    <div class="modal-body">
        <?php
        if ($hayCarrito) {
            $carrito = Yii::$app->session->get('carrito');
            $total = array_sum(array_column($carrito, 'Total'));
            $total = number_format($total,2);
            $i = 0;
            ?>
            <div class="row mb-2 border border-dark rounded bg-secondary text-white text-center">
                <div class="col-md-12 pr-1 p-1"><strong>MI CARRITO <span class="fa fa-shopping-cart"></span></strong></div>
            </div>
            <?php
            foreach ($carrito as $key => $item): 
                $i++;
                //echo $item['CodigoProducto'].'<br>';
            ?>
            <div class="row mb-2 border border-secondary rounded">
                <div class="col-md-4 m0 p0">
                    <picture>
                        <?= Html::img($item['Imagen'], ['class' => 'img-fluid'])?>
                    </picture>
                </div>
                <div class="col-md-8 m0 p0">
                    <p>
                        <strong><?= $item['NombreProducto'] ?></strong><br>
                        <small><?= $item['ProductoPara'] ?> <small><?= $item['Talla'] ?></small></small><br>
                    <small>
                        <strong>Precio </strong>Bs.<?= $item['Precio'] ?> <br>
                        <strong>Cantidad </strong><?= $item['Cantidad'] ?> 
                        <strong>Total </strong>Bs.<?= $item['Total'] ?><br>
                        <?= Html::a('<span class="fa fa-trash-o"></span> Quitar', ['/carrito/eliminar', 'id' => $key], [
                            'class' => 'btn btn-outline-danger btn-sm',
                            'data' => [
                                'confirm' => '¿Estás seguro de que quieres eliminar este elemento del Carrito?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </small></p>
                </div>
            </div>
            <?php
            endforeach;
            ?>
            <div class="row mb-2 border border-dark rounded bg-dark text-white text-right">
                <div class="col-md-12 pr-3 p-1">
                    Total: <strong>Bs. <?= $total ?></strong> 
                </div>
            </div>
            <div class="row mb-2 float-left">
                <?=Html::a('<span class="fa fa-file-text-o"></span> Realizar la Orden', ['/carrito/show'], ['class' => 'btn btn-success btn-sm']);?>
            </div>
            <?php
        }
        ?>
    </div>
<?php 
Modal::end(); 

?>
</body>
</html>
<?php $this->endPage();
