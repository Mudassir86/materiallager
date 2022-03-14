<?php

use yii\helpers\Html;

?>

<div class="container">
    <div class="row">
        <h4>Bitte laden Sie für jedes Urteil ein Foto hoch</h4>
        <hr class="my-4">
    </div>
    
	<div class="row">
		<div class="column" style="background-color:white; overflow-y: scroll">
			<div class="form-check">

                <input type="checkbox" class="form-check-input" name="isSingleFoto" id="isSingleFoto">
                <label class="form-check-label" for="foto">Ein Foto für alle Urteile hochladen</label>
                    <table id="image_upload">
                        <tr class="part_first">
                            <td class="part_first_label" style="padding-right: 10px; padding-bottom: 10px;"></td>
                            <td style="padding-bottom: 10px;">
                                <input type="hidden" name="nextChildId" class="next_child_id_hdn" value="">
                                <input type="hidden" name="labelName[]" class="part_first_label_hdn" value="">
                                <input class="mandatory part_first_foto" accept="image/*" name="files[]" type="file" multiple />
                            </td>
                        </tr>
                    </table>
                <!--<input class="mandatory" accept="image/*" name="files[]" type="file" multiple />
               <input class="mandatory" accept="image/*" name="files[]" type="file" size="30" />
               <input class="mandatory" accept="image/*" name="files[]" type="file" size="30" />-->
    		</div>
		</div>

<!-- Camera -->
  		<div class="column" style="background-color:white;">
			<div class="vl">
				<div class="camera">
					<video id="video">Video stream not available.</video>
						<button id="startbutton">Foto erstellen</button>
				</div>

				<canvas id="canvas"></canvas>

			</div>
		</div>
	</div>
<!-- Buttons
	<div class="form-actions">
		<div class="row">
			<div class="col-md-offset-3 col-md-9" style="float: right;">
				<a href="../urteil/page20" class="btn default materialZuruck">
					<i class="fa fa-angle-left"></i> Zurück </a>
				<a href="#" class="btn btn-outline green materialNext"> Weiter
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
	</div> -->
</div>


<style>
* {
  box-sizing: border-box;
}

/* Two equal columns */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.vl {
  border-left: 1px solid grey;
  height: 250px;
}
</style>