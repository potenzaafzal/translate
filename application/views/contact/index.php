<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $setting[0]->contact_meta_title; ?></title>

<meta name="description" content="<?php echo $setting[0]->contact_meta_content; ?>"/>

  <meta name="keywords" content="<?php echo $setting[0]->contact_meta_keyword; ?>"/>

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->





<!-- Bootstrap -->

<link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />

<link href="<?= base_url('assets/css/font-awesome.min.css');?>" rel="stylesheet">

<link href="<?= base_url('assets/css/magnific-popup.css');?>" rel="stylesheet" type="text/css" />

<link href="<?= base_url('assets/css/owl.carousel.css');?>" rel="stylesheet" type="text/css" />

<link href="<?= base_url('assets/css/potenza-style.css');?>" rel="stylesheet" type="text/css" />

<link href="<?= base_url('assets/css/default.css');?>" rel="stylesheet" type="text/css" />

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,600,400italic,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

</head>

<body>

<div class="top-bar text-white" style="background: rgba(255, 255, 255, 0.0);">

 <div class="container">

    <div class="row">

        <div class="col-sm-7"><?php echo $setting[0]->topbar_text; ?></div>

        <div class="col-sm-5 text-right">

            <div class="">

             <ul class="list-inline">

                    <li><a href="#"><i class="fa fa-phone pr-1" aria-hidden="true"></i><?php echo $setting[0]->topbar_phone; ?></a></li>

                    <li><a href="#"><i class="fa fa-fax pr-1" aria-hidden="true"></i><?php echo $setting[0]->topbar_fax; ?></a></li>

             </ul>

            </div>

        </div>

    </div>

 </div>

</div>

<?php //echo "<pre>"; print_r($setting); ?>

<header class="site-header" data-spy="affix" data-offset-top="55" >

        <div id="header-wrap">

          <div class="container">

            <div class="logo">

              <a href="<?php echo base_url(); ?>"><img class="img-responsive" width="200" src="<?= base_url('assets/images/'.$setting[0]->logo);?>" alt=""></a>

            </div>  

            <div class="navbar-header">

                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                      <span class="sr-only">Toggle navigation</span>

                      <span class="icon-bar"></span>

                      <span class="icon-bar"></span>

                      <span class="icon-bar"></span>

                      </button>

                </div>

            <div class="navigation-wrap">

            

                <div id="navbar" class="navbar-collapse  collapse" aria-expanded="false" style="height: 0px;">

                    <ul class="nav navbar-nav">

                      <li class="active"><a href="<?= base_url() ?>">Home</a></li>

                      <li><a href="<?= base_url('about') ?>">About us</a></li>

                     <li class="dropdown">

                            <a href="<?= base_url('brand') ?>" class="dropdown-toggle">Our Brands <span class="caret"></span></a>

                            

                            <ul class="dropdown-menu">

                            <?php 

                            foreach($setting['brand'] as $brand_menu){ ?>

                            <li class="mb-1"><a href="<?=base_url('brands/'.$brand_menu->brand_name);?>"><?=ucfirst($brand_menu->brand_name);?></a></li>

                            <?php } ?>

                            </ul>

                          </li>

                      <li><a href="<?= base_url('dealer') ?>">Become a Dealer</a></li>

                      <li><a href="<?= base_url('tire-registration') ?>">Tire Registration</a></li>

                      <li><a href="<?= base_url('contact') ?>">Contact Us</a></li>

                    </ul>

                  </div>

            </div>

          </div>          

        </div>    

</header>

<section class="banner halfscreen py-0 " >

<div class="banner" style="background: url('<?= base_url("assets/images/".$brand[0]->banner_img);?>') no-repeat 0 0;background-size: cover;background-position: center center;">

   <div class="ver-center">

    <div class="container">

      <div class="row">

          <div class="col-sm-12">

          <div class="intro-banner-text">

           <h3 class="text-white text-uppercase"><?php echo 'Contact US';//$brand[0]->banner_title; ?></h3>

           </div>

          </div>             

      </div>

     </div>

  </div>

