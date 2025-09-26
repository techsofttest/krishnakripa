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
           Manage Add Ons
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
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title"></h2>
					</div>


					<div class="box-body">

						 
          <?php $parent = $this->uri->segment(4); ?>
                       
                        
              <div class="row">
						  <div class="col-xs-12 col-sm-3 row-seperate">
							<label>Name<strong style="color:#F00;">*</strong></label>
                             
              </div>
              <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    		    <input  class="form-control" name="ao_name"  type="text" required>
				      </div>
              </div>



               <div class="row">
						  <div class="col-xs-12 col-sm-3 row-seperate">
							<label>Price<strong style="color:#F00;">*</strong></label>
                             
              </div>
              <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    		    <input  class="form-control" name="ao_price"  type="number" required>
				      </div>
              </div>



              <?php /*
              <div class="row">
						  <div class="col-xs-12 col-sm-3 row-seperate">
							<label>Charge Type<strong style="color:#F00;">*</strong></label>
                             
              </div>

              <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    		    
              <select class="form-control" name="charge_type" required>
                
              <option value="per_booking">Per Booking</option>

              <option value="per_room">Per Room</option>

              <option value="per_person">Per Person</option>

              <option value="per_night">Per Night</option>

              <option value="custom">Custom</option>

              </select>

				      </div>
              
              </div>
              */ ?>
                        
              
              
              <div class="row">

                <div>

                  <divc link-rel=""></divc>

                </div>

              </div>
      

                                  				
				

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Add</button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                    	
                  </div>
              </div><!-- /.box -->
			  </form>
        </section>
        <!-- Main content -->
        
        
    
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 