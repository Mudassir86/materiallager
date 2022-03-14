    <?php

    use yii\helpers\Html;

    ?>

    <div class="container">
        <div class="row">
            <div class="form-group">
                <h5>Bitte füllen Sie die angezeigten Felder aus. Bitte nur <b>artgleiche</b> Urteile gemeinsam anlegen.</h5>
                <hr class="my-4">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
        <!-- Radio Buttons row -->
                <div class="radio">
                    <p>Form des vorliegenden Materials</p>
                        <label>
                            <input class="mandatory" type="radio" name="material_family[form]" id="radio_urteil" value="origin">Urteil(e)
                        </label><br>
                        <label>
                            <input type="radio" class="mandatory" name="material_family[form]" id="radio_rohling" value="blank">Rohling(e)
                        </label>
                </div>
            </div>
        </div>


        <!-- First row -->
        <div class="row">
            <div class="form-group">
                <label for="stuckzahl"  class="control-label col-xs-1">Stückzahl<span class="required">*</span></label>
                <div class="col-xs-1">
                    <input type="text" class="form-control mandatory number" id="stuckzahl" size="5" name="stuckzahl">
                </div>

                <label for="mass" class="col-xs-2 control-label number">Gesamtmasse (in kg)<span class="required">*</span></label>
                <div class="col-xs-1">
                    <input class="form-control mandatory" type="text" id="mass" size="5" name="material_family[total_mass_kg]">
                </div>

                <label class="control-label col-xs-3">Ungefähres Maß L x B x H (in mm)<span class="required">*</span></label>
                <div class=" col-xs-1">
                    <input class="form-control mandatory number" type="text"  id="length" size="5" name="material_family[length_mm]">
                </div>
                <div class=" col-xs-1">
                    <input class="form-control mandatory number" type="text"  id="breadth" size="5" name="material_family[width_mm]">
                </div>
                <div class=" col-xs-1">
                    <input class="form-control mandatory number" type="text"  id="height" size="5" name="material_family[height_mm]">
                </div>
            </div>
        </div>

    <!-- Second row -->
        <div class="row">
            <div class="form-group">
                <label for="art" class="control-label col-xs-1">Art<span class="required">*</span></label>
                <select class="form-control mandatory" id="art" name="material_family[type]" style="width: auto">
                    <option value="">Bitte wählen Sie die Art des Urteils aus.</option>
                    <option value="1">Stange</option>
                    <option value="2">Quader</option>
                    <option value="3">Rohr</option>
                    <option value="4">Bauteil</option>
                </select>
            </div>
        </div>

    <!-- Third row -->
        <div class="row">
            <div class="form-group">
                <div class="col-sm-10">
                    <label for="beschreibung" >Beschreibung</label>
                    <textarea type="text" class="form-control" name="material_family[comment]" id="beschreibung" required rows="3" style="width:90%;"></textarea>
                </div>
            </div>
        </div>
    </div>

    <style>:req{background: red;}</style>