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
<div id="tabs">
    <a datatype="projectinfo" href="index.php?r=developer/projectinfo&id=<?php echo $model->projectId; ?>" class="active-tab">Description</a>
    <a datatype="todo" href="index.php?r=developer/todo&id=<?php echo $model->projectId; ?>">Todos</a>
    <a datatype="mindmap" href="index.php?r=developer/&id=<?php echo $model->projectId; ?>">Mindmaps</a>
</div>
<div class="form projectinfo hide" id="todo">
    <ul>
        <?php foreach($todo as $todo1) {
            echo "<li><a href='index.php?r=developer/todo&id=" . $todo1->todoId . "'>" . $todo1->title . "</a></li>";
        } ?>
    </ul>
    <a href="index.php?r=developer/addtodo">Create ToDo List</a>
</div>

<div class="form projectinfo hide" id="mindmap">
    <ul>
        <?php foreach($mindmap as $mindmap1) {
            echo "<li><a href='index.php?r=developer/mindmap&id=" . $model->projectId . "'>" . $mindmap1->img . "</a></li>";
        } ?>
    </ul>
    <a href="index.php?r=developer/createmindmap">Create Project Mindmap</a>
</div>

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
                <p><?= $model->description ?></p>

                <?php echo $form->error($model, 'description'); ?>
            </div>
        
            <ul class="users">
                <?php foreach($user as $user1) {
                    echo "<li class='user'>" . $user1->email . "</li>";
                } ?>

                <li class="adduser">
                    <a href="index.php?r=developer/adduser">Add user</a>
                </li>
            </ul>
            
        
        <div class="clear"></div>
    </div>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->label($model,'modified'); ?>
		<?php echo '<span>' . $model->modified . '</span>'; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
        <?php echo '<span>' . $model->status . '</span>'; ?>
	</div>



	<div class="row">
		<?php echo $form->label($model,'start'); ?>
        <?php echo '<span>' . $model->start . '</span>'; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end'); ?>
        <?php echo '<span>' . $model->end . '</span>'; ?>
	</div>


	<div class="row buttons">
		<?php //echo CHtml::submitButton('Submit'); ?>
        <a href="index.php?r=developer/addmindmap"
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
