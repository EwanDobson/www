<?php
/* @var $this DeveloperController */

$this->breadcrumbs=array(
);
?>
<h1>Nearest events</h1>
<?php 

foreach ($model as $event) {
    ?>
    <article class='project timeline' onclick="location.href='index.php?r=developer/projectinfo&id=<?php echo $event->projectId; ?>'">
        <?php
    echo "<span class='title'>".$event->title . "</span><br>";
    echo "<span class='deadline'>Deadline: " . $event->end . "</span>";
    echo "</article>";
}
?>

