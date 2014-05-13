<?php
/* @var $this DeveloperController */

$this->breadcrumbs=array(
	'Developer'=>array('/developer'),
	'Mindmap',
);
?>
<div class="main-column" id="mindmap">
    <h2>Mindmap</h2>
    <div id="map">
        <div id="refresh-wrapper"><input type="button" id="refresh-map" value="Refresh map"/></div>
        
<?php if ($model) {

  if ($model[count($model)-1]->img) {
      echo "<img id='src-map' src='mindmaps/".$model[count($model) - 1]->img."'/>";
  }
  ?>
</div>
    <div class="fr">
        
            <form action="mindmap/index.php" method="post" target="_blank">
                <input type="hidden" name="id" value="<?php echo $model[count($model) - 1]->projectId; ?>"/>
                <input type="hidden" name="json" value='<?php echo $json; ?>'/>
                <a target="_blank" id="full-map" style="border-bottom: 1px solid #339a63;" class="btn" href='mindmaps/<?php echo $model[count($model) - 1]->img; ?>'>Full size</a>
                <input type="submit" id="edit-map" value="<?php if ($model[count($model)-1]->img) { echo "Edit map"; } else echo "Create map"?>"/>
            </form>
        </div>
        </div>

<?php if ($navigation) {
      $this->renderPartial('navigation', array('model' => $navigation)); 
  } ?>
<div class="side-column">
<?php
  echo "<h2>Maps history</h2>";
  echo "<div id='history' class='bgwhite padding20'>";
        foreach ($model as $map) {
      echo "<a target='_blank' href='mindmaps/" . $map->img . "'>".  $map->img."</a><br>";
    }
    echo "</div>";
} ?>
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
            data: { id: <?php echo $model[count($model) - 1]->projectId; ?> },
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
});
</script>

