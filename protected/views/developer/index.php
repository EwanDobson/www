<?php
/* @var $this DeveloperController <h1><?php echo $this->id . '/' . $this->action->id; ?></h1> */

$this->breadcrumbs=array(
	'Developer',
);
?>

<div class="padding20">
    <h2></h2>
    <?php if(Yii::app()->user->usergroup == "admin") { ?>
    <article class="add-project" onclick="location.href='index.php?r=developer/addproject'">
        <h2><a href="index.php?r=developer/addproject" title="Add project">Add project</a></h2>
        <span class="plus">+</span>
    </article>
    <?php } ?>
<?php //echo var_dump($model);
foreach ($model as $project) {
    echo "<article class='project'>";
    echo "<h2><a href='index.php?r=developer/projectinfo&id=" . $project->projectId . "' title='" . $project->title . "'>" . $project->title . "</a></h2>";
    echo "<ul class='hierarchy'>";
    if ($project->todo) {
        echo "<li>Todos<ul>";
        foreach ($project->todo as $todo) {
    echo "<li class='todo'><a href='index.php?r=developer/todo&id=" . $todo->todoId . "'>" . $todo->title . "</a></li>";
        }
        echo "</ul></li>";
    }
    if ($project->mindmap) {
        echo "<li class='mindmap'><a href='index.php?r=developer/mindmap&id=" . $project->projectId . "' title='Mindmap'>Mindmap</a></li>";
    }
    echo "</ul>";
    echo "<div><ul class='users'>";
    foreach($user as $user1) {
        if($user1->projectId == $project->projectId) {
            echo "<li class='user'>" . $user1->email . "</li>";
        }
    }
    echo "</ul></div>";
    //echo "<div class='description'>". $project->description . "</div>";
    //echo "<div class='modified'>Last modified:" . $project->modified . "</div>";
    echo "<div class='status'>Status: " . $project->status . "</div>";
    echo "<a href='index.php?r=developer/projectinfo&id=" . $project->projectId . "' class='btn view'>View</a>";
    //echo $project->start . "<br>";
    //echo $project->end . "<br>";
    echo "</article>";
} ?>
    <div class="clear"></div>
</div>

