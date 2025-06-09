<?php $this->load->view('admin/includes/header');?>
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

        <!-- Main content -->
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
            
            
            
            
            
            
            
            
			<?php echo form_open('',array('method'=>"POST",'enctype'=>"multipart/form-data"))?>
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">				
					<div class="box-body">
						  
                         
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							<label> Image <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	  <img src="<?php echo base_url(); ?>uploads/Gallery/<?php echo $photo_data['gallery_img']; ?>" height="150px" width="200px"/>	
							</div>
                          </div>
                          
                        
                         
                     
                   <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    <input  class="form-control" name="image[]"  type="file"  style="width:40%;display:inline-block">
        <br /><br />
		</div>
                          </div>
                  
                      
                      
                       		</div>
                          </div>
                          
             
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
					 <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                  </div>
             
			  <? echo form_close();?>
                    </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
     </div>
 <?php $this->load->view('admin/includes/footer');?>
