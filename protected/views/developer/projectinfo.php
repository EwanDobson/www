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
                <p style="width: 490px;"><?= $model->description ?></p>
                <?php echo $form->error($model, 'description'); ?>
            </div>

        <a href="index.php?r=developer/editproject&project_id=<?= $model->projectId ?>" class="btn btn-primary">Edit project info</a>
        <span style="font-size: 12px; margin-top: 10px;">(last modified - <?= $model->modified ?>)</span>

        <ul class="users" style="top:60px">
                <?php foreach($user as $user1) {
                    echo "<li class='user'>" . $user1->email . " (" . $user1->usergroup . ")" . "</li>";
                } ?>

            <?php if(Yii::app()->user->usergroup == 'admin'): ?>
                <select id="select_user">
                    <option value="0"></option>
                    <?php foreach($allusers as $user2): ?>
                    <option value="<?= $user2->id ?>"><?= $user2->email ?></option>
                    <?php endforeach; ?>
                </select>
                <li class="adduser">
                    <button id="add_user" class="btn btn-primary">Add user</button>
                </li>
            <?php endif; ?>
            </ul>

        <div class="clear"></div>

        <div class="row" style="margin-top: 15px;">
            <span><b>Status:</b> <?= $model->status ?></span>
        </div>

        <div class="row">
            <span><b>Start date:</b> <?php if($model->start == "0000-00-00") echo 'date not defined';
                else echo $model->start; ?>
            </span>
        </div>

        <div class="row">
            <span><b>Deadline:</b> <?php if($model->end == "0000-00-00") echo 'date not defined';
                else echo $model->end; ?>
            </span>
        </div>

    </div>

<?php $this->endWidget(); ?>
</div>

</div><!-- form -->
<script>
$(document).ready(function(){
    $('#add_user').click(function() {
        var project_id = <?= $model->projectId ?>;
        var user_id = $('#select_user option:selected').val();

        $.ajax({
            type: 'POST',
            url: 'index.php?r=developer/addprojectuser',
            data: {
                project_id: project_id,
                user_id: user_id
            },
            success: function() {
                location.reload();
            }
        });
    });
           /*$(".edit").click(function(){
               var type = $(this).attr("datatype");
               $(this).hide();
               $(".save[datatype="+type+"]").show();
               var selector1 = $(this);
               $("input[name='TblProject["+type+"]']").show();
               $(".save").click(function() {
                   $(selector1).text($("input[name='TblProject["+type+"]']").val());
                   var project_title = $('#TblProject_title').val();
                   alert(project_title);
                   $.ajax({
                       url: 'index.php?r=developer/',
                       data: {

                       },
                       success: function(data){
                           $("#"+id).html(data);
                           $(".projectinfo").hide();
                           $("#"+id).show();
                       }
                   });

                   $("input[name='TblProject["+type+"]']").hide();
                   $(selector1).show();
                   $(this).hide();
               });
           });*/
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
