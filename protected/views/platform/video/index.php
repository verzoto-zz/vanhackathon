<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/platform/index.css'); ?>

<div class="container">
    
    <?php foreach($videos as $v): ?>
    
        <div class="col-md-3">
            <div class="video-box">
                <li class="text-center title"><?php echo $v['video_title']; ?></li>
                <li class="text-center description"><?php echo $v['video_description']; ?></li>
                <li class="text-center">Created by: <?php echo $v['user_name']; ?></li>
                <li class="text-center"><a href="<?php echo $this->createUrl('platform/video', array('id' => $v['video_id'])); ?>" class="btn btn-success">Watch!</a></li>
            </div>
        </div>
        
    <?php endforeach; ?>

</div>