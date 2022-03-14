<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;
use yii\helpers\Url;
?>

<div class="container">

    <div class="row">

        <table class="table table-striped table-bordered dataTable " id="prufzeichenSearchTable">
            <thead>
            <tr role="row" class="heading">

                <th>Prüfzeichen</th>
                <th>Normbezeichnung</th>
                <th>Materialnummer</th>
                <th>Trivialname1</th>
                <th>Trivialname2</th>
                <th>Trivialname3</th>


            </tr>

            </thead>
            <tbody>

            <?php foreach($data as $werkstoff) { ?>

                <tr>
                    <td><a href="javascript:;" class="prufzeichen_link" data-pz="<?=$werkstoff['pz']?>"><?=$werkstoff['pz']?></a></td>
                    <td><?=$werkstoff['standard_designation']?></td>
                    <td><?=$werkstoff['material_number']?></td>
                    <td><?=$werkstoff['trivialname1']?></td>
                    <td><?=$werkstoff['trivialname2']?></td>
                    <td><?=$werkstoff['trivialname3']?></td>
                </tr>

            <?php } ?>



            </tbody>
        </table>

    </div>

</div>

<script>

  /*  $("#prufzeichenSearchTable").DataTable({
        "bSortCellsTop": true,
        "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "pageLength": 10,
        "autoWidth": false,
        "bPaginate": true,


        "order": [],
        "language": {
            url: '/material/web/plugins/de.json'
        },

        "pagingType": "bootstrap_full_number",

    });*/
</script>