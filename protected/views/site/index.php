<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/index.css'); ?>

<div class="spotlight">
	<h1 class="text-center">CREATE AWESOME INTERACTIVE VIDEOS!</h1>
	<li class="text-center">
		<a class="btn btn-success" href="<?php echo $this->createUrl('platform/videos'); ?>">Show Videos!</a>
		<a class="btn btn-info" href="<?php echo $this->createUrl('platform/newvideo'); ?>">Create Videos!</a>
	</li>
</div>

<p class="obs">VanHackathon 2016</p>