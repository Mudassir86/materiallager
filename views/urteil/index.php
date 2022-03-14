<?php

use yii\helpers\Html;
use yii\helpers\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Urteil anlegen';
$this->params['breadcrumbs'][] = ['label' => 'Urteil anlegen', 'url' => ['/urteil/index']];
?>

<div class="maincontent">

    <div class="portlet light " id="form_wizard_1">

        <div class="portlet-body form">
            <form class="form-horizontal" id="urteilForm">
                <input type="hidden" name="material_family[material_id]" id="pz_hdn" >
                <div class="form-wizard">
                    <div class="form-body" style=" padding-top: 0px;">
                        <ul class="nav nav-pills nav-justified steps urteilTabs" style="margin-top: -30px;padding: 0px;margin-bottom: 0px;">
                            <li class="active" data-validation="t">
                                <a href="#tab1" data-toggle="tab" class="step">
                                </a>
                            </li>
                            <li data-validation="t">
                                <a href="#tab2" data-toggle="tab" class="step">
                                </a>
                            </li>
                            <li data-validation="t">
                                <a href="#tab3" data-toggle="tab" class="step">
                                </a>
                            </li>
                            <li data-validation="f">
                                <a href="#tab4" data-toggle="tab" class="step">
                                </a>
                            </li>
                            <li data-validation="f">
                                <a href="#tab5" data-toggle="tab" class="step">
                                </a>
                            </li>
                            <li data-validation="f">
                                <a href="#tab6" data-toggle="tab" class="step active">
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="tab1">
                                <?= $this->render('selectPz') ?>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <?= $this->render('articleSpecs') ?>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <?= $this->render('lagerOrt')?>
                            </div>

                            <div class="tab-pane" id="tab4">
                                <?= $this->render('fileUpload')?>
                            </div>

                            <div class="tab-pane" id="tab5">
                                <?= $this->render('zeichnung')?>
                            </div>

                            <div class="tab-pane" id="tab6">
                                <?= $this->render('liefer')?>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9" style="float: right;">
                                <a href="javascript:;" class="btn default urteilZuruck">
                                    <i class="fa fa-angle-left"></i> Zurück </a>
                                <a href="javascript:;" class="btn btn-outline green urteilNext"> Weiter
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <a href="javascript:;" class="btn green urteilSubmit"> Absenden
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>