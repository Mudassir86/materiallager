<div class="container">
	
	<div class="row">
		<div class="form-group col-md-5">
			<label for="name">Firmenname<span class="required">*</span></label>
			<input type="name" class="form-control mandatory neue_lieferant_input" name="fullname" id="neue_name" placeholder=".... AG, GmbH" style="width:95%; font-style:italic;">
		</div>
		
		<div class="form-group col-md-5 has-error">
			<label for="strasse">Straße, Hausnummer<span class="required">*</span></label>
			<input type="strasse" class="form-control mandatory neue_lieferant_input" name="street" id="neue_strasse"placeholder="Alexanderstraße" style="width:95%;font-style:italic;">
		</div>
		
		<div class="form-group col-md-2">
			<label for="zip">Postleitzahl<span class="required">*</span></label>
			<input type="text" class="form-control mandatory neue_lieferant_input" name="zip" id="neue_zip" placeholder="PLZ" style="width:95%; font-style:italic;">
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-2 has-error">
			<label for="ort">Ort<span class="required">*</span></label>
			<input type="text" class="form-control mandatory neue_lieferant_input" name="city" id="neue_ort" required placeholder="Darmstadt" style="width:90%; font-style:italic;">
		</div>
		
		<!--<div class="form-group col-md-2">
			<label for="staat">Staat</label>
			<input type="text" class="form-control neue_lieferant_input" name="state" id="neue_staat" required placeholder="Hessen" style="width:90%; font-style:italic;">
		</div>--!>

		<div class="form-group col-md-2 has-error">
			<label for="land">Land<span class="required">*</span></label>
			<input type="text" class="form-control neue_lieferant_input mandatory" name="country" id="neue_land" required placeholder="Deutschland" style="width:90%; font-style:italic;">
		</div>
		
		<!--<div class="form-group col-md-2">
			<label for="tel">Telefon</label>
			<input type="text" class="form-control neue_lieferant_input" name="phone1" id="neue_tel" placeholder="+49" style="width:90%;">
		</div>
		
		<div class="form-group col-md-5 has-error">
			<label for="house">Email<span class="required">*</span></label>
			<input type="email" class="form-control mandatory neue_lieferant_input" name="email1" id="neue_email" placeholder="Enter email" style="width:90%; font-style:italic;">
		</div>--!>
	</div>

	<!--<div class="row">
		<div class="form-group col-md-5">
			<label for="partner">Ansprechpartner/-in</label>
			<input type="text" class="form-control neue_lieferant_input" id="neue_partner" style="width:90%; font-style:italic;">
		</div>
	</div>--!>
	
	<div class="row">
		<div class="form-group col-md-10">
			<label for="num">Bemerkung</label>
			<textarea type="text" class="form-control neue_lieferant_input" name="comment" id="neue_num" required rows="3" style="width:90%;"></textarea>
		</div>
	</div>
</div>