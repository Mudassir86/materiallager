<div class="container">
	
	<div class="row">
		<div class="form-group col-md-5">
			<label for="name">Firmenname<span class="required">*</span></label>
			<input type="name" class="form-control mandatory neue_auftraggeber_input" name="fullname" id="neue_name" placeholder=".... AG, GmbH" style="width:95%; font-style:italic;">
		</div>
		
		<div class="form-group col-md-5">
			<label for="strasse">Straße, Hausnummer<span class="required">*</span></label>
			<input type="strasse" class="form-control mandatory neue_auftraggeber_input" name="street" id="neue_strasse"placeholder="Alexanderstraße" style="width:95%;font-style:italic;">
		</div>
		
		<div class="form-group col-md-2">
			<label for="zip">Postleitzahl<span class="required">*</span></label>
			<input type="zip" class="form-control mandatory neue_auftraggeber_input" name="zip" id="neue_zip" placeholder="PLZ" style="width:95%; font-style:italic;">
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-2">
			<label for="ort">Ort<span class="required">*</span></label>
			<input type="ort" class="form-control mandatory neue_auftraggeber_input" name="city" id="neue_ort" required placeholder="Darmstadt" style="width:90%; font-style:italic;">
		</div>

        <div class="form-group col-md-2">
            <label for="land">Land<span class="required">*</span></label>
            <input type="land" class="form-control neue_auftraggeber_input mandatory" name="country" id="neue_land" required placeholder="Deutschland" style="width:90%; font-style:italic;">
        </div>

	</div>
	
	<div class="row">
		<div class="form-group col-md-10">
			<label for="num">Bemerkung</label>
			<textarea type="num" class="form-control neue_auftraggeber_input" name="comment" id="neue_num" required rows="3" style="width:90%;"></textarea>
		</div>
	</div>
</div>