<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/platform/layout.css'); ?>
<!DOCTYPE html>

<html>
	
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!--Google Fonts!-->
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!--Bootstrap!-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		
		<!--Jquery!-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<!--Angular JS!-->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>

	<body>
		
		<header>
			
			<div class="container">
				<li class="title pull-left"><a href="<?php echo $this->createUrl('platform/videos'); ?>">INTERACTIVE VIDEOS</a></li>
				<li class="pull-right"><a href="<?php echo $this->createUrl('platform/newvideo'); ?>">Create your video!</a></li>
			</div>
			
		</header>
		
		<?php echo $content; ?>
		
	</body>

</html>
