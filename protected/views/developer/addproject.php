<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>

<div class="form">
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script>
        $(function() {
            $( ".start_date" ).datepicker({ dateFormat: "yy-mm-dd" });
            $( ".end_date" ).datepicker({ dateFormat: "yy-mm-dd" });
        });
    </script>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-addproject-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
        <?php
            //getdate($model->start);
            //$model->start = date("Y-m-d",strtotime($model->start ));

            echo $form->textField($model,'start', array('class'=>'start_date'));
        ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end'); ?>
        <?php
            //$model->end = date("d-M-Y",strtotime($model->end ));
            echo $form->textField($model,'end', array('class'=>'end_date'));
        ?>
		<?php echo $form->error($model,'end'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->