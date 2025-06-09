<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
           Manage Attractions
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
							 <label>Title<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	    <input class="form-control" name="title"  placeholder="Title" type="text" required>	
							</div>
                          </div>                        
                          
                     
                          
                    <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Description <strong style="color:#F00;">*</strong> </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             
							  <textarea class="form-control" name="desc"  id="editor1" rows="5" cols="40" type="text"></textarea>	
							</div>
                          </div>   
                          
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Meta Title <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="meta_title"required></textarea>	
							</div>
                          </div>
                          
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Meta Keyword <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="meta_key"  required></textarea>	
							</div>
                          </div>
                          
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Meta Description<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="meta_desc"  required></textarea>	
							</div>
                          </div>
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate">
	    <input  class="form-control" name="image[]"  type="file"  style="width:40%;display:inline-block" required>
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
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 