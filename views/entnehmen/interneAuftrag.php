<?php

use yii\helpers\Html;
use yii\helpers\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

?>

<div class="container">

    <div class="row">
        <h4>Füllen Sie die Felder des Auftragformular für die Bearbeitung von</h4>
        <hr class="my-4">
    </div>

    <div class="row">
        <div class="form-group col-md-10">
            <label for="num">Bemerkung</label>
            <textarea type="text" class="form-control" required rows="3" style="width:90%;"></textarea>
        </div>
    </div>

    <div class="row">
        <label for="new_datum">Datum:<span class="required">*</span></label>
        <input type="date" class="mandatory form-control" id="neueFormDate" style="width: 15pc">
    </div>

    <div class="row" style="padding-top: 10px">
        <label>Sonstiger Anhang (Foto).</label>
        <input type="file" name="entnehemenFotos[]" multiple/>
        <hr class="my-4" style="width:93%">
    </div>

</div>



