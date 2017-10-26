<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

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
		
		
	}
	public function index()
	{
	    
        $this->load->helper('form');
        $this->load->helper('url');
        //$this->load->library(array('session'));
        $this->load->library('CSVReader');
		$this->load->library('form_validation');
        // set validation rules
        /*if(!$this->uploadFile()){
        $this->form_validation->set_rules('upload_file', 'File Not Upload', 'required');
        */
        $this->form_validation->set_rules('choose_format', 'choose_format', 'trim|required');
        $this->form_validation->set_rules('choose_lang', 'choose_lang', 'trim|required');
		
        $data = new stdClass();
        if($this->input->post('submit')){
            
            if ($this->form_validation->run() === false) {
        			$this->load->view('welcome_message');
        			
      		}else{
                $upload_file = $this->uploadFile();
                $file_path = 'assets/upload/'.$upload_file['file_name'];
                $file_name = $upload_file['raw_name'];
                $lan= $this->input->post('choose_lang');
                $format = $this->input->post('choose_format');
                $api_key = 'AIzaSyCxqhEddzJBJ96IB_KDpx7ajYDqSZCZqJA';
                $source="en";
                $target=$lan;
        
                //$csv = Reader::createFromPath('sample.csv');

                /*$csv = $this->csvreader->parse_file($file_path); //path to csv file
                $contents=array();
                
                foreach ($csv as $index => $row) {
                    $row = explode(":",$row[0]);
                    //echo "<pre>"; print_r($row);
                    $val = isset($row[1]) ? str_replace('"','',$row[1]) : null;
                    if($val){
                    $contents[$row[0]] = $val;
                    }
                }*/
				//read json file 
				$json=file_get_contents($file_path);
				$contents_input=json_decode($json);
				
                //echo "<pre>"; print_r($contents); exit;exit;
                foreach($contents_input as $key=>$value){
                	$str = $this->translate($api_key,$value,$target,$source);
                    //echo $str.'<br>';
					$str=html_entity_decode($str,ENT_QUOTES);
					$obj=json_decode($str);
                	if($obj != null)
                	{
                		if(isset($obj->error))
                		{
                			$contents[$key]="ERROR";
                			//echo "Error is : ".$obj['error']['message'];
                		}
                		else
                		{
                			$contents[$key]=$obj->data->translations[0]->translatedText;
							//$contents[$key]=str_replace("'","", $contents[$key]);
                            //echo $obj->data->translations[0]->translatedText.'<br>';
                		}
                	}
                	else
                	{
                		$contents[$key]="ERROR";  
                	}
                }
               // echo "<pre>"; print_r($contents); exit;
                if($format=='json'){
                    
                    $str=json_encode($contents,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
					
                    //file create 
                    $my_file = 'assets/output/'.$lan.'.json';
                    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
                    //$data = htmlspecialchars_decode($str);
                    //echo "<pre>"; print_r($data); exit;
                    fwrite($handle,$str);
                    header('Content-disposition: attachment; filename='.$lan.'.json');
                    header('Content-Type: application/json;charset=utf-8');
                    echo $str;
                    //$this->session->set_flashdata('response',"Thank you! Your File Was Translate Successfullly. ");
                    //redirect(base_url());
                    //end
                }else{
                
                    
                    $my_file = 'assets/output/'.$lan.'.csv';
                    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
                    
                    fputcsv($handle, array(
                        'Label',
                        'Value'
                    ));
                
                    foreach ($contents as $key => $value) {
                        
                        fputcsv($handle, array($key,$value));
                    }
                
                    fclose($handle);
                    header("Content-disposition: attachment; filename=".$lan.".csv");
                    header('Content-Type: application/csv; charset=UTF-8');
                    echo file_get_contents($my_file);
                    exit;
                }
            }
        }
        else {
            $this->load->view('welcome_message');
        }
	}
    
    public function translate($api_key,$text,$target,$source=false)
    {
        $url = 'https://www.googleapis.com/language/translate/v2?key=' . $api_key . '&q=' . rawurlencode($text);
    	
        $url .= '&target='.$target;
        if($source)
         $url .= '&source='.$source;
    	return $obj=file_get_contents($url);
    } 
    
    public function uploadFile(){
        // echo "<pre>";
			// print_r($_FILES);
		// echo "</pre>";
		// die;
        $upload_path= "./assets/upload";
        /*if(!file_exists($upload_path)) 
        {
                   mkdir($upload_path, 0777, true);
        }*/
        $p_config = array(
        'upload_path' => $upload_path,
        'allowed_types' => "*",
        'overwrite' => TRUE,
        'max_size' => "4048000"
        );
        $this->load->library('upload', $p_config);
        if(!$this->upload->do_upload('upload_file'))
        { 
			echo $this->upload->display_errors();
            $data['imageError'] =  $this->upload->display_errors();
            return $image = '';
        }
        else
        {
            $imageDetailArray = $this->upload->data();
            //echo "<pre>"; print_r($imageDetailArray); exit;
            return $imageDetailArray;
        }
    
    }
     
}
