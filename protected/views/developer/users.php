<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php     foreach ($model as $user) {
    echo "<h2><a href='index.php?r=developer/userinfo&id=".$user->id."'>". $user->firstname . " " . $user->lastname . "</a></h2>";

     }
     ?>

<?php $this->endWidget(); ?>

</div><!-- form -->