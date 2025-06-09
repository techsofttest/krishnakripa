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
           Manage Room
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
            
            
            
            
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data">

			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">				
					<div class="box-body">
						 <?php $parent = $this->uri->segment(4); ?>


             <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Room Type<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
                    <select name="type">
                      <option value="">Select</option>

                    </select>      			 
				           </div>
                          </div>
                        
                        
                        <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Title<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    		  <input  class="form-control" name="name"  type="text" required>
       			 
				  </div>
                          </div>
                        
                        
                       
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Service Icon<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	   			 <input  class="form-control" name="image[]"  type="file"  style="width:40%;display:inline-block" required>
        		
					</div>
                          </div>
                          
                          
                          
                <div class="row">
				<div class="col-xs-12 col-sm-3 row-seperate">
				<label>Image<strong style="color:#F00;">*</strong></label>
                </div>
                <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	   			<input  class="form-control" name="image_main[]"  type="file"  style="width:40%;display:inline-block" required>
        	
			    </div>
                </div>
                
                
                
                               
                   
                <div class="row">
				<div class="col-xs-12 col-sm-3 row-seperate">
				<label>Banner<strong style="color:#F00;">*</strong></label>
                </div>
                <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	   			<input  class="form-control" name="image_banner[]"  type="file"  style="width:40%;display:inline-block" required>
        		
			    </div>
                </div>
                
                
                          
                          
                <div class="row">
				<div class="col-xs-12 col-sm-3 row-seperate">
				<label>Description<strong style="color:#F00;">*</strong></label>
                </div>
                <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
       			<textarea class="form-control" id="editor1" name="desc" ></textarea>
       		
				</div>
                </div>
                
                          
                    <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
					<label>Meta Title<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    <input  class="form-control" name="meta_title"  type="text" required>
       
		</div>
                          </div>
                          
                          
                          
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
					<label>Meta Keywords<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    <input  class="form-control" name="meta_keywords"  type="text" required>
       
		</div>
                          </div>
                         
                         
                         
                         
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
					<label>Meta Description<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">
	    <input  class="form-control" name="meta_desc"  type="text" required>
      
		</div>
                          </div>






                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
					<label>Page Scripts (Use Script Tags)<strong style="color:#F00;"></strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">	            
                <textarea class="form-control" name="script"></textarea>
     
		        </div>
                          </div>
                          
              	  

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Add</button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                    	
                  </div>
              </div><!-- /.box -->
			  </form>
              
              
                 
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        <!-- Main content -->
        
        
    
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>



 <script>

  function get_sub(val) {
	
	$.ajax({
		
	type: "POST",
  url:'<?php echo base_url('admin/Categories/GetSub'); ?>', 
	data:'category='+val,
	success: function(data){

		$("#sscat").html(data);

	}
	});
}
  </script>
 
   
 
 
 
  
    
 