<?php

use yii\helpers\Html;

?>

<div class="container">
    <div class="row">
        <h4>Bitte geben Sie einen freien Lagerort für Ihr Urteil an.</h4>
        <hr class="my-4">
    </div>

    <div class = "form-group">

        <label for="regal" class="control-label col-sm-2 number" style="text-align: left">Regal (1-5)<span class="required">*</span><br>
        <input class="form-control mandatory" type="number" id="regal" name="lager" min="1" max="5" onKeyUp="if(this.value>5){this.value='5';}"  style="width: 7em" >
        </label>

        <label for="ebene" class="control-label col-sm-2 number" style="text-align: left">Ebene (1-3)<span class="required">*</span><br>
        <input class="form-control mandatory" type="number" id="ebene" name="lager" min="1" max="3" onKeyUp="if(this.value>3){this.value='3';}" style="width: 7em">
        </label>

        <label for="palette" class="control-label col-sm-2 number" style="text-align: left">Palette (1-3)<span class="required">*</span><br>
        <input class="form-control mandatory" type="number" id="palette" name ="lager" min="1" max="3" onKeyUp="if(this.value>3){this.value='3';}" style="width: 7em" >
        </label>

        <input type="hidden" name= "material_family[storage_location]" id="lagerort">
    </div>


</div>
