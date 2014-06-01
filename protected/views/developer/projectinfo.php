<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
?>
<?php
/* @var $this DeveloperController  */

$this->breadcrumbs = array(
    $model->title
);
?>
<div class="main-column">
<div id="tabs">
    <a datatype="projectinfo" class="active-tab">Description</a>
    <a datatype="todo">Todos</a>
    <a datatype="mindmap" >Mindmaps</a>
</div>
<div class="form projectinfo hide" id="todo">
    <ul class="todo-lists">
        <?php foreach ($todo as $todo1) {
            echo "<li><a href='index.php?r=developer/todo&id=" . $todo1->todoId . "'>" . $todo1->title . "</a></li>";
        } ?>
    </ul>
    <input type="button" id="create-todo" value="Create New Todo"/>
</div>

<div class="form projectinfo hide" id="mindmap">
        <h2>Mindmap</h2>
        <?php
        if ($mindmap) { ?>
        <div id="map">
            <div id="refresh-wrapper"><input type="button" id="refresh-map" value="Refresh map"/></div>

            
 <?php

                if ($mindmap[count($mindmap) - 1]->img) {
                    echo "<img id='src-map' src='mindmaps/" . $mindmap[count($mindmap) - 1]->img . "'/>";
                }
                ?>
            </div>
            <div class="fr">

                <form action="mindmap/index.php" method="post" target="_blank">
                    <input type="hidden" name="id" value="<?php echo $mindmap[count($mindmap) - 1]->projectId; ?>"/>
                    <input type="hidden" name="json" value='<?php echo $json; ?>'/>
                    <a target="_blank" id="full-map" style="border-bottom: 1px solid #339a63;" class="btn" href='mindmaps/<?php echo $mindmap[count($mindmap) - 1]->img; ?>'>Full size</a>
                    <input type="submit" id="edit-map" value="<?php if ($mindmap[count($mindmap) - 1]->img) {
                    echo "Edit map";
                } else echo "Create map" ?>"/>
                </form>
            
        </div>
            <?php } ?>

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
        
	</div>

<?php $this->endWidget(); ?>
</div>

</div><!-- form -->
</div>
<div class="side-column">
<?php
    $this->renderPartial('navigation', array('model' => $navigation));
?>
    <?php if ($mindmap) { ?>
<div>
    <?php
    echo "<h2>Maps history</h2>";
    echo "<div id='history' class='bgwhite padding20'>";
    foreach ($mindmap as $map) {
        echo "<a target='_blank' href='mindmaps/" . $map->img . "'>" . $map->img . "</a><br>";
    }
    echo "</div>";
    ?>
</div>
    <?php } ?>
</div>
<script>
    $(document).ready(function(){
$("#edit-map").click(function(){
    $("#refresh-wrapper").fadeIn("slow");
    $("#refresh-map").fadeIn("slow");
    $("#refresh-map").click(function(){
        $.ajax({
            url: "index.php?r=developer/refreshMap",
            type: "POST",
            data: { id: <?php echo $mindmap[count($mindmap) - 1]->projectId; ?> },
            success: function(data){
                var json = JSON.parse(data);
                if ($("#src-map").attr("src") !== "mindmaps/"+json.img) {
                
                $("#src-map").attr("src","mindmaps/"+json.img);
                $("#full-map").attr("href","mindmaps/"+json.img);
                $("#history").append("<a target='_blank' href='mindmaps/" +json.img + "'>"+json.img +"</a><br>");
                $("input[name=json]").val(json.json);
            }
                $("#refresh-wrapper").fadeOut("slow");
                $("#refresh-map").fadeOut("slow");
                
            }
        });
    });
});
    $("#create-todo").click(function(){
    var html = "<div id='popup-wrapper'></div>"
                +"<div id='popup'>"
                    +"<div class='popup-head'>"
                        +"<h3>Add New Todo</h3>"
                        +"<span class='close'></span>"
                    +"</div>"
                    +"<div class='popup-body'>"
                        +"<form action='/index.php?r=developer/addtodo' method='POST'>"
                            +"<input type='hidden' name='Todo[projectId]' value='<?php echo $model->projectId ?>'/>"
                            +"<input type='text' placeholder='Todo Title' name='Todo[title]'/>"
                            +"<input type='submit' value='Create'/>"
                        +"</form>"
                    +"</div>"
                +"</div>";
        $("body").append(html);
        $("#popup-wrapper").click(function(){
            $("#popup-wrapper").remove();
            $("#popup").remove();
        });

        $("#popup .close").click(function(){
            $("#popup-wrapper").remove();
            $("#popup").remove();
        });
    });
});
</script>
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
