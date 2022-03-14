<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;

/*$this->title = 'Materiallager';
$this->params['breadcrumbs'][] = $this->title;*/

$data = $viewData["data"];

$view = "search_lagerort_table";

?>

<div class="container">

    <?= $this->render($view,
        array(
            "data"=>$data
        )
    ) ?>

</div>
