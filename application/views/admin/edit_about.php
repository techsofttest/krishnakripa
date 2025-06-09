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
           Manage About
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit About</h2>
					</div>
					<div class="box-body">
						     
         
		 
					
                           <div class="row">
                 <div class="col-xs-12 col-sm-3 row-seperate">
               <label>Heading <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
      <input class="form-control" name="heading"  value="<?php echo $cms_data['about_heading']; ?>"  type="text" required>  
              </div>
                          </div>
		 
		 
                          
                      <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Description <span style="color:red">*</span></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="description" id="editor1" required><?php echo $cms_data['about_desc']; ?></textarea>	
							</div>
                          </div>
                             <?php if(!empty($cms_data['about_image_left'])){?>
						              
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Image</label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <a href="<?php echo base_url();?>uploads/<?php echo $cms_data['about_image_left'];?>" class="fancybox-media">
                              <img src="<?php echo base_url();?>uploads/<?php echo $cms_data['about_image_left'];?>" style="width:150px;height:150px;background-color: #0c0000;padding: 10px;"></a> 
							
							</div>
                          </div>
                          
                          
                          
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Update Image<strong style="color:#F00;"></strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate">
	              <input  class="form-control" name="image_left[]"  type="file"  style="width:40%;display:inline-block">
        <br /><br />
        
		</div>
        
        </div>
        <?php } ?>

        <?php if(!empty($cms_data['about_image_right'])){?>
		  <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>2nd Image</label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <a href="<?php echo base_url();?>uploads/<?php echo $cms_data['about_image_right'];?>" class="fancybox-media">
                              <img src="<?php echo base_url();?>uploads/<?php echo $cms_data['about_image_right'];?>"  style="width:150px;height:150px;background-color: #0c0000;padding: 10px;"></a> 
							
							</div>
                          </div>

        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Update 2nd Image<strong style="color:#F00;"></strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-3 row-seperate">
	              <input  class="form-control" name="image_right[]"  type="file"  style="width:40%;display:inline-block">
        <br /><br />
        
		</div>
        
        </div>
      <?php } ?>

      <!-- <?php if(!empty($cms_data['url'])){?>
      <div class="row">
                 <div class="col-xs-12 col-sm-3 row-seperate">
               <label>Url <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
      <input class="form-control" name="url"  value="<?php echo $cms_data['url']; ?>"  type="text" required>  
              </div>
                          </div>

                          <?php } ?>
		  -->
						   

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Update</button>
					 <a href="javascript:history.go(-1)" class="btn btn-primary">Go back</a>
                  </div>
              </div><!-- /.box -->
			  </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

