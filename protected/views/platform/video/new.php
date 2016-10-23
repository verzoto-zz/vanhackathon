<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/app.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/youtubeapi.js'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/platform/form.css'); ?>

<div id="form" class="container" ng-app="app" ng-controller="video">
    
    <div class="col-md-4">
        
        <?php 
            $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'EventoModel',
            	'enableClientValidation'=>true,
            	'clientOptions'=>array(
            		'validateOnSubmit'=>true,
            	),
            )); 
        ?>
        
        <div class="form-group">
            <?php echo $form->label($model,'videoURL'); ?>
            <?php echo $form->textField($model,'videoURL', array('class' => 'form-control', 'ng-model' => 'video.url')) ?>
            <?php echo $form->error($model,'videoURL'); ?>
        </div>
        
        <div class="form-group">
            <?php echo $form->label($model, 'video_title'); ?>
            <?php echo $form->textField($model, 'video_title', array('class' => 'form-control', 'ng-focus' => 'loadVideo()')) ?>
            <?php echo $form->error($model, 'video_title'); ?>        
        </div>
        
        <div class="form-group">
            <?php echo $form->label($model, 'video_description'); ?>
            <?php echo $form->textArea($model, 'video_description', array('class' => 'form-control')) ?>
            <?php echo $form->error($model, 'video_description'); ?>         
        </div>

        <?php echo CHtml::submitButton('Next', array('class' => 'btn btn-success btn-block')); ?>

     
        <?php $this->endWidget(); ?>
    
        
    </div>
    
    <div class="col-md-8">
        <div id="player"></div>
    </div>


</div>