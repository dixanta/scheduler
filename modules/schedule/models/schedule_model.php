<?php
class Schedule_model extends MY_Model
{
	var $joins=array();
    public function __construct()
    {
    	parent::__construct();
        $this->prefix='tbl_';
        $this->_TABLES=array('SCHEDULES'=>$this->prefix.'schedules','FANPAGES'=>$this->prefix.'fanpages',
							 'CONTENTS'=>$this->prefix.'contents','COMPLETED_TASKS'=>$this->prefix.'completed_tasks'
							 );
		$this->_JOINS=array('FANPAGES'=>array('join_type'=>'LEFT','join_field'=>'schedules.fanpage_id=fanpages.fanpage_id',
                                           'select'=>'fanpages.*','alias'=>'fanpages'),
                           'CONTENTS'=>array('join_type'=>'LEFT','join_field'=>'schedules.content_id=contents.content_id',
                                           'select'=>'contents.*','alias'=>'contents'),
                           'SCHEDULES'=>array('join_type'=>'INNER','join_field'=>'schedules.schedule_id=completed_tasks.schedule_id',
                                           'select'=>'schedules.*','alias'=>'schedules'),										   
                            );        
    }
    
    public function getSchedules($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
       $fields='schedules.*';
       
		foreach($this->joins as $key):
			$fields=$fields . ','.$this->_JOINS[$key]['select'];
		endforeach;
                
        $this->db->select($fields);
        $this->db->from($this->_TABLES['SCHEDULES']. ' schedules');
		
		foreach($this->joins as $key):
                    $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
		endforeach;	        
        
		(! is_null($where))?$this->db->where($where):NULL;
		(! is_null($order_by))?$this->db->order_by($order_by):NULL;

		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();	    
    }
	
	public function getCompletedTasks($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
	{
       $fields='completed_tasks.*';
       
		foreach($this->joins as $key):
			$fields=$fields . ','.$this->_JOINS[$key]['select'];
		endforeach;
                
        $this->db->select($fields);
        $this->db->from($this->_TABLES['COMPLETED_TASKS']. ' completed_tasks');
		
		foreach($this->joins as $key):
                    $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
		endforeach;	        
        
		(! is_null($where))?$this->db->where($where):NULL;
		(! is_null($order_by))?$this->db->order_by($order_by):NULL;

		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();		
	}
	
    
    public function count($where=NULL)
    {
		
        $this->db->from($this->_TABLES['SCHEDULES'].' schedules');
        
        foreach($this->joins as $key):
        $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        
       
       (! is_null($where))?$this->db->where($where):NULL;
		
        return $this->db->count_all_results();
    }
}