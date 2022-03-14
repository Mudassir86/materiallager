<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;

/*$this->title = 'Materiallager';
$this->params['breadcrumbs'][] = $this->title;*/
?>


<?php
	$msg = yii::$app->getSession()->getFlash('success');
	if (null !==$msg): ?>
	<div class="alert alert-success"> <?= $msg; ?>	</div>
	<?php endif; ?>

    <div class="row">
        <div class="jumbotron" style="background-color: transparent !important;">
            <h1 class="display-4">Materiallager</h1>
            <hr class="my-4">
            <p>Herzlich Willkommen!</p>
        </div>
    </div>


<div class="row">
    <div class="col-md-2">

    </div>

    <form id="main_search_form" method="POST" action="main-search" target="_blank">
        <div class="col-md-2" style="padding-right: 0px; padding-left: 0px">
            <select id="main_search_category" name="search_category" class="form-control  btn-primary">
                <option value="prufzeichen">Prüfzeichen</option>
                <option value="werkstoffe">Werkstoffe</option>
                <option value="lagerort">Lagerort</option>
                <option value="urteile">Urteile</option>
                <option value="halbzeuge">Halbzeuge</option>
                <option value="rohlinge">Rohlinge</option>
                <option value="auftrag">Auftrag</option>
            </select>
        </div>

        <div class="col-md-5" style="padding-right: 0px; padding-left: 0px">
            <select class="form-control" name="search_value" id="main_search_text_sel"></select>
        </div>

    </form>

    <div class="col-md-2" style="padding-right: 0px; padding-left: 0px">
        <button class="btn btn-success" id="main_search_btn">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Suche</button>
    </div>

</div>


    <div class="row">
  	    	<h3>Sie möchten…</h3>
        <div class="container">
            <div class="list-group" id="list-tab" role="tablist">

                <a class="list-group-item list-group-item-action" id="neuMaterial">…neues Material anlegen</a>
                <!--<a href="../info/index" class="list-group-item list-group-item-action" data-menu="neu_material" role="tab" aria-controls="neu_material">…ein neues Material anlegen</a>
                <a href="../fvwht/index" class="list-group-item list-group-item-action" data-attribute="test" role="tab">…ein neues Material für die Arbeitsgemeinschaft anlegen</a>-->
                <a href="../urteil/index" class="list-group-item list-group-item-action" data-attribute="test" role="tab">…neues Urteil anlegen</a>
                <a href="../entnehmen/index" class="list-group-item list-group-item-action" data-attribute="test" role="tab">…Material entnehmen</a>
                <a href="#" class="list-group-item list-group-item-action" data-attribute="test">…etwas umlagern</a>
                <a href="../site/print" class="list-group-item list-group-item-action lamdaMainMenu" data-attribute="test">…Aufkleber nachdrucken</a>
            </div><br>
        </div>
    </div>

<div id="materialOptionModal" class="modal fade"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 40%;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 0px">
                <h3 style="text-align: center">Material anlegan</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h4 style="text-align: center">Bitte wählen Sie die entsprechende Option</h4>
                </div>

                <div class="row text-center">
                    <a href="../info/index" type="button" class="btn btn-success">Industrie und Forschung außerhalb der FVWHT</a>
                </div>
                <br>
                <div class="row text-center">
                    <a href="../fvwht/index" type="button" class="btn btn-primary">Forschungsvereinigung Warmfeste Stähle und Hochtemperaturwerkstoffe (FVWHT)</a>
                </div>

            </div>
            <div class="modal-footer" style="padding: 5px">
                <div class="col text-center">
                    <button data-dismiss="modal" class="btn dark btn-outline">Abbrechen</button>
                </div>
            </div>
        </div>
    </div>
</div>
