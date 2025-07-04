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
           Manage Customers
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
            
                		<div class="box-body">
                        
                            <div class="loader">
                  			
                            <table id="datatable" class="table table-bordered table-striped delTable" style="display:none;">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        
                                         <th>Full Name</th>    
                                     
                                         <th>Phone</th>

                                         <th>Email</th>

                                         <th>Address</th>

                                         <th>Total Bookings</th>

                                         <th>Actions</th>
                                       
                                    </tr>
                    			</thead>
                    			
                        
                          <tbody>
                                
                    				<?php $i=1;?>
                    				
									      <?php 
									
									      foreach($customers as $item=>$val):?>

                        <tr>
                       			
                        <td class=""><?= $i ?></td>
                                        
                        <td><?=  $val->first_name ?> <?= $val->last_name ?></td>    
                    
                        <td><?= $val->phone_number ?></td>

                        <td><?= $val->email_address ?? "" ?></td>

                        <td><?= $val->address ?> </td>

                        <td><b>0</b></td>

                        <td>
                          <a class="btn btn-danger"><i class="fa fa-ban"></i> Block</a>
                        </td>

                        </tr>
                                    
					  				    <?php 
                        $i++; 
                        endforeach;
                        ?> 
                                    
                      </tbody> 
                   				
                                
                  	</table>
                            
                             </div>
                			
                            
                			
                		</div><!-- /.box-body -->
              		</div> 
              
              
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        
        
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>
 
 <script>
 
	$('#datatable').on( 'draw.dt', function () {
    
	$('#datatable').show();
    $('.loader').removeClass("loader");
   
	});
	
 	</script>
   