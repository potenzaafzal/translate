<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * User class.

 * 

 * @extends CI_Controller

 */

class Contact extends CI_Controller {



	/**

	 * __construct function.

	 * 

	 * @access public

	 * @return void

	 */

	public function __construct() {

		

		parent::__construct();

		$this->load->library(array('session'));

		$this->load->helper(array('url'));

		$this->load->model('admin_model');

		$this->load->model('setting_model');

		

	}

	

	

	public function index() {

	  

	    $data = new stdClass();

        // load the BotDetect Captcha library and set its parameter

        $this->load->library('botdetect/BotDetectCaptcha', array(

            'captchaConfig' => 'ContactCaptcha'

        ));

        $this->load->helper('form');

    	$this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $validationConfig = array(

            array( // Captcha code user input validation rules

                'field'   => 'CaptchaCode', 

                'label'   => 'Captcha code', 

                'rules'   => 'callback_captcha_validate'

            )

        );

        $this->form_validation->set_rules($validationConfig);

       

 

        if($this->input->post('submit')){

              //echo "<pre>"; print_r($_POST);

                if ($this->form_validation->run() === false) {

                    $this->botdetectcaptcha->Reset(); 

        			if (!$this->botdetectcaptcha->IsSolved) {

                        $data->captchaSolved = false;

                        $data->captchaHtml = $this->botdetectcaptcha->Html();

                    } else {

                        $data->captchaSolved = true;

                        $data->captchaHtml = '';

                    }
                    $data->first_name  = $this->input->post('first_name');

                    $data->last_name = $this->input->post('last_name');

                    $data->email = $this->input->post('email');

                    $data->message = $this->input->post('message');
                    
                    
        			$data->setting = $this->setting_model->setting_detail();

                    $data->brand = $this->admin_model->brand_page_detail();

                    $data->brands = $this->admin_model->brands_detail();

                    //$this->load->view('header',$data);

                    //$this->load->view('banner');

                   	$this->load->view('generation/contact/index',$data);

                   	$this->load->view('footer',$data);

        			

        		} else {

                    $first_name  = $this->input->post('first_name');

                    $last_name = $this->input->post('last_name');

                    $email = $this->input->post('email');

                    $message = $this->input->post('message');

                    

                    

                    if ($this->admin_model->add_contact_detail($first_name,$last_name,$email,$message)) {

    				$this->session->set_flashdata('response',"Thank you! Your message was successfully sent and a representative from Generation Tires will get back to you in a timely manner. ");

                    

                    redirect(base_url('contact'));

    				

        			} else {

        			   $this->botdetectcaptcha->Reset(); 

                        if (!$this->botdetectcaptcha->IsSolved) {

                            $data->captchaSolved = false;

                            $data->captchaHtml = $this->botdetectcaptcha->Html();

                        } else {

                            $data->captchaSolved = true;

                            $data->captchaHtml = '';

                        }

   

    				    $data->setting = $this->setting_model->setting_detail();

                        $data->brand = $this->admin_model->brand_page_detail();

                        $data->brands = $this->admin_model->brands_detail();

                        //$this->load->view('header',$data);

                        //$this->load->view('banner');
                        $first_name  = $this->input->post('first_name');

                        $last_name = $this->input->post('last_name');
    
                        $email = $this->input->post('email');
    
                        $message = $this->input->post('message');

                       	$this->load->view('generation/contact/index',$data);

                       	$this->load->view('footer',$data);

        				

        			}

	

        		}  

        }else{

            $this->botdetectcaptcha->Reset(); 

        if (!$this->botdetectcaptcha->IsSolved) {

            $data->captchaSolved = false;

            $data->captchaHtml = $this->botdetectcaptcha->Html();

        } else {

            $data->captchaSolved = true;

            $data->captchaHtml = '';

        }

        $data->first_name  = '';

        $data->last_name = '';

        $data->email = '';

        $data->message = '';

        $data->setting = $this->setting_model->setting_detail();

        $data->brand = $this->admin_model->brand_page_detail();

        $data->brands = $this->admin_model->brands_detail();

        //$this->load->view('header',$data);

        //$this->load->view('banner');

       	$this->load->view('generation/contact/index',$data);

       	$this->load->view('footer',$data);	

        }

	}

    // Captcha validation callback used in form validation

  public function captcha_validate($code)

  {

    // user considered human if they previously solved the Captcha...

    $isHuman = $this->botdetectcaptcha->IsSolved;

    if (!$isHuman) {

      // ...or if they solved the current Captcha

      $isHuman = $this->botdetectcaptcha->Validate($code);

    }



    // set error if Captcha validation failed

    if (!$isHuman) {

      $this->form_validation->set_message('captcha_validate', 'Please retype the characters from the image correctly.');

    }



    return $isHuman;

  }

  public function index1()

    {

        // load the BotDetect Captcha library and set its parameter

        $this->load->library('botdetect/BotDetectCaptcha', array(

            'captchaConfig' => 'ContactCaptcha'

        ));



        $this->load->helper(array('form', 'url'));

        $this->load->library(array('form_validation', 'email'));



        $this->form_validation->set_error_delimiters('<p class="validation_errors">', '</p>');



        $validationConfig = array(

            array(

                'field'   => 'Email', 

                'label'   => 'Email', 

                'rules'   => 'required|valid_email'

            ),

            array(

                'field'   => 'Message', 

                'label'   => 'Message', 

                'rules'   => 'required|min_length[6]'

            ),

            array( // Captcha code user input validation rules

                'field'   => 'CaptchaCode', 

                'label'   => 'Captcha code', 

                'rules'   => 'callback_captcha_validate'

            )

        );

        $this->form_validation->set_rules($validationConfig);



        $data['emailSent'] = false;



        if ($_POST) {

            // run form validation when the form is submitted

            if ($this->form_validation->run() == true) {

                // the form validation (including Captcha validation) passed, send email;

                // we'll include some code showing how to send mail from CodeIgniter, but

                // please note that this code is not production safe, and is simplified 

                // for the purposes of this sample

                $from = $this->input->post('email');

                $message = $this->input->post('message');



                $this->email->from($from);

                $this->email->to('TODO: email address of recipient'); 

                $this->email->subject('TODO: subject');

                $this->email->message($message);  

                // TODO: uncomment only after you have configured your email settings

                //$this->email->send();



                // reset Captcha status after each email sent, since we don't want the user to

                // be able to send an unlimited number of emails after solving the Captcha once

                $this->botdetectcaptcha->Reset(); 



                $data['emailSent'] = true;

            } else {

                // the form validation failed, don't send email

            }

        }



        // the Captcha is not shown if the user already solved it but validation of

        // other form fields failed

        if (!$this->botdetectcaptcha->IsSolved) {

            $data['captchaSolved'] = false;

            $data['captchaHtml'] = $this->botdetectcaptcha->Html();

        } else {

            $data['captchaSolved'] = true;

            $data['captchaHtml'] = '';

        }



        $this->load->view('botdetect/contact', $data);

    }



	

}

