<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * BackendPro
 *
 * A website backend system for developers for PHP 4.3.2 or newer
 *
 * @package         BackendPro
 * @author          Adam Price
 * @copyright       Copyright (c) 2008
 * @license         http://www.gnu.org/licenses/lgpl.html
 * @link            http://www.kaydoo.co.uk/projects/backendpro
 * @filesource
 */

// ---------------------------------------------------------------------------

/**
 * Site_Controller
 *
 * Extends the default CI Controller class so I can declare special site controllers.
 * Also loads the BackendPro library since if this class is part of the BackendPro system
 *
 * @package         BackendPro
 * @subpackage      Controllers
 */
class Site_Controller extends CI_Controller
{
	var $_container;
	function __construct()
	{
		parent::__construct();

		// Load Base CodeIgniter files

		$this->load->helper(array('html','language'));
		// Load Base BackendPro files
		$this->load->config('settings');
		$this->lang->load('backendpro');
		//$this->load->model('base_model');

		// Load site wide modules
		$this->load->module_library('status','status');
		$this->load->module_model('preferences','preference_model','preference');
		$this->load->module_library('site','bep_site');
		$this->load->module_library('site','bep_assets');
		
		$this->load->module_library('auth','userlib');

		// Display page debug messages if needed
		if ($this->preference->item('page_debug'))
		{
			$this->output->enable_profiler(TRUE);
		}
		$this->facebook_init();
		// Set site meta tags
		//$this->bep_site->set_metatag('name','content',TRUE/FALSE);
		$this->output->set_header('Content-Type: text/html; charset='.config_item('charset'));
		$this->bep_site->set_metatag('content-type','text/html; charset='.config_item('charset'),TRUE);
		$this->bep_site->set_metatag('robots','all');
		$this->bep_site->set_metatag('pragma','cache',TRUE);

		// Load the SITE asset group
		$this->bep_assets->load_asset_group('SITE');

		log_message('debug','BackendPro : Site_Controller class loaded');
	}

	private function facebook_init()
	 {
	  $config=array(
		'appId'  => $this->preference->item('facebook_app_id'),
		'secret' => $this->preference->item('facebook_app_secret'),
		'cookie' => TRUE,
		'fileUpload'=>TRUE
	  ); 
			$this->load->add_package_path(APPPATH.'third_party/facebook/'); 
	  $this->load->library('facebook',$config);
	  
	  $fbuser = $this->facebook->getUser();
	  try{
	   if($fbuser){
		$this->facebookUser=$this->facebook->api('/me');
	   }
	  }catch(Exception $e){
	   $this->facebookUser=NULL;
	   session_destroy();
	  }  
	 }	
}


include_once("Admin_Controller.php");
include_once("Public_Controller.php");
include_once("Member_Controller.php");
include_once("API_Controller.php");
/* End of file MY_Controller.php */
/* Location: ./system/application/libraries/MY_Controller.php */