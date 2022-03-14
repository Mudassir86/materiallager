<?php

use yii\helpers\Html;
use yii\helpers\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Übersicht';
$this->params['breadcrumbs'][] = $this->title;
?>

<h4 class="block">Prüfen Sie Ihre Eingaben</h4>
<h4 class="form-section">Lieferant</h4>
	<div class="form-group">
		<label class="control-label col-md-3">Firmenname:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_firmenname" data-display="firmenname"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Straße, Hausnummer:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_strasse" data-display="strasse"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Postleitzahl:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_postleitzahl" data-display="postleitzahl"> </p>
		</div>
	</div>

	<!--<div class="form-group">
		<label class="control-label col-md-3">Telefon:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_telefon" data-display="telefon"> </p>
		</div>
	</div>-->

	<div class="form-group">
		<label class="control-label col-md-3">Email:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_email" data-display="email"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Ort:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_ort" data-display="ort"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Land:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_land" data-display="land"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Bemerkung:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_bemerkung" data-display="bemerkung"> </p>
		</div>
	</div>

	<h4 class="form-section">Prüfzeichen</h4>
	<div class="form-group">
		<label class="control-label col-md-3">Prüfzeichen:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_prufzeichen" data-display="prufzeichen"> </p>
		</div>
	</div>

	<h4 class="form-section">Werkstoffbezeichnung</h4>
	<div class="form-group">
		<label class="control-label col-md-3">Normbezeichnung:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_pz_alt1" data-display="normbezeichnung"> </p>
		</div>
	</div>

    <div class="form-group">
        <label class="control-label col-md-3">Werkstoffnummer:</label>
        <div class="col-md-4">
            <p class="form-control-static" id="materialOverView_werkstoffnummer" data-display="werkstoffnummer"> </p>
        </div>
    </div>

	<div class="form-group">
		<label class="control-label col-md-3">Trivailnamen 1:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_trivialname1" data-display="trivialname1"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">2:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_trivialname2" data-display="trivialname2"> </p>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-3">3:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_trivialname3" data-display="trivialname3"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Werkstoffzustand:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_werkstoffzustand" data-display="werkstoffzustand"> </p>
		</div>
	</div>

    <div class="form-group">
        <label class="control-label col-md-3">Charge/Schmelze:</label>
        <div class="col-md-4">
            <p class="form-control-static" id="materialOverView_schmelze" data-display="schmelze"> </p>
        </div>
    </div>

	<div class="form-group">
		<label class="control-label col-md-3">Schweißverbindung:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_weld_mat" data-display="schweißverbindung"> </p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Grundwerkstoff 2:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_pz_weld2" data-display="Grundwerkstoff2"> </p>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3">Schweiße:</label>
		<div class="col-md-4">
			<p class="form-control-static" id="materialOverView_pz_weld3" data-display="Grundwerkstoff2"> </p>
		</div>
	</div>