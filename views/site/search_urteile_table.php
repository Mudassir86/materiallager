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

                <th>Part Label</th>
                <th>Form</th>
                <th>Lagerort</th>

            </tr>

            </thead>
            <tbody>

            <?php foreach($data as $partInfo) { ?>


                <tr>
                    <td><a href="javascript:;" class="urteile_link" data-pz="<?=$partInfo['part_label']?>"><?=$partInfo['part_label']?></a></td>
                    <td><?=$partInfo['form']?></td>
                    <td><?=$partInfo['storage_location']?></td>
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