<?php

class Page extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['header'] = 'Facebook Page';
		$data['page'] = $this->config->item('template_admin') . "page/index";
		$data['module'] = 'facebook';
		$this->load->view($this->_container,$data);		
	}
	
	public function json()
	{

		$rows=$this->facebook->api('me/accounts');
		echo json_encode($rows['data']);
	}	
	
	public function import()
	{
		$success=FALSE;
        $this->load->module_model('fanpage','fanpage_model');
        $data['facebook_page_id']=$this->input->post('id');
        $data['facebook_page_name']=$this->input->post('name');
        $data['access_token']=$this->input->post('token');
		if($this->input->post('id'))
		{
			$where=array('facebook_page_id'=>$this->input->post('id'));
		
			if(!$this->fanpage_model->count($where))
			
				$this->fanpage_model->insert('FANPAGES',$data);
				$success=true;
			}else
			{
				$this->fanpage_model->update('FANPAGES',$data,$where);
				$success=true;
			}
		echo json_encode(array('success'=>$success));
	}
}