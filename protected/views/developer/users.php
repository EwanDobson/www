<?php
/* @var $this UserController */
/* @var $model UserExt */
/* @var $form CActiveForm */
$this->breadcrumbs = array(
    'Users'
);
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
    <div id="tabs">
        <a datatype="clients" class="active-tab">Clients</a>
        <a datatype="developers">Developers</a>
    </div>
    <div id="clients" class="projectinfo">
        <table  class="user-list">
        <thead>
        <th>
            Name
        </th>
        <th>
            Email
        </th>
        <th>
            Current Project
        </th>
    </thead>
    <tbody>
        <?php
        foreach ($model as $user) { 
            if ($user->usergroup == "client") {
                
            
        echo "<tr>";

    echo "<td><a href='index.php?r=developer/userinfo&id=".$user->id."'>". $user->firstname . " " . $user->lastname . "</a></td>";
    echo "<td><a href='mailto:".$user->email."'>".$user->email. "</a></td>";
      echo "<td><a href='index.php?r=developer/projectinfo&id=" . $user->projectId . "'>" . $user->projectName . "</a></td>";


            echo "</tr>";
        }
         } ?>
    </tbody>
    </table>
    </div>
    <div id="developers" class="projectinfo" style="display: none;">
        <table class="user-list">
            <thead>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Current Project
            </th>
            </thead>
            <tbody>
            <?php
            foreach ($model as $user) {
                if ($user->usergroup == "admin") {


                    echo "<tr>";

                    echo "<td><a href='index.php?r=developer/userinfo&id=" . $user->id . "'>" . $user->firstname . " " . $user->lastname . "</a></td>";
                    echo "<td><a href='mailto:" . $user->email . "'>" . $user->email . "</a></td>";
                    echo "<td><a href='index.php?r=developer/projectinfo&id=" . $user->projectId . "'>" . $user->projectName . "</a></td>";


                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$(document).ready(function(){
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