<?php

use yii\helpers\Html;
use yii\helpers\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

?>

<div class="container">

    <div class="row">
        <h4>Welches Material möchten Sie entnehmen.</h4>
        <hr class="my-4">
    </div>

    <div class="form-group">        
        <label for="werkstoff" class="control-label col-xs-2">Prüfzeichen</label>
        <div class="col-xs-3">
            <select required class="form-control select2" id="entnehmen_available_pz"></select>
        </div><br>
    </div>

    <div class="row">
        <hr class="my-4"><br>
        <h4>Übersicht</h4>
        <hr class="my-4">
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-6">
            <label class="control-label col-md-4">Prüfzeichen:</label>
                <p class="form-control-static" id="entnehmen_pz_txt"> </p><br>
            <label class="control-label col-md-4">Normbezeichnung:</label>
                <p class="form-control-static" id="entnehmen_designation_txt"></p><br>
            <label class="control-label col-md-4">Werkstoffnummer:</label>
                <p class="form-control-static" id="entnehmen_werkstoffnummer"></p><br>
            <label class="control-label col-md-4">Trivialname 1:</label>
                <p class="form-control-static" id="entnehmen_trivialname1_txt"></p><br>
            <label class="control-label col-md-4">Trivialname 2:</label>
                <p class="form-control-static" id="entnehmen_trivialname2_txt"></p><br>
            <label class="control-label col-md-4">Trivialname 3:</label>
                <p class="form-control-static" id="entnehmen_trivialname3_txt"></p><br>
            <label class="control-label col-md-4">Werkstoffzustand:</label>
                <p class="form-control-static" id="entnehmen_Werkstoffzustand_txt"></p><br>
        </div>
        <div class="col-md-6 col-xs-6">
            <label class="control-label col-md-4">Schweißverbindung:</label>
                <p class="form-control-static" id="entnehmen_weld_mat_txt"></p><br>
            <label class="control-label col-md-4">Grundwerkstoff 2:</label>
                <p class="form-control-static" id="entnehmen_grundwerkstoff_pz_weld2"> </p><br>
            <label class="control-label col-md-4">Schweiße:</label>
                <p class="form-control-static" id="entnehmen_scheisse_pz_weld3"> </p><br>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4">Angelegt von:</label>
                <p class="form-control-static" id="entnehmen_angelegt_txt"></p><br>
            <label class="control-label col-md-4">Lieferant:</label>
                <p class="form-control-static" id="entnehmen_lieferant_txt"></p><br>
        </div>
    </div>
</div>