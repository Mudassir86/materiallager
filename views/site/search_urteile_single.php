<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Dropdown;
use coderius\lightbox2\Lightbox2;
use yii\helpers\Url;

/*$this->title = 'Materiallager';
$this->params['breadcrumbs'][] = $this->title;*/

?>

<?= coderius\lightbox2\Lightbox2::widget([
    'clientOptions' => [
        'resizeDuration' => 200,
        'wrapAround' => true,

    ]
]); ?>

<?php
    $folderpath = '/../../material_uploads/';
    //$folderpath = '/material/web/uploads/';
?>

    <div class="container">

        <div class="row">

            <?php if(empty($data["matInfo"])) { ?>

                <div class="jumbotron" style="background-color: transparent !important;">

                    <h4 class="display-4">No Data Found</h4>

                </div>
        </div>

        <?php } else { foreach ($data['matInfo'] as $pzInfo) ?>

        <?php { ?>

            <div class="row">

                <div class="col-md-6">

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Normbezeichnung:</label>
                        <p><?=$pzInfo['standard_designation']?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Werkstoffnummer:</label>
                        <p><?=$pzInfo['material_number']?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Trivialname1:</label>
                        <p><?=$pzInfo["trivialname1"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Trivialname2:</label>
                        <p><?=$pzInfo["trivialname2"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Trivialname3:</label>
                        <p><?=$pzInfo["trivialname3"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Werkstoffzustand:</label>
                        <p><?=$pzInfo["mat_cond"]?></p>
                    </div>

                    <br><br>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Angelegt von:</label>
                        <p><?=$pzInfo["name"].' '.$pzInfo["nachname"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Angelegt am:</label>
                        <p><?=Yii::$app->formatter->asDate($pzInfo["ctime"], 'yyyy-MM-dd');?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Lieferant:</label>
                        <p><?=$pzInfo["orgname"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Vorprüfungszeugnis:</label>
                        <p><?=$pzInfo["vpz_url"]?></p>
                    </div>

                    <div class="row">
                        <label class="control-label col-md-3" style="padding-left: 0">Aufträge:</label>
                        <p><?=$pzInfo["auftrag"]?></p>
                    </div>

                </div>

                <div class="col-md-6">

                    <?php if($pzInfo["weld_mat"]==TRUE) { ?>

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

                    <?php if($pzInfo["weld_mat"]==TRUE) { ?>

                        <div class="row">
                            <label class="control-label col-md-4" style="padding-left: 0">Grundwerkstoff 2:</label>
                            <p><?=$pzInfo["pz_weld2"]?></p>
                        </div>

                    <?php } ?>

                    <?php if($pzInfo["weld_mat"]==TRUE) { ?>

                        <div class="row">
                            <label class="control-label col-md-4" style="padding-left: 0">Schweiße:</label>
                            <p><?=$pzInfo["pz_weld3"]?></p>
                        </div>

                    <?php } ?>

                </div>

            </div>

        <?php }?>

        <?php } ?>

        <hr class="my-4">

        <div class="row">
            <div class="col">
                <?=$data["part_label"]?><br>
                Lagerort:<?=$data["storage_location"]?>
             </div>
        </div>

        <hr class="my-4">

        <div class="row">
            <div class="col">
                 <label>Bilder:</label>
            </div>

            <div class="col">

                <?php foreach($data["partImages"] as $partimage) {
                    $name = $partimage["origname"];
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                ?>
                    <?php if($ext != "pdf") { ?>

                    <a href="<?=Yii::getAlias($folderpath."material_fotos/".$name);?>" data-lightbox="roadtrip">
                        <!-- Thumbnail picture -->
                        <?= Html::img($folderpath."material_fotos/t_".$name); ?>
                    </a>
                     <?php } else {?>

                        <a href="<?=Yii::getAlias($folderpath."material_fotos/".$name);?>" target="_blank" ">
                            <img width="100" class="img-responsive"
                             data-pdf-thumbnail-file=<?=$folderpath."material_fotos/".$name?>
                                src="/material/web/images/pdf.png">
                        </a>

                     <?php } ?>

                <?php } ?>
            </div>

        </div>

        <hr class="my-4">

        <div class="row">

            <div class="col">
                <label>Zeichnung:</label>
            </div>

            <div class="col">

                <?php foreach($data["partDrawings"] as $partdrawing) {
                    $name = $partdrawing["origname"]; ?>

                    <a href=<?=$folderpath."drawings/".$partdrawing["origname"]?> target="_blank" ">
                    <img width="100" class="img-responsive"
                         data-pdf-thumbnail-file=<?=$folderpath."drawings/".$partdrawing["origname"]?>
                            src="/material/web/images/pdf.png">
                    </a>

                <?php } ?>

            </div>

        </div>

        <hr class="my-4">

        <div class="row">

            <div class="col">
                <label>Halbzeuge:</label>
            </div>

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

                        <tr>
                            <td><a href="javascript:;" class="urteile_link" data-pz="<?=$data["part_label"]?>"><?=$data["part_label"]?></a></td>
                            <td>placehoder</td>
                            <td>placehoder</td>
                            <td><?=$data['storage_location']?></td>
                            <td>placehoder</td>
                        </tr>

                    </tbody>
                </table>

            </div>

        </div>

    </div>