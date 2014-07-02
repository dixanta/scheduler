<?php

class Report extends Admin_Controller
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
		$id=$this->input->get('id');
		$data['header'] = 'Schedule Report::';
		$data['page'] = $this->config->item('template_admin') . "report/index";
		$data['module'] = 'schedule';
		$this->schedule_model->joins=array('SCHEDULES','CONTENTS','FANPAGES');
		$data['completed_tasks']=$this->schedule_model->getCompletedTasks(array('completed_tasks.schedule_id'=>$id))->result_array();
		$this->load->view($this->_container,$data);		
	}
}