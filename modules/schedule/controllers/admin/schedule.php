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
		$total=$this->schedule_model->count();
		paging('schedule_id');
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
			($params['search']['schedule_name']!='')?$this->db->like('schedule_name',$params['search']['schedule_name']):'';
(isset($params['search']['is_repeat']))?$this->db->where('is_repeat',$params['search']['is_repeat']):'';
(isset($params['search']['status']))?$this->db->where('status',$params['search']['status']):'';

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
			$data['created_date']=date('Y-m-d H:i:s');
            $success=$this->schedule_model->insert('SCHEDULES',$data);
			
			$schedule_id=$this->db->insert_id();
			$this->insert_timing($this->input->post('time'),$schedule_id);

        }
        else
        {
            $success=$this->schedule_model->update('SCHEDULES',$data,array('schedule_id'=>$data['schedule_id']));
			$this->schedule_model->delete('SCHEDULE_TIMINGS',array('schedule_id'=>$data['schedule_id']));
			$this->insert_timing($this->input->post('time'),$data['schedule_id']);			
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
	
	private function insert_timing($time_array,$schedule_id)
	{
			foreach($time_array as $time_key=>$time_value)
			{
				foreach($time_value as $t)
				{
					if($t!=''){
						$timing_data=array('schedule_id'=>$schedule_id,'day'=>$time_key,'time'=>$t);
						$this->schedule_model->insert('SCHEDULE_TIMINGS',$timing_data);
					}
				}
			}	
	}
   
   private function _get_posted_data()
   {
   		$data=array();
        $data['schedule_id'] = $this->input->post('schedule_id');
		$data['schedule_name'] = $this->input->post('schedule_name');
		$data['is_repeat'] = $this->input->post('is_repeat');
		$data['status'] = $this->input->post('status');

        return $data;
   }
   
   	
	    
}