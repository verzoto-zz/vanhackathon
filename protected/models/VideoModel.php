<?php

/**
 * VideoModel class.
 * VideoModel is the data structure for keeping
 * 
 */
class VideoModel extends CFormModel
{
	public $videoURL;
	public $video_title;
	public $video_description;


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('videoURL, video_title, video_description', 'required'),
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
	 */
	public function AddVideo()
	{
		$url = $this->videoURL;
		$url = explode("watch?v=", $url);
		$url = $url[0].'embed/'.$url[1].'?enablejsapi=1';
		$this->videoURL = $url;
		
		$sql = Yii::app()->db->createCommand();
		$sql->insert('videos', array('video_url' => $this->videoURL, 'video_title' => $this->video_title, 'video_description' => $this->video_description, 'video_user'=> Yii::app()->user->getId()));
		
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
	public function GetAllVideos()
	{
		$sql = Yii::app()->db->createCommand()
			->select('V.video_id, V.video_url, V.video_title, V.video_description, U.user_name')	
			->from('videos V')
			->join('user U', 'U.user_id = V.video_user')
			->queryAll();
		
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
	
	
	/**
	 * 
	 * 
	 */
	public function GetActionsByVideo($video_id)
	{
		$sql = Yii::app()->db->createCommand()
			->select('action_id, action_time, action_description')
			->from('video_actions')
			->where('video_id = :video', array(':video' => $video_id))
			->queryAll();
	
		foreach($sql as $key => $s)
		{
			$options = $this->GetActionsOptions($s['action_id']);
			if (!empty($options))
				$sql[$key]['options'] = $options;
		}
	
		return $sql;
	}
	
	
	/**
	* 
	* 
	*/
	public function GetChoicesByAction($action_id)
	{
		$sql = Yii::app()->db->createCommand()
			->select('option_text, choices')
			->from('action_options')
			->where('action_id = :action', array(':action' => $action_id))
			->queryAll();
		
		return $sql;
	}
	
	
	
	public function UpdateChoice($option_id)
	{
		$connection=Yii::app()->db;
		$sql = "UPDATE action_options SET choices = choices+1 WHERE option_id = '".$option_id."'";
		$command = $connection->createCommand($sql);
		$rowCount = $command->execute();

		return $rowCount;
	}
	 
	/**
	 * 
	 * 
	 */
	private function GetActionsOptions($action_id)
	{
		$sql = Yii::app()->db->createCommand()
			->select('option_id, option_text')
			->from('action_options')
			->where('action_id = :action', array(':action' => $action_id))
			->queryAll();
	
		return $sql;
	 }
	
}