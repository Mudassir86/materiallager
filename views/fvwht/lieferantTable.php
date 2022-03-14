<?php

use yii\helpers\Html;


?>
<input type="hidden" id="selectedRow" value="">
<input type="hidden" name="material[mat_owner]"  id="material_mat_owner" value="">

<div class="row" style="margin-top: -15px;margin-bottom: 15px;margin-left: 0px">
    <h4>Bitte wählen Sie den Lieferanten Ihrer Lieferung. Falls er nicht in der Liste vorhanden ist, legen Sie ihn bitte an.</h4>
</div>

<div class="row" style="margin-top: -15px;margin-bottom: 15px;margin-left: 0px;">
	<a class="btn btn-success" id="neue_lieferant">Neue Organisation anlegen</a>
</div>
<table class="table table-striped table-bordered dataTable " id="lieferantTable">
	<thead>
		<tr role="row" class="heading">

			<th>Firmaname</th>
			<th>Straße</th>
			<th>PLZ</th>
			<th>Ort</th>
			<th>Staat</th>
			<th>Land</th>

		</tr>
		
	</thead>
	<tbody> </tbody>
</table>


<div id="neueLieferantModal" class="modal fade"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
            	<h3 style="margin : 0px; display: inline-block;">Neue Organisation anlegen</h3>
            </div>
            <div class="modal-body neueLieferantModalBody">
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" style="float: right;">Abbrechen</button>
                <button type="button" class="btn green neueLieferantModalSave" style=" float: right; margin-right: 10px;">Speichern</button>
                <button type="reset" class="btn dark btn-outline" value="Reset" style="float: right; margin-right: 10px;">Zurücksetzen</button>
            </div>
        </div>
    </div>
</div>
