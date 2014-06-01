<?php
/* @var $this DeveloperController */

$this->breadcrumbs=array(
        'Users'=> array('developer/users'),
        $user->email,
);
?>
<h1><?php echo $user->email; ?></h1>

<p>
<form id="form" action="index.php?r=developer/saveuser" method="POST">
<table id="user-info">
    <tr>
        <td>First Name: </td>
        <td>
            <span class="value firstname"><?php echo $user->firstname; ?></span>
            <input name="User[firstname]" value="<?php echo $user->firstname; ?>"/>
            <input type="hidden" name="User[id]" value="<?php echo $user->id; ?>"/>
        </td>
    </tr>
    <tr>
        <td>Last Name: </td>
        <td>
            <span class="value lastname"><?php echo $user->lastname; ?></span>
            <input name="User[lastname]" value="<?php echo $user->lastname; ?>"/>
        </td>
    </tr>
    <tr>
        <td>email: </td>
        <td>
            <span class="value email"><?php echo $user->email; ?></span>
            <input name="User[email]" value="<?php echo $user->email; ?>"/>
        </td>
    </tr>
    <tr>
        <td>User group: </td>
        <td>
            <span class="value usergroup"><?php echo $user->usergroup; ?></span>
            <select name="User[usergroup]">
                <?php if ($user->usergroup == "client") { ?>
                <option value="client" selected="selected">Client</option>
                <option value="admin">Admin</option>
                <?php } else { ?>
                <option value="client">Client</option>
                <option value="admin" selected="selected">Admin</option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <?php if ($user->projectId) { ?>
    <tr>
        <td>Current Project: </td>
        <td>
            <span class="value projectId"><?php echo $projectName; ?></span>
            <select name="User[projectId]">
                <?php foreach ($projects as $project) {
     if ($project->projectId == $user->projectId) {
     echo "<option value='" . $project->projectId . "' selected='selected'>" . $project->title . "</option>";
                        } else {
                    echo "<option value='".$project->projectId."'>".$project->title."</option>";
                        }
                } ?>
            </select>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td></td>
        <td><input type="button" value="Edit" class="edit-user"/></td>
    </tr>
</table>
</form>  
</p>
<script>
$(document).ready(function(){
    $(".edit-user").click(function(e){
        $(".value").hide();
        $("#user-info *[name^=User]").show();
        $(this).removeClass("edit-user");
        $(this).addClass("save-user");
        $(this).val("Save");
        $(this).attr("type", "submit");
        e.preventDefault();
        $(".save-user").click(function(){
            $("#form").submit();
        });
    });
});
</script>