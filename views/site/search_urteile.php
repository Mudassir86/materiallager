<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;

/*$this->title = 'Materiallager';
$this->params['breadcrumbs'][] = $this->title;*/


$isTable = ($viewData['isTable'] == 1) ? true : false;
$data = $viewData["data"];

$view = ($isTable) ? "search_urteile_table" : "search_urteile_single";

?>

<div class="container">

    <?= $this->render($view,
        array(
            "data"=>$data
        )
    ) ?>

</div>