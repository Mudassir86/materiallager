<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Warehouse Management System</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <link href="<?=Url::base()?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=Url::base()?>/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
     <link href="<?=Url::base()?>/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?=Url::base()?>/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?=Url::base()?>/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css">
    <link href="<?=Url::base()?>/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css">
    <link href="<?=Url::base()?>/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />    
    
    
   
    <link href="<?=Url::base()?>/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?=Url::base()?>/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=Url::base()?>/css/site.css" rel="stylesheet" type="text/css" />


    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Header -->
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Warehouse Management System',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

// Navbar widget left
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
/*            ['label' => 'Home', 'url' =>  ['/site/index']],*/
/*            ['label' => 'Category', 'url' => ['/category/index']],
            ['label' => 'Jobs', 'url' => ['/job/index']],*/
        ],
    ]);

// Navbar widget right
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' .Yii::$app->user->identity->forename.' '.Yii::$app->user->identity->surname. ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
             //['label' => 'Register', 'url' => ['/user/register']]
        ],
    ]);
    NavBar::end();
    ?>

<!--  Page Content -->
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Home', 'url' => ['/site/main']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; www.mpa-ifw.tu-darmstadt.de</p>

        <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<!-- BEGIN CORE PLUGINS -->

        <script src="<?=Url::base()?>/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>



        <script src="<?=Url::base()?>/plugins/datatable.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/moment.min.js" type="text/javascript"></script>

        <script src="<?=Url::base()?>/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.de.min.js" type="text/javascript"></script>
        
        <script src="<?=Url::base()?>/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/select2/js/i18n/de.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
        
        <script src="<?=Url::base()?>/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="<?=Url::base()?>/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>

        <script src="<?=Url::base()?>/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.js"></script>
    <!--<script src="<?=Url::base()?>/plugins/pdfThumbnails/pdf.js"></script>
        <script src="<?=Url::base()?>/plugins/pdfThumbnails/pdf.worker.js"></script>
        <script src="<?=Url::base()?>/plugins/pdfThumbnails/pdfThumbnails.js"></script>-->




<script type="text/javascript">

    $(".numeric, .price").live("keypress keyup",function (event) {

        //this.value = this.value.replace(/[^0-9\.]/g,'');

        $(this).val($(this).val().replace(/[^0-9\,]/g,''));
        if (event.which!=8 && event.which!=9 && (event.which != 44 || $(this).val().indexOf(',') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(".number").live("keypress keyup",function (event)
    {

        $(this).val($(this).val().replace(/[^\d].+/, ""));

        if (event.which!=8 && event.which!=9 && event.which!=0 && (event.which < 48 || event.which > 57))
        {
            event.preventDefault();
        }
    });


    </script>

<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
