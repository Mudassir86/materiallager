<?php

use yii\helpers\Html;

?>

<div class="container">

    <div class="row">
        <div class="form-group">
            <h4>Was möchten Sie fertigen?</h4>

            <!-- Radio Buttons row -->
            <div class="radio" align="center">
                    <div class="col-lg-4">
                        <input type="radio" class="mandatory" name="material_family[form]" id="radioFertigHalbzeuge" value="wrought">
                        <label for="radioFertigHalbzeuge">Halbzeuge</label>
                    </div>

                    <div class="col-lg-4">
                        <input type="radio" class="mandatory" name="material_family[form]" id="radioFertigRohlinge" value="blank">
                        <label for="radioFertigRohlinge">Rohlinge</label>
                    </div>
            </div>
            <hr class="my-4" style="width:93%">
        </div>
    </div>

    <div class="row">
        <div class="row center form-group bg-info" style="width:95%" >
            <h4 style="text-align: center">Sie möchten die Fertigung von Halbzeugen (Rohlingen/Proben) in Auftrag geben.</h4>
        </div>

        <div class="row">
            <h4>Wie viele Teile entstehen dabei insgesamt?</h4>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="anzahl"  class="control-label col-xs-3">Stückzahl<span class="required">*</span></label>
                <div class="col-xs-3">
                    <input class="form-control mandatory number" id="anzahl" min="1" style="height: 22pt; width: 35pt">
                </div>
            </div>
        </div>

        <div class="row">

        </div>

        <div class="row" style="padding-top: 10px">
            <label>Tragen Sie die Namen der entstehen Teile in Ihre Ziechnung ein und laden Sie diese hoch.</label>
                <input type="file" name="entFilesDrawing[]" multiple/>
            <hr class="my-4" style="width:93%">
        </div>
    </div>

    <div class="row werstattMasse">
        <div class="center row form-group bg-info" style="width:95%" >
            <h4 style="text-align: center">Tragen Sie für jedes Teil die möglichst exakte Länge, Breite, Höhe und Masse ein!</h4>
        </div>


    </div>


</div>