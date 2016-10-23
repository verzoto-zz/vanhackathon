<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/video.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/youtubeapi.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js'); ?>
<script>var video_id = <?php echo CJSON::encode($video_id);?>;</script> 

<style>
    body{overflow:hidden;}
    #youtube .overlay{position:fixed; width:99%;}
</style>

<div ng-app="app" ng-controller="video">
    
    <div id="video" ng-init="GetVideoActions();">
        
        <div id="youtube" >
            
            <div class="overlay">
                <h3>{{currentAction.action_description}}</h3>
                
                <div class="checkbox" ng-repeat="opt in currentAction.options">
                    <label>
                        <input type="radio" ng-model="responses.selected" value="{{opt.option_id}}" > {{ opt.option_text }}
                    </label>
                </div>
                
                <a href="#" ng-click="SendResponses()" class="btn btn-success">Done</a>
                
            </div>
            
            <iframe id="player" class="yt-video" type="text/html" src="<?php echo $video; ?>"></iframe>
        
        </div>
        
    </div>
    
</div>

<script>
    $(function(){
        $('#player, #video').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
    
        // If you want to keep full screen on window resize
        $(window).resize(function(){
            $('#player, #video').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
        });
    });
</script>