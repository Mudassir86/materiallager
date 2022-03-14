<div class="container">

	<div class="row">
		<div class="form-group col-md-5">
			<label for="auftragnummer">Auftrag Nummer<span class="required">*</span></label>
			<input class="form-control mandatory neue_industrieauftrag_input" name="assignment_number" id="neueAuftragnummer" placeholder="ABC1234" style="width:95%; font-style:italic;">
		</div>
	</div>

    <div class="row">
        <div class="form-group col-md-5">
            <label for="neue_ext_ansprechpartner">Externer Ansprechpartner:<span class="required">*</span></label>
            <input class="form-control mandatory neue_industrieauftrag_input" name="counterpart_ext" id="neueExtAnsprechpartner"placeholder="Alex Young" style="width:95%;font-style:italic;">
        </div>

        <div class="form-group col-md-5">
            <label for="neue_int_ansprechpartner">Interner Ansprechpartner:<span class="required">*</span></label>
            <input class="form-control mandatory neue_industrieauftrag_input" name="counterpart_int" id="neueIntAnsprechpartner" placeholder="Jon Snow" style="width:95%; font-style:italic;">
        </div>
    </div>

	<div class="row">
		<div class="form-group col-md-8">
			<label for="neue_kurztitel">Bemerkung / Kurztitel:<span class="required">*</span></label>
			<input  class="form-control mandatory neue_industrieauftrag_input" name="comment" id="neueKurztitel" required rows="3" style="width:90%;"></input>
		</div>
	</div>

    <div class="row">
        <div class="form-group col-md-7">
            <label for="auftraggeber">Auftraggeber:<span class="required">*</span></label>
            <select class="mandatory form-control neue_industrieauftrag_input" name="customer_id" id="selAuftraggeber" style="width:85%;"></select>
        </div>

        <div class="form-group col-md-3">
            <label for="new_datum">Datum:<span class="required">*</span></label>
            <input type="date" class="mandatory form-control neue_industrieauftrag_input" id="newDatum" name="assignment_date">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-5">
            <span><h4>Ihr Auftraggeber ist nicht in der Liste?</span> <a class="btn btn-success" id="neueAuftraggeber">Neu Auftraggeber</a>
        </div>
    </div>

</div>