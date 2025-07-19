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
           Manage Special Rates
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
                                     
                                        <th>Room Category</th>

                                        <th>Actions</th>

                                    </tr>

                    			</thead>
                    			
                        
                          <tbody>
                                
                    				<?php $i=1;?>
                    				
									      <?php 
									
                        if(!empty($room_categories) && count($room_categories)>0):
                       
									      foreach($room_categories as $item=>$val):?>

                        <tr>
                       			
                        <td class=""><?= $i ?></td>
                    
                        <td><?= $val->cat_title ?></td>

                        <td>
                       
                        <a style="color:rgb(102, 102, 102);" href="<?php echo base_url();?>admin/SpecialRates/View/<?= $val->cat_id; ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i style="color:orange" class="fa fa-eye"></i> View</a>
                        
                        <br/>

                        <a style="color:rgb(102, 102, 102);" href="javascript:void(0);" class="add_rate" title="Add new season rate"  data-id="<?= $val->cat_id; ?>"><i style="color:green" class="fa fa-plus"></i> Add</a>
                        
                        </td>
                     


                        </tr>
                                    
					  				    <?php 
                        $i++; 
                        endforeach;
                        ?> 
                                    
                      </tbody> 
                   				
                     
                      <?php endif; ?>


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


<?php $this->load->view('admin/add_special_rate_sec'); ?>


 
 <script>
 
	$('#datatable').on( 'draw.dt', function () {
    
	$('#datatable').show();
    $('.loader').removeClass("loader");
   
	});

	
 	</script>
   