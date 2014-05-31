<?php
/* @var $this DeveloperController */

$this->breadcrumbs=array(
	'Developer'=>array('/developer'),
	'UserInfo',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
        
<table>
    <tr>
        <td>First Name: </td>
        <td><?php echo $user->firstname; ?></td>
    </tr>
    <tr>
        <td>Last Name: </td>
        <td><?php echo $user->lastname; ?></td>
    </tr>
    <tr>
        <td>email: </td>
        <td><?php echo $user->email; ?></td>
    </tr>
    <tr>
        <td>User group: </td>
        <td><?php echo $user->usergroup; ?></td>
    </tr>
    <?php if ($user->projectId) { ?>
    <tr>
        <td>Project Id: </td>
        <td><?php echo $user->projectId; ?></td>
    </tr>
    <?php } ?>

</table>
</p>
