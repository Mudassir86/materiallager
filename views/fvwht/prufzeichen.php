<?php

use yii\helpers\Html;
$this->title = 'Prüfzeichen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<div class="row">
		<h5>Beginnen Sie mit der Eingabe der ersten beiden Buchstaben eines neuen Prüfzeichens.
            Sie bekommen daraufhin bereits vergebene und freie Prüfzeichen angezeigt.
            <br>Wählen Sie eines der freien Prüfzeichen aus der rechten Spalte aus und klicken Sie auf Weiter.
            <br>Folgende Buchstaben sind nicht zugelassen: i, I (großes i), l (kleines L), o, O, q, x, X</h5>
	  	<hr class="my-4">
	</div>
	
	<div class="row">
        <div class="form-group col-md-2">
		    <label for="exampleFormControlSelect2">Prüfzeichen<span class="required">*</span></label>
		    <input class="form-control" type="text" id="fvwhtPrufzeichen" requiredminlength="3" maxlength="3"  style="width:86%;">
	    </div>

        <div class="form-group col-md-5">
            <label for="usedPrufzeichen">Vergebene Prüfzeichen</label>
            <select multiple class="form-control" disabled id="usedPrufzeichen" style="width:86%;"></select>
        </div>

        <div class="form-group col-md-5">
            <label for="freePrufzeichen">Freie Prüfzeichen</label>
            <select multiple class="form-control" name="material[pz]" id="freePrufzeichen" style="width:86%;"></select>
        </div>
    </div>

    <div class="row">
	    <div class="form-group col-md-5">
	        <label for="lfdNummer">AGH/W-Kz. (lfd.Nummer)</label>
	        <input class="form-control" type="text" name="material[pz_alt2]" id="lfdNummer" style="width:86%;">
  	    </div>

  	    <div class="form-group col-md-5">
	        <label for="projektgruppe">Projektgruppe</label>
	        <input class="form-control" type="text" name="material[group_id]" id="projektgruppe" style="width:86%;">
	    </div>

    </div>

	<div class="row">
		<label for="fileUpload">Falls vorhanden, Vorprüfungszeugnis hochladen</label><br>
			<form enctype="multipart/form-data">
    			<input name="files[]" type="file" size="30" />

		</form>
	</div>	  
</div>