<?php

class Schedule extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('schedule','schedule_model');
        $this->lang->module_load('schedule','schedule');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'schedule';
		$data['page'] = $this->config->item('template_admin') . "schedule/index";
		$data['module'] = 'schedule';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$this->schedule_model->joins=array('CONTENTS','FANPAGES');
		$total=$this->schedule_model->count();
		paging('schedule_id desc');
		$this->_get_search_param();	
		$rows=$this->schedule_model->getSchedules()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['content_id']!='')?$this->db->where('schedules.content_id',$params['search']['content_id']):'';
			($params['search']['fanpage_id']!='')?$this->db->where('schedules.fanpage_id',$params['search']['fanpage_id']):'';

		}  

		
		if(!empty($params['date']))
		{
			foreach($params['date'] as $key=>$value){
				$this->_datewise($key,$value['from'],$value['to']);	
			}
		}
		               
        
	}

	
	private function _datewise($field,$from,$to)
	{
			if(!empty($from) && !empty($to))
			{
				$this->db->where("(date_format(".$field.",'%Y-%m-%d') between '".date('Y-m-d',strtotime($from)).
						"' and '".date('Y-m-d',strtotime($to))."')");
			}
			else if(!empty($from))
			{
				$this->db->like($field,date('Y-m-d',strtotime($from)));				
			}		
	}	
    
	public function combo_json()
    {
		$rows=$this->schedule_model->getSchedules()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->schedule_model->delete('SCHEDULES',array('schedule_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('schedule_id'))
        {
            $success=$this->schedule_model->insert('SCHEDULES',$data);
        }
        else
        {
            $success=$this->schedule_model->update('SCHEDULES',$data,array('schedule_id'=>$data['schedule_id']));
        }
        
		if($success)
		{
			$success = TRUE;
			$msg=lang('success_message'); 
		} 
		else
		{
			$success = FALSE;
			$msg=lang('failure_message');
		}
		 
		 echo json_encode(array('msg'=>$msg,'success'=>$success));		
        
	}
   
   private function _get_posted_data()
   {
   		$data=array();
        $data['schedule_id'] = $this->input->post('schedule_id');
		$data['content_id'] = $this->input->post('content_id');
		$data['fanpage_id'] = $this->input->post('fanpage_id');
		$data['post_date'] = $this->input->post('post_date');
		$data['is_repeat'] = $this->input->post('is_repeat');
		$data['time'] = $this->input->post('time');
		$days=($this->input->post('sunday'))?"1":"0";
		$days.=($this->input->post('monday'))?"1":"0";
		$days.=($this->input->post('tuesday'))?"1":"0";
		$days.=($this->input->post('wedday'))?"1":"0";
		$days.=($this->input->post('thursday'))?"1":"0";
		$days.=($this->input->post('friday'))?"1":"0";
		$days.=($this->input->post('saturday'))?"1":"0";
		$data['days']=$days;

        return $data;
   }
   
   	
	    
}