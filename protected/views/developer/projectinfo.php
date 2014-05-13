<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>
<?php
/* @var $this DeveloperController  */

$this->breadcrumbs = array(
    'Developer',
);
?>
<div class="main-column">
<div id="tabs"><a datatype="projectinfo" href="index.php?r=developer/projectinfo&id=<?php echo $model->projectId; ?>" class="active-tab">Description</a><a datatype="todo" href="index.php?r=developer/todo&id=<?php echo $model->projectId; ?>">Todos</a></div>
<div class="form projectinfo hide" id="todo">sadsad</div>
<div class="form projectinfo" id="projectinfo">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-projectinfo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>
    <div class="bgwhite padding20 title relative">
            <div class="row">
                <h1 class="edit" datatype="title"><?php echo $model->title; ?></h1>
                <?php echo $form->textField($model, 'title'); ?>
                <input type="button" class="save" datatype="title" value="Save"/>
                <?php echo $form->error($model, 'title'); ?>
            </div>
            <div class="row">
                <?php echo $form->textField($model, 'description'); ?>
                <?php echo $form->error($model, 'description'); ?>
            </div>
        
            <ul class="users">
                <li class='user'>Maksym</li>
                <li class="adduser"><form><input type="text" name="email" placeholder="email"/><input type="submit" value="Add"/></form></li>
            </ul>
            
        
        <div class="clear"></div>
    </div>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



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
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end'); ?>
		<?php echo $form->textField($model,'end'); ?>
		<?php echo $form->error($model,'end'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

</div><!-- form -->
<script>
$(document).ready(function(){
           $(".edit").click(function(){
               var type = $(this).attr("datatype");
               $(this).hide();
               $(".save[datatype="+type+"]").show();
               var selector1 = $(this);
               $("input[name='TblProject["+type+"]']").show();
               $(".save").click(function() {
                   $(selector1).text($("input[name='TblProject["+type+"]']").val());
                   $("input[name='TblProject["+type+"]']").hide();
                   $(selector1).show();
                   $(this).hide();
               });
           });
           $("#tabs a").click(function(e){
               e.preventDefault();
               var id = $(this).attr("datatype");
               $(".active-tab").removeClass("active-tab");
               $(this).addClass("active-tab");
               /*$.ajax({
                   cache: false,
                   url: $(this).attr("href"),
                   success: function(data){
                       $("#"+id).html(data);
                       $(".projectinfo").hide();
                       $("#"+id).show();
                   } 
                 
               });*/
                       
                       $(".projectinfo").hide();
                       $("#"+id).show();
               return false;
           });
           
});
</script>
