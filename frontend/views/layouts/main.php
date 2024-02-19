<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

use yii\bootstrap5\Button;
use yii\bootstrap5\Modal;
use yii\helpers\Url;

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
    if ($hayCarrito) {
        //echo Html::a(' <span class="fa fa-shopping-cart"></span>', ['/carrito/show'], ['class' => 'btn btn-outline-secondary btn-sm']);
        echo Html::button('<span class="fa fa-shopping-cart"></span>', [
            'class' => 'btn btn-primary', 
            'data' => [
                'target' => '#modalCarrito', // ID del modal
                'remote' => Url::to(['/carrito/carrito']),
            ],
            //'id' => 'btn-abrir-modal', 
            'onclick' => "$('#myModalCarritoDerecha').modal('show')"
        ]);
        // echo Button::widget([
        //     'label' => 'Abrir Modal',
        //     'options' => [
        //         'class' => 'btn btn-primary',
        //         'data' => [
        //             'toggle' => 'modal',
        //             'target' => '#myModal', // ID del modal
        //             'remote' => Url::to(['controller/action']), // URL de la acción que renderiza la vista del modal
        //         ],
        //     ],
        // ]);
    }
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
        ['label' => 'Acerca de', 'url' => ['/site/about']],
        ['label' => 'Contacto', 'url' => ['/site/contact']],
        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->Login . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
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
    'bodyOptions' => ['class' => 'modal-body'],
    'options' => ['class' => 'modal modal-right'],
]);
?>
    <div id="modalCarrito" class="modal-body">
      
    </div>
<?php 
Modal::end(); 

?>
</body>
</html>
<?php $this->endPage();
