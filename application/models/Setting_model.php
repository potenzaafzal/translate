<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Location_model class.
 * 
 * @extends CI_Model
 */
class Setting_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
    public function get_languages()
    {
       $this->db->from('languages');
       $this->db->order_by("id", "desc");
       return $this->db->get()->result();
    }
    public function add_language($title,$googlecode)
    {
       $data = array(
			'title'   => $title,
			'googlecode' => $googlecode,
            'created' => date("Y-m-d H:i:s")
		); 
       return $this->db->insert('languages', $data);
    }
    
    public function get_language($id)
    {
       $this->db->from('languages');
	   $this->db->where('id', $id);
	   return $this->db->get()->row();
    }
    
    /*public function get_last_locations(){
        $this->db->from('locations');
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        return $this->db->get()->result();
    }*/
}
