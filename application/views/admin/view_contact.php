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
           Manage Contact
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
            
            
                  
              
             <div class="box">
             
             <div class="box-header with-border">
					  <h2 class="box-title">View Contact</h2>
					</div>
                		<div class="box-body">
			
                  			<table id="datatable" class="table table-bordered table-striped delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        
                                                                      
                                  <th>Address</th>
                                  <th>Residency </th>
                                  <th>Executive stay</th>
                                  <th>Thaza</th>
								                  <th>Email</th>
                                  <th>Actions</th>
                                    </tr>
                    			</thead>
                    			
                                <tbody>
                    				<?php $i=1;?>
                    				<?php 
									
									foreach($contact_data as $item=>$val):?>
                       				<tr id="<?php echo $val->id;?>">
					
                          			<td><?php echo $i++; ?></td>
                                    
                                    <td><?php echo $val->maddress; ?></td>                  			
                                    
                                    <td><?php echo $val->phone; ?></td>									
                                    <td><?php echo $val->phone2; ?></td> 
                                    <td><?php echo $val->phone3; ?></td> 
									
                                    <td><?php echo $val->email; ?></td>

                                 
        <td>	<a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Contact/EditContact/<?php echo $val->id;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i>  Edit</a>
									</td>
									
                      				</tr>
					  				<?php endforeach;?> 
                    			</tbody>                   				
                              
                  			</table>
                
                		</div><!-- /.box-body -->
              		</div> 
              
              
                         
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        
        
        
               
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
   
 
 
 
  
    
 