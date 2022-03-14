<?php

use yii\helpers\Html;
use yii\helpers\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

?>

<div class="container">
    
    <div class="row">
        <h4>Bitte geben Sie das entsprechende Prüfzeichen ein, zu welchem Sie ein Urteil anlegen möchten.</h4>
        <hr class="my-4">
    </div>

    <div class="form-group">        
        <label for="werkstoff" class="control-label col-xs-2">Prüfzeichen</label>
        <div class="col-xs-3">
            <select required class="form-control select2" name="availablepz" id = "availablepz"></select>
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
            <p class="form-control-static" id="pz_txt"> </p><br>
            <label class="control-label col-md-4">Normbezeichnung:</label>
            <p class="form-control-static" id="standard_designation_txt"> </p><br>
            <label class="control-label col-md-4">Werkstoffnummer:</label>
            <p class="form-control-static" id="werkstoffnummer"></p><br>
            <label class="control-label col-md-4">Trivialname 1:</label>
            <p class="form-control-static" id="trivialname1_txt"></p><br>
            <label class="control-label col-md-4">Trivialname 2:</label>
            <p class="form-control-static" id="trivialname2_txt"></p><br>
            <label class="control-label col-md-4">Trivialname 3:</label>
            <p class="form-control-static" id="trivialname3_txt" > </p><br>
            <label class="control-label col-md-4">Werkstoffzustand:</label>
            <p class="form-control-static" id="Werkstoffzustand_txt" > </p><br>
        </div>
        <div class="col-md-6 col-xs-6">
            <label class="control-label col-md-4">Schweißverbindung:</label>
            <p class="form-control-static" id="weld_mat_txt" > </p><br>
            <label class="control-label col-md-4">Grundwerkstoff 2:</label>
            <p class="form-control-static" id="grundwerkstoff_pz_weld2"> </p><br>
            <label class="control-label col-md-4">Schweiße:</label>
            <p class="form-control-static" id="scheisse_pz_weld3"></p><br>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-md-6">
            <label class="control-label col-md-4">Angelegt von:</label>
            <p class="form-control-static" id="angelegt_txt"></p><br>
            <label class="control-label col-md-4">Lieferant:</label>
            <p class="form-control-static" id="lieferant_txt"></p><br>
        </div>
    </div>

</div>