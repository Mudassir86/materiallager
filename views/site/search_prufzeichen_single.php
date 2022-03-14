<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;

/*$this->title = 'Materiallager';
$this->params['breadcrumbs'][] = $this->title;*/

?>

    <div class="container">

        <div class="row">

            <?php if(empty($data)) { ?>

            <div class="jumbotron" style="background-color: transparent !important;">

                <h4 class="display-4">No Data Found</h4>

            </div>
        </div>

        <?php } else { ?>

            <div class="row">

                <div class="col-md-6">

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Normbezeichnung:</label>
                        <p><?=$data['standard_designation']?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Werkstoffnummer:</label>
                        <p><?=$data['material_number']?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Trivialname1:</label>
                        <p><?=$data["trivialname1"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Trivialname2:</label>
                        <p><?=$data["trivialname2"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Trivialname3:</label>
                        <p><?=$data["trivialname3"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Werkstoffzustand:</label>
                        <p><?=$data["mat_cond"]?></p>
                    </div>

                    <br><br>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Angelegt von:</label>
                        <p><?=$data["name"].' '.$data["nachname"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Angelegt am:</label>
                        <p><?=Yii::$app->formatter->asDate($data["ctime"], 'yyyy-MM-dd');?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Lieferant:</label>
                        <p><?=$data["orgname"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Vorprüfungszeugnis:</label>
                        <p><?=$data["vpz_url"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Aufträge:</label>
                        <p><?=$data["auftrag"]?></p>
                    </div>

                </div>

                    <label class="control-label col-md-3" style="padding-left: 0">Angelegt am:</label>
                    <p><?=Yii::$app->formatter->asDate($data["ctime"], 'yyyy-MM-dd');?></p>

                    <?php if($data["weld_mat"]==TRUE) { ?>

                    <div class="row">
                        <label class="control-label col-md-4" style="padding-left: 0">Schweißverbindung:</label>
                        <p>Ja</p>
                    </div>

                    <?php } else {?>

                    <div class="row">
                        <label class="control-label col-md-4" style="padding-left: 0">Schweißverbindung:</label>
                        <p>Nein</p>
                    </div>

                    <?php } ?>

                    <?php if($data["weld_mat"]==TRUE) { ?>
                    <div class="row">
                        <label class="control-label col-md-4" style="padding-left: 0">Grundwerkstoff 2:</label>
                        <p><?=$data["pz_weld2"]?></p>
                    </div>
                    <?php } ?>

                    <?php if($data["weld_mat"]==TRUE) { ?>
                    <div class="row">
                        <label class="control-label col-md-4" style="padding-left: 0">Schweiße:</label>
                        <p><?=$data["pz_weld3"]?></p>
                    </div>
                    <?php } ?>

                </div>

                    <?php if($data["weld_mat"]==TRUE) { ?>
                        <label class="control-label col-md-4" style="padding-left: 0">Grundwerkstoff 2:</label>
                        <p><?=$data["pz_weld2"]?></p>
                    <?php } ?>

        <?php }?>

        <hr class="my-4">

        <div class="row">

        <?php  if(!empty($data["materialFamily"])) { ?>

            <div class="col">

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

                    <?php foreach($data["materialFamily"] as $members) { ?>
                    <tr>
                        <td><a href="javascript:;" class="urteile_link" data-pz="<?=$members['part_label']?>"><?=$members['part_label']?></a></td>
                        <td>placehoder</td>
                        <td>placehoder</td>
                        <td><?=$members['storage_location']?></td>
                        <td>placehoder</td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>

        </div>

        <?php } ?>


    </div>