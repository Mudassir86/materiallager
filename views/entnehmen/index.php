<?php

use yii\helpers\Html;
use yii\helpers\LinkPager;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = 'Material Entnehmen';
$this->params['breadcrumbs'][] = ['label' => 'Material Entnehmen', 'url' => ['/entnehmen/index']];
?>

<div class="maincontent">

    <div class="portlet light " id="form_wizard_entnehmen">

        <div class="portlet-body form">
            <form class="form-horizontal" id="matEntnehmenForm">
                <div class="form-wizard">
                    <div class="form-body" style=" padding-top: 0px;">
                        <ul class="nav nav-pills nav-justified steps matEntnehmenTabs" style="margin-top: -30px;padding: 0px;margin-bottom: 0px;">
                            <li class="active" data-validation="t">
                                <a href="#tab1" data-toggle="tab" class="step">
                                </a>
                            </li>
                            <li data-validation="t">
                                <a href="#tab2" data-toggle="tab" class="step">
                                </a>
                            </li>

                            <li data-validation="f">
                                <a href="#tab3" data-toggle="tab" class="step">
                                </a>
                            </li>

                            <li data-validation="t">
                                <a href="#tab4" data-toggle="tab" class="step">
                                </a>
                            </li>

                            <li data-validation="f">
                                <a href="#tab5" data-toggle="tab" class="step active">
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="tab1">
                                <?= $this->render('entnehmenSelectPz') ?>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <?= $this->render('matType') ?>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <?= $this->render('entnehmenMenu') ?>
                            </div>

                            <div class="tab-pane entnehmenTab4" id="tab4">

                            </div>

                            <div class="tab-pane" id="tab5">
                                <?= $this->render('interneAuftrag') ?>
                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9" style="float: right;">
                                <a href="javascript:;" class="btn default matEntnehmenZuruck">
                                    <i class="fa fa-angle-left"></i> Zurück </a>
                                <a href="javascript:;" class="btn btn-outline green matEntnehmenNext"> Weiter
                                    <i class="fa fa-angle-right"></i>
                                </a>
                                <a href="javascript:;" class="btn green matEntnehmenSubmit"> Absenden
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