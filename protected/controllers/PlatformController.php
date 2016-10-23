<?php

class PlatformController extends Controller
{
	public $layout = "platform_layout";
	
	
	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	

	public function accessRules()
	{

		return array(
			
			array('deny',
				'actions' => array('newvideo'),
				'users' => array('?'),
			),
			
			array('allow',
				'users' => array('?'),
			),

		);

	}
	
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	
	public function actionIndex()
	{
		$this->redirect('videos');
	}
	
	
	/**
	 * 
	 * 
	 */
	public function actionVideo($id)
	{
		$model = new VideoModel();
		$this->render('video/video', array('video' => $model->GetVideoById($id), 'video_id' => $id));
	}
	
	
	/**
	 * 
	 * 
	 */
	 public function actionVideos()
	 {
	 	$model = new VideoModel();
	 	$this->render('video/index', array('videos' => $model->GetAllVideos()));
	 }
	 
	
	/**
	 * 
	 * 
	 */ 
	public function actionNewVideo()
	{
		$model = new VideoModel();
		
		if (isset($_POST['VideoModel']))
		{
			
			$model->attributes = $_POST['VideoModel'];
			if ($model->validate())
			{
				$insert = $model->AddVideo();
				if (!empty($insert))
					$this->redirect(array('platform/newaction', 'id' => $insert));
			}
			
		}
		
		$this->render('video/new', array('model' => $model));
	}
	
	
	/**
	 * 
	 * 
	 * 
	 */
	 public function actionNewAction($id)
	 {
	 	$model = new ActionModel();
	 	
	 	if (isset($_POST['ActionModel']))
	 	{
	 		$model->attributes = $_POST['ActionModel'];

	 		if ($model->validate())
	 		{
	 			$insert = $model->AddAction($id);

	 			if (!empty($insert))
	 			{
	 				if ($model->AddResponses($insert, $_POST['ActionModel']['choises']) > 0)
	 					Yii::app()->user->setFlash('success', "Done!");
	 				else
	 					Yii::app()->user->setFlash('error', "Failed.");
	 			}
	 		}
	 		
	 		
	 	}
	 	
	 	$this->render('action/new', array('videoURL' => $model->GetVideoById($id)));
	 }
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}