</div>

</section>



<div class="main-content">



<section class="client small-section">

  

     <div class="container">

       <div class="row">

<div class="text-center">

<?php ///echo "<pre>"; print_r($brands); ?>

<?php foreach($brands as $brandd){ ?>

    <div class="col-sm-3">

        <div class="client-icon white-bg">

            <a href="<?php echo base_url('brands/'.$brandd->brand_name); ?>">

                <img style="display: inline-block;" class="img-responsive" src="<?php echo base_url('assets/images/'.$brandd->brand_logo); ?>" alt=""/>

            </a>

        </div>

    </div>

<?php } ?>







  </div> </div> 



</section>



  <section class="grey-bg">

     <div class="container">

     <div class="row">

     <?php if (validation_errors()) : ?>

			<div class="col-md-12">

				<div class="alert alert-danger" role="alert">

					<?= validation_errors() ?>

				</div>

			</div>

     <?php endif; ?>

     <?php if (isset($error)) : ?>

			<div class="col-md-12">

				<div class="alert alert-danger" role="alert">

					<?= $error ?>

				</div>

			</div>

     <?php endif; ?>

     <?php if($this->session->flashdata('response')): ?>

       <div class="col-md-12">

			<div class="alert alert-success" role="alert">

                <?php echo $this->session->flashdata('response'); ?> 

            </div>

		</div>

     <?php endif; ?>

    

       <div class="col-sm-12">

        <div class="contact-text text-center">

         <h2>Contact Us By Phone, Mail, or Email</h2>

         <p>Please submit the email form below, and your request will be routed to the appropriate representative.</p>

         </div>

       </div>

     </div>

       <div class="row mt-7">

         <div class="col-sm-8">

         <?php echo form_open_multipart(); ?>

         <div class="row">

        <div class="col-sm-6">

          <div class="form-group">

            <label for="exampleInputFirstName"></label>

            <input type="first name" value="<?=$first_name?>" name="first_name" class="form-control" id="exampleInputFirstName" placeholder="First Name">

          </div>

        </div>

        <div class="col-sm-6">

          <div class="form-group">

            <label for="exampleInputLastName"></label>

            <input type="last name" value="<?=$last_name?>" name="last_name" class="form-control" id="exampleInputLastName" placeholder="Last Name">

          </div>

        </div>

         <div class="col-sm-12">

          <div class="form-group">

            <label for="exampleInputEmail1"></label>

            <input type="email" class="form-control" value="<?=$email?>"  name="email" id="exampleInputEmail3" placeholder="Email">

          </div>

        </div>

       

        <div class="col-sm-12">

          <div class="form-group">

           <label for="exampleInputMassage"></label>
            <?php echo $message; ?>
           <textarea class="form-control" name="message" placeholder="Message" rows="4"><?=$message?> </textarea>

         </div>

        </div>

      <?php // Captcha is only shown if not already solved

		if (!$captchaSolved) { ?>

			

			<div class="col-sm-6">

            

			<?php echo $captchaHtml; ?>

			<?php echo form_input(

				array(

					'name'        => 'CaptchaCode',

					'id'          => '',

                    'class'       => 'form-control',

					'value'       => '',

					'maxlength'   => '100',

					'size'        => '35',

					'style'		  => 'height: 25px',
                    
                    'placeholder'  => 'Enter the characters above here'

				)

			);?>

			</div>

			<?php echo form_error('CaptchaCode'); ?>

		<?php }; // end if(!$captchaSolved) ?>

        <div class="col-sm-12">

         <input class="btn btn-primary btn-lg" name="submit" type="submit" value="Send"/>

        </div>

      </div>

      </form>

       

         </div>



         <div class="col-sm-4 contact_detail_box">

         <?php echo $setting[0]->footer_box3;?>

         <?php echo $setting[0]->footer_box4;?>



         </div>

       </div>

     </div>

   </section>



</div>

<style>

.contact_detail_box a{color:black;}

.contact_detail_box h4{display:none;}

</style>