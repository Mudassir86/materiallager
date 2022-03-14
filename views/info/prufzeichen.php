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
			<label for="exampleFormControlSelect2">Eingabe<span class="required">*</span></label>
			<input class="form-control" type="text" id="eingabePrufzeichen" requiredminlength="3" maxlength="3" size="3" style="width:86%;">
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
</div>