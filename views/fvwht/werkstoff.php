<?php

use yii\helpers\Html;

$this->title = 'Werkstoff';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="row">
        <h4>Setzen Sie einen Haken, um auszuwählen welche Werkstoffbezeichnung auf Tafel IV erscheinen soll.</h4>
        <hr class="my-4" style="width: 68pc">
    </div>

    <div class="row">
        <h5>Werkstoffbezeichnungen:</h5>
    </div>

    <div class="row">
        <input type="hidden" name="material[pz_alt1]" id="fvwht_pz_alt" value="">
        <div class="col-sm-3">
            <label for="fvwht_normbezeichnung" class="control-label" style="text-align: left">Normbezeichnung</label>
            <input type="radio" class="mandatory" name="fvwht_radio_btn" value="fvwht_normbezeichnung">
            <input class="form-control col-sm-2 mandatory" type="text" id="fvwht_normbezeichnung" name="material[standard_designation]" placeholder="NiCr22Mo9Nb">
        </div>

        <div class="col-sm-3">
            <label for="Werkstoffnummer" class="control-label" style="text-align: left">Werkstoffnummer</label>
            <input type="radio" class="mandatory" name="fvwht_radio_btn" value="fvwht_werkstoffnummer">
            <input class="form-control col-sm-2 mandatory" type="text" id="fvwht_werkstoffnummer" name="material[material_number]" placeholder="2.4856">
        </div>

        <div class="col-sm-4">
            <label for="Werkstoffnummer" class="control-label" style="text-align: left">Trivialnamen</label>

            <div class="form-inline">
                <label for="trivialname1">1</label>
                <input type="radio" class="mandatory" name="fvwht_radio_btn" value="fvwht_trivialname1">
                <input class="form-control mandatory" type="text" id="fvwht_trivialname1" name="material[trivialname1]" placeholder="Alloy 625">
            </div>
            <br>
            <div class="form-inline">
                <label for="trivialname2">2</label>
                <input type="radio" class="mandatory" name="fvwht_radio_btn" value="fvwht_trivialname2">
                <input class="form-control mandatory" type="text" id="fvwht_trivialname2" name="material[trivialname2]" placeholder="IN 625">
            </div>
            <br>
            <div class="form-inline">
                <label for="trivialname3">3</label>
                <input type="radio" class="mandatory" name="fvwht_radio_btn" value="fvwht_trivialname3">
                <input class="form-control mandatory" type="text" id="fvwht_trivialname3" name="material[trivialname3]" placeholder="Ni 625">
            </div>
        </div>
    </div>

    <hr class="my-4" style="width: 68pc">

    <div class="row">
        <div class="col-md-4">
            <div class="form-inline">
                <label for="fvwht_werkstoffzustand" class="control-label" style="padding-right: 15px">Werkstoffzustand</label>
                <input class="form-control" id="fvwht_werkstoffzustand" name="material[mat_cond]" style="width: 12pc">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-inline">
                <label for="fvwht_schmelze" class="control-label col-md-3" style="padding-left: 15px; padding-right: 15px">Charge/Schmelze</label>
                <input class="form-control col-md-offset-1" id="fvwht_schmelze" name="material[cast_no]" style="width: 12pc;">
            </div>
        </div>
    </div>

    <hr class="my-4" style="width: 68pc">

    <div class="row">

        <div class="col-md-4">
            <input type="checkbox"  class="form-check-input" value="1" name="material[weld_mat]" id="fvwht_weld_mat">
            <label class="form-check-label" for="weld_mat"style="padding-left: 10px; padding-right: 15px">Schweißverbindung</label>
        </div>

        <div class="col-md-6">
            <div class="form-inline row">
                <label for="fvwht_pz_weld2" class="control-label col-md-3" style="padding-left: 15px; padding-right: 15px">Grundwerkstoff 2</label>
                <input class="form-control col-md-offset-1" name="material[pz_weld2]" id="fvwht_pz_weld2" disabled />
            </div><br>

            <div class="row form-inline">
                <label for="fvwht_pz_weld3" class="control-label col-md-3"style="text-align: right; padding-left: 15px; padding-right: 15px">Schweiße</label>
                <input class="form-control col-md-offset-1" name="material[pz_weld3]" id="fvwht_pz_weld3" disabled />
            </div>
        </div>
    </div>
</div>