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
               
             <div class="box">
             
                   
                		<div class="box-body">
			
                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        
                                         <th>Images</th>
                                      
                                        
                                       
                                    
                                        <th>Actions</th>
                                       
                                       
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									
									foreach($Gallery_data as $item=>$val):?>
                       				
					
                          			<td><?php echo $i++; ?></td>
                                    <td><img src="<?php echo base_url();?>uploads/Gallery/<?php echo $val->gallery_img;?>" height="100px" width="150px" style="object-fit:contain;"/></td>
                                  
                                   
            
                                   <td>
                                   
                    <a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Gallery/EditGallery/<?php echo $val->gallery_id;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i>  Edit</a><br>
                        
										<a style="color:rgb(102, 102, 102);" href="<?php echo base_url();?>admin/Gallery/DeleteGallery/<?php echo $val->gallery_id;?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i style="color:red" class="fa fa-times"></i>  Delete</a>
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
 
   
 
 
 
  
    
 