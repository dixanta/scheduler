<?php
class Cron extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->module_model('schedule','schedule_model');
		$this->load->module_model('fanpage','fanpage_model');
		$this->load->module_model('content','content_model');				
	}
	
	private function can_post($days)
	{
		$day_names=array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
		//echo date('D');
		$allowed=FALSE;
		for($i=0;$i<7;$i++)
		{
			if(($days[$i]=="1") && (date('D')==$day_names[$i]))
			{
				
				$allowed=TRUE;
				break;
			}
			
		}
		return $allowed;
	}
	
	public function repeat_post()
	{
		echo $time=date('H:i:s');
		$this->schedule_model->joins=array('CONTENTS','FANPAGES');
		$schedules=$this->schedule_model->getSchedules(array('is_repeat'=>1));
		foreach($schedules->result_array() as $schedule)
		{
	
			if($this->can_post($schedule['days']) && $schedule['time']==$time)
			{
				$this->publish($schedule);
				echo "Published";
			}
		}
		
	
	}
	public function auto_post()
	{
		echo $date=date('Y-m-d H:i:s');
		$this->schedule_model->joins=array('CONTENTS','FANPAGES');
		$schedules=$this->schedule_model->getSchedules(array('is_repeat'=>0,'post_date'=>$date));

		if($schedules->num_rows()>0)
		{
		
			foreach($schedules->result_array() as $schedule)
			{
				$this->publish($schedule);
			}
		}
		else
		{
			echo "not found";
		}
	
	}
	
	private function publish($schedule)
	{
				$has_photo=FALSE;
				 $param=array('message'=>$schedule['text'],'access_token'=>$schedule['access_token']);
				 

				 if(!empty($schedule['link']))
				 {
				 	$param['link']=$schedule['link'];
					
				 }
				if(!empty($schedule['image']))
				 {
				 	$file='uploads/content/'.$schedule['image'];
					$param[basename($file)] = new CURLFILE(realpath($file),"image/jpeg");
					$has_photo=TRUE;
					
				 }
				

				try{
					if(!$has_photo){
						 $data=$this->facebook->api('me/feed','POST',$param);
					}
					else
					{
						$data=$this->facebook->api('me/photos','POST',$param);
					}
					 if(!empty($data['id']))
					 {
						$insert_data=array('posted_date'=>date('Y-m-d H:i:s'),'facebook_post_id'=>$data['id'],'schedule_id'=>$schedule['schedule_id']);
						$this->schedule_model->insert('COMPLETED_TASKS',$insert_data);
					 }
				 }
				 catch(Exception $e)
				 {
				 	echo $e->getMessage();
				 }	
	}
}