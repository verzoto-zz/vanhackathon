
<div class="col-md-3 col-md-offset-4">

	<h1>Login</h1>

	<p>Please fill out the following form with your login credentials:</p>

	<div class="form">
		
		<?php 
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); 
		?>
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username', array('class' => 'form-control')); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
			<p class="hint">
				Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
			</p>
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-success btn-block')); ?>
		</div>
	
		<?php $this->endWidget(); ?>
		
	</div>

</div>
