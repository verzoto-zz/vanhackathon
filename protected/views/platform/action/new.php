<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/platform/form.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/youtubeapi.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js'); ?>

<div id="form" class="container" ng-app="app" ng-controller="form">
    
    <div class="col-md-12 text-center video">
        
        <?php if (Yii::app()->user->hasFlash('success')):?>
            <div class="alert alert-success" role="alert"><?php echo Yii::app()->user->getFlash('success'); ?></div>
        <?php elseif (Yii::app()->user->hasFlash('error')):?>
            <div class="alert alert-danger" role="alert"><?php echo Yii::app()->user->getFlash('success'); ?></div>
        <?php endif; ?>
        
        <iframe id="player" type="text/html" width="640" height="390"  src="<?php echo $videoURL; ?>"  frameborder="0"></iframe>
    </div>
    
    <?php 
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'ActionModel',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
    	    'validateOnSubmit'=>true,
        ),
        )); 
    ?>
    
    <div>
        <div class="row">
            
            <div class="col-md-12">
                
                <div class="form-group" >
                    <label>Type a question</label>
                    <input type="text" class="form-control" name="ActionModel[action_description]">
                </div>
    
                <div class="form-group">
                    <label>Choose when the question pop up (in seconds)</label>
                    <input type="range" name="ActionModel[action_time]" ng-model="form.seconds" min="1" max="{{GetVideoDuration()}}">
                    <p>{{form.seconds | secondsToDateTime | date: 'mm:ss'}}</p>
                </div>            
                
            </div>
            
            <div class="col-md-12">
                <a href="#" ng-click="AddResponse()" class="btn btn-default">Add Choises</a>
            </div>
            
            <div class="col-md-2" ng-repeat="r in response track by $index">
                
                <div class="form-group">
                    <label>Choise {{$index+1}}</label>
                    <input type="text" name="ActionModel[choises][{{$index}}]" class='form-control'>
                </div>
                
            </div>
            
            <?php echo CHtml::submitButton('Next', array('class' => 'btn btn-success btn-block')); ?>
            
        </div>
    </div>
    
    
    <?php $this->endWidget(); ?>
    
</div>