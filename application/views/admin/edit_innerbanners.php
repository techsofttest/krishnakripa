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
           Manage Banner
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
            
            
            
            
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >

                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit Banner</h2>
					</div>
					<div class="box-body">
						 
                          <?php $parent = $this->uri->segment(4); ?>



                           <div class="row">
              <div class="col-xs-12 col-sm-3 row-seperate">
                 <label>Title<strong style="color:#F00;">*</strong></label>
              </div>
              <div class="col-xs-12 col-sm-9 row-seperate">
                <input class="form-control" name="title" value="<?php echo $banners_details['title']?>" placeholder="Title" type="text" readonly> 
              </div>
          </div>
                    
                        
                        
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Image<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <input class="form-control" name="image[]"  type="file">
      <img src="<?php echo base_url();?>uploads/Banner/<?php echo $banners_details['image']?>" style="width:100%;height:300px;margin:20px 0px"> 

     (1349 X 450)pixels
     
							</div>
                          </div>
         	  
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="update" id="submitbutton">Update</button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Go back</a>
            
			  </form>
              
         
        </section>
        <!-- Main content -->
     
        
        
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 