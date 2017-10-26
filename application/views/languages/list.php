<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
    .form-group {
    margin: 15px;
    text-align: left;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: bold;
    width:10%;
}
.form-control {
    border-radius: 0;
    box-shadow: none;
    /*height: 49px;*/
}
	</style>
<link href="<?= base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/css/font-awesome.min.css');?>" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
</head>
<body>

<div id="container">

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
    
    <?php /* if($this->session->flashdata('response')): ?>

       <div class="col-md-12">

			<div class="alert alert-success" role="alert">

                <?php echo $this->session->flashdata('response'); ?> 

            </div>

		</div>

     <?php endif; */?>
        
	<h1>Add New Language
    </h1>

	<?php echo form_open_multipart('languages'); ?>
    <!--<form enctype="multipart/form-data" method="post" accept-charset="utf-8" action="http://localhost:8080/translate_ci/">-->
		<div class="col-sm-12">
          <div class="form-group">
            <label for="">Language Title :</label>
            <input type="text" name="lang_title" class="form-control" placeholder="Language Title"/>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            <label for="">Google Code :</label>
            <input type="text" name="googlecode" class="form-control" placeholder="Google Code"/>
          </div>
        </div>	
       <div class="form-group">
					<input type="submit" name="submit" class="btn btn-default" value="Add"/>
	   </div>

       <div class="col-sm-12">
       <table id="datatable" class="table table-striped table-hover-warning">
        <thead>
            <?php // sortable headers ?>
            <tr>
                <td>
                  Title
                </td>
                <td>
                  Google Code 
                </td>
                <td class="">
                    Action    
                </td>
        </tr>  
       </thead>
        <tbody>
<?php //echo "<pre>"; print_r($languages); exit; ?>
            <?php if($languages) { 
                foreach($languages as $language){
                ?>
                <tr>
                       <td>
                            <?php echo $language->title; ?>
                       </td>
                       <td>
                            <?php echo $language->googlecode; ?>
                        </td>
                       
                         <td style="width: 12%;">
                            <a href="<?=base_url('editLanguage/'.$language->id)?>" class="btn btn-success tooltips" data-id="<?php echo $language->id; ?>"  title="<?php echo 'delete'; ?>" data-toggle="tooltip"><span class="glyphicon glyphicon-edit"></span> <?php  echo ''; ?></a>
                            <a class="btn btn-success lang_delete tooltips" data-id="<?php echo $language->id; ?>"  title="<?php echo 'delete'; ?>" data-toggle="tooltip"><span class="glyphicon glyphicon-remove"></span> <?php  echo ''; ?></a>
                        </td>
                    </tr>
            <?php }} else { ?>
                <tr>
                    <td colspan="12">
                        <?php echo 'no_results'; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
$('#datatable').DataTable();
} );
$(".lang_delete").click(function(){
         var url="<?php echo base_url();?>"; 
           var id = $(this).attr('data-id');
           var r=confirm("Do you want to delete this?");
            if (r==true){
              window.location = url+"/langDelete/"+id;
            }else{
              return false;
            }
        });
</script>
</body>
</html>