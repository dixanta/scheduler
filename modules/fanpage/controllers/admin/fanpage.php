<?php

class Fanpage extends Admin_Controller
{
    protected $uploadPath = 'uploads/pictures';
    protected $uploadthumbpath= 'uploads/pictures/thumb/';
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('fanpage','fanpage_model');
        $this->lang->module_load('fanpage','fanpage');
        $this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'fanpage';
		$data['page'] = $this->config->item('template_admin') . "fanpage/index";
		$data['module'] = 'fanpage';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->fanpage_model->count();
		paging('facebook_page_name');
		$this->_get_search_param();	
		$rows=$this->fanpage_model->getFanpages()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['facebook_page_id']!='')?$this->db->like('facebook_page_id',$params['search']['facebook_page_id']):'';
			($params['search']['facebook_page_name']!='')?$this->db->like('facebook_page_name',$params['search']['facebook_page_name']):'';
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
		$rows=$this->fanpage_model->getFanpages()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->fanpage_model->delete('FANPAGES',array('fanpage_id'=>$row));
            endforeach;
		}
	}    
    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('fanpage_id'))
        {
			$data['added_date']=date('Y-m-d H:i:s');
            $success=$this->fanpage_model->insert('FANPAGES',$data);
        }
        else
        {
			$data['modified_date']=date('Y-m-d H:i:s');
            $success=$this->fanpage_model->update('FANPAGES',$data,array('fanpage_id'=>$data['fanpage_id']));
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
        $data['fanpage_id'] = $this->input->post('fanpage_id');
		$data['facebook_page_id'] = $this->input->post('facebook_page_id');
		$data['facebook_page_name'] = $this->input->post('facebook_page_name');
		$data['access_token'] = $this->input->post('access_token');
		$data['status'] = $this->input->post('status');

        return $data;
   }
   
   
   	function upload_image(){
		//Image Upload Config
		$config['upload_path'] = $this->uploadPath;
		$config['allowed_types'] = 'gif|png|jpg';
		$config['max_size']	= '102400';
		$config['remove_spaces']  = true;
		//load upload library
		$this->load->library('upload', $config);
        //print_r($_FILES);
        //exit;
		if(!$this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors('','');
			echo json_encode($data);
		}
		else
		{
		  $data = $this->upload->data();
 		  $config['image_library'] = 'gd2';
		  $config['source_image'] = $data['full_path'];
          $config['new_image']    = $this->uploadthumbpath;
		  //$config['create_thumb'] = TRUE;
		  $config['maintain_ratio'] = TRUE;
		  $config['height'] =100;
		  $config['width'] = 100;

		  $this->load->library('image_lib', $config);
		  $this->image_lib->resize();
		  echo json_encode($data);
	    }
	}
    
    function upload_delete(){
		//get filename
		$filename = $this->input->post('filename');
		@unlink($this->uploadPath . '/' . $filename);
        @unlink($this->uploadthumbpath . '/' . $filename);    
	} 
	    
}