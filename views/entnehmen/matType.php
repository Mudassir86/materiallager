<?php

use yii\helpers\Html;

?>

<div class="container">
        <div class="row">
            <div class="form-group">
                <h4>Vom welchem Typ ist das Material?</h4>
            </div>
        </div>

        <div class="row">
            <div class="form-group" align="center">
                <div class="radio" >
                    <div class="col-md-3">
                        <input type="radio" class="mandatory" name="form" id="radio_urteil" value="origin">
                        <label for="radio_urteil">Urteil</label>
                    </div>

                    <div class="col-md-3">
                        <input type="radio" class="mandatory" name="form" id="radio_halbzeug" value="wrought">
                        <label for="radio_halbzeug">Halbzeug</label>
                    </div>

                    <div class="col-md-3">
                        <input type="radio" class="mandatory" name="form" id="radio_rohling" value="blank">
                        <label for="radio_rohling">Rohling</label>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4" style="width:93%">

        <div class="row">
            <div class="center row form-group bg-info" style="width:95%">
                <h4 style="text-align: center">Es kann nur Ein Kreuz gesetzt werden!!!</h4>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="selectMaterial">Welche Teile wollen Sie entnehmen?</label>
                <select multiple class="mandatory form-control" type="checkbox" id="part_select" style="width:85%;"></select>
                <input type="hidden" name="material_family[material_id]" id="entnehmen_pz_id_hdn">
            </div>
        </div>

        <div class="row">
            <div class="center row form-group bg-info" style="width:95%">
                <h4 style="text-align: center">Auswahl mehrerer Teile nur für eindeutige Bearbeitungsschritte!!!</h4>
            </div>
        </div>

    <hr class="my-4" style="width:93%">

        <div class="row">
            <div class="center row form-group bg-info" style="width:95%" >
                <h4 style="text-align: center">Zu welchem Industrieauftrag / Forschungsvorhaben gehört das Material?</h4>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <select class="mandatory form-control" name="material_family[assignment_id]" id="auftragnummer" style="width:85%;"></select>
            </div>
        </div>

        <div class="row">
            <span><h4>Ihr Industrieauftrag/Forschungsvorhaben ist nicht in der Liste?</span>
            <a class="btn btn-success" id="neueIndustrieauftrag">Neu Industrieauftrag / Forschungsvorhaben</a>
        </div>

</div>

<div id="neueIndustireuftragModal" class="modal fade"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="margin : 0px; display: inline-block;">Neue Industrieauftrag / Forschungsvorhaben anlegen</h3>
            </div>
            <div class="modal-body neueIndustrieauftragModalBody"></div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" style="float: right;">Abbrechen</button>
                <button type="button" class="btn green neueIndustrieauftragModalSave" style=" float: right; margin-right: 10px;">Speichern</button>
                <button type="reset" class="btn dark btn-outline" value="Reset" style="float: right; margin-right: 10px;">Zurücksetzen</button>
            </div>
        </div>
    </div>
</div>

<div id="neueAuftraggeberModal" class="modal fade"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="margin : 0px; display: inline-block;">Neue Auftraggeber anlegen</h3>
            </div>
            <div class="modal-body neueAuftraggeberModalBody"></div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" style="float: right;">Abbrechen</button>
                <button type="button" class="btn green neueAuftraggeberModalSave" style=" float: right; margin-right: 10px;">Speichern</button>
                <button type="reset" class="btn dark btn-outline" value="Reset" style="float: right; margin-right: 10px;">Zurücksetzen</button>
            </div>
        </div>
    </div>
</div>


