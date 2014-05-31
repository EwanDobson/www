<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8"> 
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <script src="<?= Yii::app()->request->baseUrl ?>/js/jquery-1.11.1.min.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php /*echo Yii::app()->request->baseUrl; */?>/css/bootstrap-theme.css" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
    <div id="header">
		
	
    <div id="header-left">
        <div id="search-form">
            <form action="">
                <input type="text" placeholder="Search..." name="search" class=""/>
                <input type="submit" value="Search"/>
            </form>
        </div>
        <div id="welcome">
            Welcome <a href=""><?php echo Yii::app()->user->name; ?></a>!
            <?php if(Yii::app()->user->isGuest) {
                $login_url = "'index.php?r=site/login'";
                echo '<input onclick="location.href=' . $login_url .'" id="logout" type="button" value="Login"/>';
            }
            else {
                $login_url = "'index.php?r=site/logout'";
                echo '<input onclick="location.href=' . $login_url . '"id="logout" type="button" value="Logout"/>';
            }
            ?>

        </div>
    </div>
    
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Projects', 'url'=>array('/developer/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Add User', 'url'=>array('/developer/adduser'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->usergroup == 'admin'),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                //array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                array('label'=>'Contact', 'url'=>array('/site/contact')),
			),
		)); ?>
	</div><!-- mainmenu -->
    
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
                <div class="clear"></div>
    </div> 
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php echo date('Y'); ?> &copy; TandM Studio<br/>
		All Rights Reserved<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
