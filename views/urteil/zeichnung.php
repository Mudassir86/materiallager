<?php
use yii\helpers\Html;
?>

<div class="container">
    <div class="row">
        <h4>Bitte laden Sie eine Zeichnung hoch</h4>
        <hr class="my-4">
    </div>

	<div class="row">
		<div class="form-check">

            <label class="form-check-label">Für alle angelegten Rohlinge wird die gleiche Zeichnung verwendet</label>
            <input type="file" name="filesDrawing[]" multiple  />

		</div>
	</div>
</div>