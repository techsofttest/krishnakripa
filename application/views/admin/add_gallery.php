<?php $this->load->view('admin/includes/header');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage Gallery
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
		<section class="content">
          <div class="row">
            <div class="col-xs-12">  
            
            
             <?php if($this->session->flashdata('success')) {?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('success');?>
				</div>
            	<?php }?>
                <?php if($this->session->flashdata('error')) {?>
				<div class="alert alert-error">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('error');?>
				</div>
            	<?php }?>
            
            
            
            
			<?php echo form_open('',array('method'=>"POST",'enctype'=>"multipart/form-data",'id'=>"add_gallery"))?>
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
				
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>
                          
                        
                       
                         
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">                
                             
	    <input  class="form-control" name="image[]" id="image"  type="file"  style="width:40%;display:inline-block" required>
      Add More: &nbsp&nbsp; <a href="javascript:void(0);" class="add_button" title="Add field">
        <img src="<?php echo base_url();?>assets/admin/img/add-icon.png"/></a>
     
        <br /><br />
		</div>
                          </div>                    
                            
                          
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Add</button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                    	
                  </div>
              </div><!-- /.box -->
		<?php echo form_close()?>
              
              
                 
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        <!-- Main content -->
        
        
    
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 <script type="text/javascript">   
	$(document).ready(function(){
		var maxField = 10; 
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper'); 
		var fieldHTML = '<div> <input class="form-control" name="image[]" multiple type="file" required style="width:40%;display:inline-block">&nbsp&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/></a></div><br>'; //New input field html 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ 
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	});
	
	
</script>
 
 
 
 
  
    
 