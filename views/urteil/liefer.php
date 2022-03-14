<?php

?>

<div class="container">
    <div class="row">
        <h4>Bitte laden Sie den Lieferschein und (falls zuvor noch nicht vorhaben) das Vorprüfzeugnis hoch</h4>
        <hr class="my-4">
    </div>

    <div class="row">

        <div class="form-check">

            <label class="form-check-label">Lieferschein</label>
            <input type="file" name="filesDelivery[]" multiple/>

        </div>

        <div class="form-check">

            <label class="form-check-label">Vorprüfungszeugnis</label>
            <input id="vpzUpload" type="file" name="filesBin[]" multiple/>

        </div>

    </div>
</div>