<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;

/*$this->title = 'Materiallager';
$this->params['breadcrumbs'][] = $this->title;*/

?>

<div class="container">
    <div class="row">
        <div class="col-md-2">

        </div>

    <form id="main_search_form" method="POST" action="main-search-info">
        <div class="col-md-2" style="padding-right: 0px; padding-left: 0px">
            <select id="main_search_category" name="search_category" class="form-control  btn-primary">
                <option <?=($search_category == "prufzeichen") ? "selected" : ""?> value="prufzeichen">Prüfzeichen</option>
                <option <?=($search_category == "werkstoffe") ? "selected" : ""?> value="werkstoffe">Werkstoffe</option>
                <option <?=($search_category == "lagerort") ? "selected" : ""?> value="lagerort">Lagerort</option>
                <option <?=($search_category == "urteile") ? "selected" : ""?> value="urteile">Urteile</option>
                <option <?=($search_category == "halbzeuge") ? "selected" : ""?> value="halbzeuge">Halbzeuge</option>
                <option <?=($search_category == "rohlinge") ? "selected" : ""?> value="rohlinge">Rohlinge</option>
                <option <?=($search_category == "auftrag") ? "selected" : ""?> value="auftrag">Auftrag</option>
            </select>
        </div>
        <div class="col-md-5" style="padding-right: 0px; padding-left: 0px">
           <!-- <input type="text" class="form-control" name="search_value" value="<?=$search_value?>" id="main_search_text" placeholder="Suche">-->

            <select class="form-control" name="search_value" id="main_search_text_sel">
                <option value="<?=$search_value?>" selected><?=$search_value?></option>
            </select>
        </div>


    </form>

        <div class="col-md-2" style="padding-right: 0px; padding-left: 0px">
            <button class="btn btn-success" id="main_search_btn" >
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Suche</button>
        </div>


</div>

<hr class="my-4">

<div>
    <?= $this->render($view,
        array(
            "viewData"=>$viewData
        )
    ) ?>
</div>

</div>

