<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct() {
		
		parent::__construct();
		$this->load->model('setting_model');
		
	}
	public function index()
	{
	    $data = new stdClass();
        
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library(array('session'));
        $this->load->library('CSVReader');
		$this->load->library('form_validation');
        $data->languages = $this->setting_model->get_languages();
        // set validation rules
        $this->form_validation->set_rules('lang_title', 'lang title', 'trim|required');
        $this->form_validation->set_rules('googlecode', 'googlecode', 'trim|required');
		
        if($this->input->post('submit')){
            
            if ($this->form_validation->run() === false) {
        			$this->load->view('languages/list',$data);
        			
      		}else{
                $title= $this->input->post('lang_title');
                $googlecode = $this->input->post('googlecode');
                
                if ($this->setting_model->add_language($title,$googlecode)) {
    				$this->session->set_flashdata('response',"Thank you! Your New Language Add Successfully");
                    redirect(base_url('languages'));
     			} else {
        			  $this->load->view('languages/list',$data);
                }
            }
        }
        else {
            $this->load->view('languages/list',$data);
        }
	}
    
    
}  