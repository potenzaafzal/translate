<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin_model class.
 * 
 * @extends CI_Model
 */
class Admin_model extends CI_Model {

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
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $email
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function add_locations($title, $link, $address, $description, $project_title, $project_link, $news_title, $news_link, $feature_img, $gallary, $facebook, $facebook_name, $facebook_page_id, $twitter, $instagram, $instagram_acess_token, $instagram_client_ID) {
		
		$data = array(
			'title'   => $title,
			'link'      => $link,
			'address'   => $address,
			'description' => $description,
            'project_title' => $project_title,
            'project_link' => $project_link,
            'news_title' => $news_title,
            'news_link' => $news_link,
            'feature_img' => $feature_img,
            'gallary' => $gallary,
            'facebook' => $facebook,
            'facebook_name' => $facebook_name, 
            'facebook_page_id' => $facebook_page_id,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'instagram_acess_token' => $instagram_acess_token, 
            'instagram_client_ID' => $instagram_client_ID
		);
		//echo "<pre>"; print_r($data);exit;
		return $this->db->insert('locations', $data);
		
	}
    public function update_locations($id, $title, $link, $address, $description, $project_title, $project_link, $news_title, $news_link, $feature_img, $gallary, $facebook, $facebook_name, $facebook_page_id, $twitter, $instagram, $instagram_acess_token, $instagram_client_ID) {
		
		if($gallary!='' && $feature_img!=''){
        $data = array(
			'title'   => $title,
			'link'      => $link,
			'address'   => $address,
			'description' => $description,
            'project_title' => $project_title,
            'project_link' => $project_link,
            'news_title' => $news_title,
            'news_link' => $news_link,
            'gallary' => $gallary,
            'feature_img' => $feature_img,
            'facebook' => $facebook,
            'facebook_name' => $facebook_name, 
            'facebook_page_id' => $facebook_page_id,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'instagram_acess_token' => $instagram_acess_token, 
            'instagram_client_ID' => $instagram_client_ID
		);
        }elseif($gallary!='' && $feature_img=='' ){
            $data = array(
			'title'   => $title,
			'link'      => $link,
			'address'   => $address,
			'description' => $description,
            'project_title' => $project_title,
            'project_link' => $project_link,
            'news_title' => $news_title,
            'news_link' => $news_link,
            'gallary' => $gallary,
            'facebook' => $facebook,
            'facebook_name' => $facebook_name, 
            'facebook_page_id' => $facebook_page_id,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'instagram_acess_token' => $instagram_acess_token, 
            'instagram_client_ID' => $instagram_client_ID
		);
        }elseif($feature_img!='' && $gallary=='' ){
            $data = array(
			'title'   => $title,
			'link'      => $link,
			'address'   => $address,
			'description' => $description,
            'project_title' => $project_title,
            'project_link' => $project_link,
            'news_title' => $news_title,
            'news_link' => $news_link,
            'feature_img' => $feature_img,
            'facebook' => $facebook,
            'facebook_name' => $facebook_name, 
            'facebook_page_id' => $facebook_page_id,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'instagram_acess_token' => $instagram_acess_token, 
            'instagram_client_ID' => $instagram_client_ID
		);
        }else{
            $data = array(
			'title'   => $title,
			'link'      => $link,
			'address'   => $address,
			'description' => $description,
            'project_title' => $project_title,
            'project_link' => $project_link,
            'news_title' => $news_title,
            'news_link' => $news_link,
            'facebook' => $facebook,
            'facebook_name' => $facebook_name, 
            'facebook_page_id' => $facebook_page_id,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'instagram_acess_token' => $instagram_acess_token, 
            'instagram_client_ID' => $instagram_client_ID
		);
        }
        //echo "<pre>"; print_r($data); exit;
		$this->db->where('id', $id);
        return $this->db->update('locations', $data);
		
		
	}
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {
		
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $username
	 * @return int the user id
	 */
	public function get_user_id_from_username($username) {
		
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('username', $username);

		return $this->db->get()->row('id');
		
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {
		
		$this->db->from('users');
		$this->db->where('id', $user_id);
        $this->db->where('is_admin', '1');
		return $this->db->get()->row();
		
	}
	
    public function get_all_locations()
    {
       $this->db->from('locations');
       return $this->db->get()->result();
    }
    
    public function get_location($id)
    {
       $this->db->from('locations');
		$this->db->where('id', $id);
		return $this->db->get()->row();
    }
	
    /**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}
    
    public function home_detail(){
        $this->db->from('home');
        return $this->db->get()->result();
    }
    
    public function update_home_detail($banner_img, $banner_title, $meta_title, $meta_content, $meta_keyword, $brand_display, $about_img, $about_description) {
        if($banner_img!='' && $about_img!=''){
        $data = array(
			'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_display' => $brand_display,
			'about_img'   => $about_img,
			'about_description' => $about_description
		);
        }elseif($banner_img!='' && $about_img=='' ){
            $data = array(
			'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_display' => $brand_display,
			'about_description' => $about_description
		);
        }elseif($banner_img=='' && $about_img!='' ){
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_display' => $brand_display,
			'about_img'   => $about_img,
			'about_description' => $about_description
		);
        }else{
            $data = array(
			'brand_display' => $brand_display,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'about_description' => $about_description
		);
        
        }
        //echo "<pre>"; print_r($data); exit;
        return $this->db->update('home', $data);
        
        }
        
        public function tire_abcs_detail(){
        $this->db->from('tire_abcs');
        return $this->db->get()->result();
        }
        
        public function update_tire_abcs_detail($banner_img, $banner_title, $meta_title, $meta_content, $meta_keyword, $tire_abcs_description) {
        if($banner_img!=''){
        $data = array(
			'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'content' => $tire_abcs_description
		);
        }else{
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content' => $tire_abcs_description
		);
        
        }
        //echo "<pre>"; print_r($data); exit;
        return $this->db->update('tire_abcs', $data);
        
        }
        
        public function about_detail(){
            $this->db->from('about');
            return $this->db->get()->result();
         }
		
        
        public function update_about_detail($banner_img, $banner_title, $meta_title, $meta_content, $meta_keyword, $content, $content_img, $who_we_are_title, $who_we_are_left, $who_we_are_gallery, $who_we_are_right) {
        if($banner_img!='' && $who_we_are_gallery!='' && $content_img!=''){
        $data = array(
			'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
            'content_img'   => $content_img,
            'who_we_are_title' => $who_we_are_title,
			'who_we_are_left' => $who_we_are_left,
            'who_we_are_gallery' => $who_we_are_gallery,
            'who_we_are_right' => $who_we_are_right
		);
        }elseif($banner_img!='' && $who_we_are_gallery=='' && $content_img!='' ){
            $data = array(
			'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
            'content_img'   => $content_img,
            'who_we_are_title' => $who_we_are_title,
			'who_we_are_left' => $who_we_are_left,
            'who_we_are_right' => $who_we_are_right
		);
        }elseif($banner_img=='' && $who_we_are_gallery!='' && $content_img!=''){
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
            'content_img'   => $content_img,
			'who_we_are_title' => $who_we_are_title,
            'who_we_are_left' => $who_we_are_left,
            'who_we_are_gallery' => $who_we_are_gallery,
            'who_we_are_right' => $who_we_are_right
		);
        }elseif($banner_img!='' && $who_we_are_gallery!='' && $content_img==''){
            $data = array(
            'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
			'who_we_are_title' => $who_we_are_title,
            'who_we_are_left' => $who_we_are_left,
            'who_we_are_gallery' => $who_we_are_gallery,
            'who_we_are_right' => $who_we_are_right
		);
        }elseif($banner_img!='' && $who_we_are_gallery=='' && $content_img==''){
            $data = array(
            'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
			'who_we_are_title' => $who_we_are_title,
            'who_we_are_left' => $who_we_are_left,
            'who_we_are_right' => $who_we_are_right
		);
        }elseif($banner_img=='' && $who_we_are_gallery!='' && $content_img==''){
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
			'who_we_are_title' => $who_we_are_title,
            'who_we_are_left' => $who_we_are_left,
            'who_we_are_gallery' => $who_we_are_gallery,
            'who_we_are_right' => $who_we_are_right
		);
        }elseif($banner_img=='' && $who_we_are_gallery=='' && $content_img!=''){
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
            'content_img'   => $content_img,
			'who_we_are_title' => $who_we_are_title,
            'who_we_are_left' => $who_we_are_left,

            'who_we_are_right' => $who_we_are_right
		);
        }else{
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'content'   => $content,
            'who_we_are_title' => $who_we_are_title,
			'who_we_are_left' => $who_we_are_left,
            'who_we_are_right' => $who_we_are_right
		);
        }
        //echo "<pre>"; print_r($data); exit;
        return $this->db->update('about', $data);
        
        }
		
        public function brand_page_detail(){
            $this->db->from('brand_page');
            return $this->db->get()->result();
         }
         
         public function update_brand_page_detail($banner_img, $banner_title, $meta_title, $meta_content, $meta_keyword,  $page_title) {
        if($banner_img!=''){
        $data = array(
			'banner_img'   => $banner_img,
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'page_title'   => $page_title
		);
        }else{
            $data = array(
			'banner_title'      => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
			'page_title'   => $page_title
		);
        }
        //echo "<pre>"; print_r($data); exit;
        return $this->db->update('brand_page', $data);
        
        }
         public function brands_detail(){
            $this->db->from('brands');
            return $this->db->get()->result();
         }
         public function add_brands($banner_img, $banner_title, $meta_title, $meta_content, $meta_keyword, $brand_name,$brand_img, $brand_description, $brand_pdf,$support_left_title, $support_left_description,$support_right_title,$support_right_description,$warrnty_pdf_link) {
		
		$data = array(
            'banner_img'=> $banner_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name' => $brand_name,
			'brand_logo'   => $brand_img,
			'brand_description'      => $brand_description,
			'brand_pdf_link'   => $brand_pdf,
             'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
		//echo "<pre>"; print_r($data);exit;
		return $this->db->insert('brands', $data);
		
	}
	
	
	//Add Brand Model
	
	 public function add_brand_model($brand_model_title, $brand_name, $brand_model_cat, $brand_model_img, $brand_model_pdf){
		 
		 $data = array(
            'brand_prod__id'=> $brand_name,
            'brand_prod_name' => $brand_model_title,
			'brand_prod_img'   => $brand_model_img,
			'brand_prod_pdf'      => $brand_model_pdf,
			'brand_prod_cat'   => $brand_model_cat,
       
		);
		//echo "<pre>"; print_r($data);exit;
		return $this->db->insert('brand_product', $data);
		
	}
    public function update_brands($id, $banner_img, $banner_title, $meta_title, $meta_content, $meta_keyword, $brand_name, $brand_img, $brand_pdf, $brand_description,$support_left_title, $support_left_description,$support_right_title,$support_right_description,$warrnty_pdf_link) {
        if($brand_img!='' && $brand_pdf!='' && $banner_img!=''){
        $data = array(
            'banner_img'   => $banner_img,
			'brand_img'   => $brand_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_pdf_link'      => $brand_pdf,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }elseif($brand_img!='' && $brand_pdf=='' && $banner_img!=''){
            $data = array(
            'banner_img'   => $banner_img,
			'brand_img'   => $brand_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }elseif($brand_img=='' && $brand_pdf!='' && $banner_img!=''){
            $data = array(
            'banner_img'   => $banner_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_pdf_link'      => $brand_pdf,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }elseif($brand_img!='' && $brand_pdf!='' && $banner_img==''){
            $data = array(
            'brand_img'   => $brand_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_pdf_link'      => $brand_pdf,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }elseif($brand_img!='' && $brand_pdf=='' && $banner_img==''){
            $data = array(
            'brand_img'   => $brand_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }elseif($brand_img=='' && $brand_pdf!='' && $banner_img==''){
            $data = array(
			'brand_pdf_link'      => $brand_pdf,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }elseif($brand_img=='' && $brand_pdf=='' && $banner_img!=''){
            $data = array(
            'banner_img'   => $banner_img,
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }else{
            $data = array(
            'banner_title' => $banner_title,
            'meta_title'=>$meta_title,
            'meta_content'=>$meta_content, 
            'meta_keyword'=>$meta_keyword,
            'brand_name'=>$brand_name,
			'brand_description'   => $brand_description,
            'support_left_title'=>$support_left_title,
             'support_left_description'=>$support_left_description,
             'support_right_title'=>$support_right_title,
             'support_right_description'=>$support_right_description,
             'warrnty_pdf_link'=>$warrnty_pdf_link
		);
        }
        $this->db->where('id', $id);
        return $this->db->update('brands', $data);
        
        }
    public function get_brand($id)
    {
       $this->db->from('brands');
		$this->db->where('id', $id);
		return $this->db->get()->row();
    }
    public function get_brand_name($name)
    {
       $this->db->from('brands');
		$this->db->where('brand_name', $name);
		return $this->db->get()->row();
    }
	public function get_brand1($id)
    {
       $this->db->from('brands');
		$this->db->where('id', $id);
		return array($this->db->get()->row());
    }
	public function get_all_brands(){
		$this->db->from('brands');
        return $this->db->get()->result();
	}
	
	public function get_all_brand_models(){
		$this->db->select('*');
		$this->db->from('brands b'); 
		$this->db->join('brand_product a', 'b.id =a.brand_prod__id');
			return $this->db->get()->result();
	}
	
	public function get_brand_model($id){
		$this->db->select('*');
		$this->db->from('brands b'); 
		$this->db->join('brand_product a', 'b.id =a.brand_prod__id');
		$this->db->where( 'b.id =a.brand_prod__id');
		$this->db->where('b.id',$id);
			return $this->db->get()->result();
	}
		
	public function get_model($id)
    {
       $this->db->from('brand_product');
		$this->db->where('id', $id);
		return $this->db->get()->row();
    }
	
	public function update_brand_model($id,$brand_model_title, $brand_name, $brand_model_cat, $brand_model_img, $brand_model_pdf_name){
		
		if($brand_model_img !='' && $brand_model_pdf_name !=''){
			$data = array(
				'brand_prod__id'=> $brand_name,
				'brand_prod_name' => $brand_model_title,
				'brand_prod_img'   => $brand_model_img,
				'brand_prod_pdf'      => $brand_model_pdf_name,
				'brand_prod_cat'   => $brand_model_cat,
		   
			);
		}
		else if($brand_model_img !=''){
			$data = array(
				'brand_prod__id'=> $brand_name,
				'brand_prod_name' => $brand_model_title,
				'brand_prod_img'   => $brand_model_img,
				'brand_prod_cat'   => $brand_model_cat,
		   
			);
			
		}
		else if($brand_model_pdf_name !=''){
			$data = array(
				'brand_prod__id'=> $brand_name,
				'brand_prod_name' => $brand_model_title,
				'brand_prod_pdf'      => $brand_model_pdf_name,
				'brand_prod_cat'   => $brand_model_cat,
		   
			);
		}
		else if($brand_model_img =='' && $brand_model_pdf_name ==''){
			$data = array(
				'brand_prod__id'=> $brand_name,
				'brand_prod_name' => $brand_model_title,
				'brand_prod_cat'   => $brand_model_cat,
		   
			);
		}
		
		$this->db->where('id', $id);
        return $this->db->update('brand_product', $data);
	}
    public function add_dealer_detail($company_name,$full_name,$your_email,$address,$address2,$city,$state,$postal_code,$country,$annual_sale,$chooseanual,$qty_tires,$chooseqty,$tire_brand){
		 
		 $data = array(
            'company_name'=> $company_name,
            'full_name' => $full_name,
			'email'   => $your_email,
			'address'      => $address,
			'address2'   => $address2,
            'city'   => $city,
            'state'   => $state,
            'postal_code'   => $postal_code,
            'country'   => $country,
            'annual_sale'   => $annual_sale,
            'chooseanual'   => $chooseanual,
            'qty_tires'   => $qty_tires,
            'chooseqty'   => $chooseqty,
            'tire_brand'   => $tire_brand
		);
		//echo "<pre>"; print_r($data);exit;
		return $this->db->insert('dealer', $data);
		
	}
    
    public function get_dealer(){
		$this->db->from('dealer');
        return $this->db->get()->result();
	}
    
    
    public function get_dealerDetail($id)
    {
       $this->db->from('dealer');
		$this->db->where('id', $id);
		return $this->db->get()->row();
    }
    
    public function add_contact_detail($first_name,$last_name,$email,$message){
		 
		 $data = array(
            'first_name'=> $first_name,
            'last_name' => $last_name,
			'email'   => $email,
			'message'      => $message
		);
		//echo "<pre>"; print_r($data);exit;
		return $this->db->insert('contact', $data);
		
	}
    
    public function get_contact(){
		$this->db->from('contact');
        return $this->db->get()->result();
	}
    public function add_tire_registration_detail($customer_name,$customer_address,$customer_address_2,$customer_city,$customer_state,$customer_zip,$customer_country,$seller_business_name,$seller_address,$seller_address2,$seller_city,$seller_state,$seller_zip,$seller_country,$tire_brand,$tire_identification_number,$tire_qty){
		 
		 $data = array(
            'customer_name'=> $customer_name,
            'customer_address' => $customer_address,
			'customer_address_2'   => $customer_address_2,
			'customer_city'      => $customer_city,
			'customer_state'   => $customer_state,
            'customer_zip'   => $customer_zip,
            'customer_country'   => $customer_country,
            'seller_business_name'   => $seller_business_name,
            'seller_address'   => $seller_address,
            'seller_address2'   => $seller_address2,
            'seller_city'   => $seller_city,
            'seller_state'   => $seller_state,
            'seller_zip'   => $seller_zip,
            'seller_country'   => $seller_country,
            'tire_brand'   => $tire_brand,
            'tire_identification_number'   => $tire_identification_number,
            'tire_qty'   => $tire_qty
		);
		//echo "<pre>"; print_r($data);exit;
		return $this->db->insert('tire_registration', $data);
		
	}
	public function get_tire_registration(){
		$this->db->from('tire_registration');
        return $this->db->get()->result();
	}
    
     public function get_tire_registration_Detail($id)
    {
       $this->db->from('tire_registration');
		$this->db->where('id', $id);
		return $this->db->get()->row();
    }
	
}
