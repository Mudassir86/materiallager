<?php
/* @var $this yii\web\View */
?>
<?php

use yii\helpers\Html;

$this->title = 'Lieferant';
$this->params['breadcrumbs'][] = ['label' => 'Neues Material FVWHT', 'url' => ['/fvwht/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="maincontent">
	

	<div class="portlet light " id="form_wizard_1">
		
		<div class="portlet-body form">
			<form class="form-horizontal" id="fvwhtMaterialForm">
				<div class="form-wizard">
					<div class="form-body">
						<ul class="nav nav-pills nav-justified steps materialTabs">
							<li class="active" data-validation="t">
								<a href="#tab1" data-toggle="tab" class="step">
									<span class="number"> 1 </span>
									<span class="desc">
										<i class="fa fa-check"></i> Lieferant </span>
								</a>
							</li>
							<li data-validation="t">
								<a href="#tab2" data-toggle="tab" class="step">
									<span class="number"> 2 </span>
									<span class="desc">
										<i class="fa fa-check"></i> Prüfzeichen </span>
								</a>
							</li>
							<li data-validation="t">
								<a href="#tab3" data-toggle="tab" class="step active">
									<span class="number"> 3 </span>
									<span class="desc">
										<i class="fa fa-check"></i> Werkstoff </span>
								</a>
							</li>
							<li data-validation="f">
								<a href="#tab4" data-toggle="tab" class="step">
									<span class="number"> 4 </span>
									<span class="desc">
										<i class="fa fa-check"></i> Übersicht </span>
								</a>
							</li>
						</ul>
						<div id="bar" class="progress progress-striped" role="progressbar">
							<div class="progress-bar progress-bar-success"> </div>
						</div>
						<div class="tab-content">
							<div class="alert alert-danger display-none">
								<button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
							<div class="alert alert-success display-none">
								<button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
							<div class="tab-pane active" id="tab1">

								<?= $this->render('lieferantTable') ?>
								
							</div>
							<div class="tab-pane" id="tab2">
								<?= $this->render('prufzeichen') ?>
								
							</div>
							<div class="tab-pane" id="tab3">
							<?= $this->render('werkstoff') ?>
							</div>
							
							<div class="tab-pane" id="tab4">
							<?= $this->render('overview') ?>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9" style="float: right;">
								<a href="javascript:;" class="btn default fvwhtMaterialZuruck">
									<i class="fa fa-angle-left"></i> Zurück </a>
								<a href="javascript:;" class="btn btn-outline green fvwhtMaterialNext"> Weiter
									<i class="fa fa-angle-right"></i>
								</a>
								<a href="javascript:;" class="btn green fvwhtMaterialSubmit"> Absenden
									<i class="fa fa-check"></i>
								</a>
							</div>
						</div>
					</div>
					<!--<div class="row" style="float: right;">
						<a class="btn btn-primary" href="">zurück</a>
						<a class="btn btn-primary" href="">weiter</a>
					</div>-->
				</div>
			</form>
		</div>
	</div>
		

</div>