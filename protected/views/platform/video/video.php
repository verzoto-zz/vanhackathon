<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/video.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/youtubeapi.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js'); ?>

<script>var video_id = <?php echo CJSON::encode($video_id);?>;</script> 

<div class="container-fluid" ng-app="app" ng-controller="video">
    
    <div id="video" class="col-md-6 col-sm-12" ng-init="GetVideoActions();">
        
        <div id="youtube" class="embed-responsive embed-responsive-16by9">
            
            <div class="overlay">
                <h3>{{currentAction.action_description}}</h3>
                
                <div class="checkbox" ng-repeat="opt in currentAction.options">
                    <label>
                        <input type="radio" ng-model="responses.selected" value="{{opt.option_id}}" > {{ opt.option_text }}
                    </label>
                </div>
                
                <a href="#" ng-click="SendResponses()" class="btn btn-success">Done</a>
                
            </div>
            
            <iframe id="player" class="yt-video embed-responsive-item" type="text/html" src="<?php echo $video; ?>"></iframe>
        
        </div>
        
        <div class="controls">
            <p>Controls</p>
            <li class="pull-left" onclick="player.playVideo();"><i class="material-icons">play_arrow</i></li>
            <li class="pull-left" onclick="player.pauseVideo()"><i class="material-icons">pause</i></li>
            <li class="pull-left" onclick="player.unMute()"><i class="material-icons">volume_up</i></li>
            <li class="pull-left" onclick="player.mute()"><i class="material-icons">volume_off</i></li>
        </div>
        
    </div>
    
    <div id="results" class="col-md-6 col-sm-12">
        
        <h2 class="text-center">{{ responses.action_description }}</h2>
        
        <li ng-repeat="opt in responses">{{ opt.option_text }} - {{ opt.choices }} choices</li>
    </div>

</div>
