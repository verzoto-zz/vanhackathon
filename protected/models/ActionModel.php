<?php

/**
 * VideoModel class.
 * VideoModel is the data structure for keeping
 * 
 */
class ActionModel extends CFormModel
{
	public $action_description;
	public $action_time;


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('action_description, action_time', 'required'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'videoURL'=>'YouTube video URL',
		);
	}
	
	/**
	 * 
	 * 
	 */
	public function AddAction($video_id)
	{
		$sql = Yii::app()->db->createCommand();
		$sql->insert('video_actions', array('video_id' => $video_id, 'action_time' => $this->action_time, 'action_description' => $this->action_description));
		
		if ($sql > 0)
			$id = Yii::app()->db->getLastInsertID();
		else
			$id = null;
			
		return $id;
	}
	
	
	/**
	 * 
	 * 
	 */
	public function AddResponses($action_id, $responses)
	{
		$sql = Yii::app()->db->createCommand();
		
		foreach($responses as $r)
		{
			$sql->insert('action_options', array('action_id' => $action_id, 'option_text' => $r, 'choices' => 0));
		}
		
		return $sql;
	}


	/**
	 * 
	 * 
	 */
	public function GetVideoById($id)
	{
		$sql = Yii::app()->db->createCommand()
			->select('video_url')
			->from('videos')
			->where('video_id = :id', array(':id' => $id))
			->queryRow();
		
		return $sql['video_url'];
	}
	
	

	
}