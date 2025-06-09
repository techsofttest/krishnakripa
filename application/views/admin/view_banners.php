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
           Manage Banners
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
          
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
            
                 
            </div><!-- /.col -->
          </div>
          
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
            
            
            
            
               
             <div class="box">
             
             <div class="box-header with-border">
					  <h2 class="box-title">View Banners</h2>
                     
                      
                      
					</div>
                    
                    
                   
                		<div class="box-body">
			
                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        
                                        <th>Heading</th>
                                         
                                        <th>Banner Image</th>
                                        
                                        <th>Actions</th>
                                       
                                       
                                    </tr>
                                    
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									
									foreach($banner_data as $item=>$val):?>
                       				<tr id="<?php echo $val->ban_id;?>">
					
                          			<td><?php echo $i++; ?></td>
                                    <td><?php echo $val->ban_main_heading; ?></td>
                                   
                                    <td>
                                     <a href="<?php echo base_url();?>uploads/Banners/<?php echo $val->ban_image; ?>" class="fancybox-media">
                  <img src="<?php echo base_url();?>uploads/Banners/<?php echo $val->ban_image; ?>" style="width:170px;height:100px;"></a> 
                                    
                                  </td>
                                    
                                     
                                   
                                  
                                   <td>
                                   
                         				<a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Banners/EditBanner/<?php echo $val->ban_id;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i>  Edit</a><br>
                        
										<!--<a style="color:rgb(102, 102, 102);" href="<?php echo base_url();?>admin/PhotoGallery/DeletePhotoCategory/<?php echo $val->id;?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i style="color:red" class="fa fa-times"></i>  Delete</a>-->
									</td>
                      				</tr>
					  				<?php endforeach;?> 
                    			</tbody> 
                   				
                                <input type="hidden" id="alert-notification" value="Are you sure you want to delete this banner record?">
                  			</table>
                
                		</div><!-- /.box-body -->
              		</div> 
              
              
              
              
              
              
              
              
              
              
              
              
              
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 