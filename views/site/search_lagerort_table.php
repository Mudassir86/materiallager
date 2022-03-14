<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;
use yii\helpers\Url;
?>

<div class="container">

    <?php  if(!empty($data)) { ?>

    <div class="row">

        <table class="table table-striped table-bordered dataTable " id="prufzeichenSearchTable">
            <thead>
            <tr role="row" class="heading">

                <th>Urteil</th>
                <th>Halbzeuge</th>
                <th>Rohlinge</th>
                <th>Lagerort</th>
                <th>Probe</th>

            </tr>

            </thead>
            <tbody>

                <?php foreach($data as $ort) { ?>
                <tr>
                    <td><a href="javascript:;" class="urteile_link" data-pz="<?=$ort['part_label']?>"><?=$ort['part_label']?></a></td>
                    <td>placehoder</td>
                    <td>placehoder</td>
                    <td><?=$ort['storage_location']?></td>
                    <td>placehoder</td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>

    <?php } ?>


</div>