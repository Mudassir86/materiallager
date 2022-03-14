<?php

/* @var $this yii\web\View */

$this->title = 'Warehouse Management System';
?>

<?php
	$msg = yii::$app->getSession()->getFlash('success');
	if (null !==$msg): ?>
	<div class="alert alert-success"> <?= $msg; ?>	</div>
	<?php endif; ?>

<div class="site-index">

	<div class="jumbotron">
  		<h1 class="display-4">Warehouse Management System</h1>
 		<p class="lead">This is a sample unit. Featured content is in progress.</p>
  		<hr class="my-4">
  		<p>Bitte melden Sie sich an</p>
	</div>
	
	<div class="body-content">
   		<img src="https://www.mpa-ifw.tu-darmstadt.de/media/mpa_ifw/grafiken_04/aktuelles_13/cra.jpg+" class="img-thumbnail" alt="Responsive image">
    </div>

</div>
