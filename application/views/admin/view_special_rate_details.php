<?php $this->load->view('admin/includes/header');?>

      <style>
        
      </style>

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
           Manage <?= $category['cat_title']; ?> Special Rates
          </h1>

          <ol class="breadcrumb">
          
           <li style="float:left;margin-right:2em"><a href="<?php echo base_url();?>admin/Menu"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          
          </ol>

        </section>

		<?php $parent = $this->uri->segment(3); ?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
            
        <?php if($this->session->flashdata('success')) {?>
        <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('success');?> </div>
        <?php }?>
        <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-error"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('error');?> </div>
        <?php }?>   
            
			<div class="box">

        <div class="box-body">
				<!-- Form Element sizes -->

				  <div class="box box-success">

					<div class="box-header with-border">

            <div class="col-xs-12" style="padding-left: 0;">
              <a href="<?= base_url() ?>admin/SpecialRates" style="font-size: 35px;color:#92170f" title="back"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
            </div>

					  <h2 class="box-title">View <?= $category['cat_title']; ?> Special Rates</h2>

					</div>

					<div class="box-body">


                          <table class="table table-bordered table-striped">

                    			<thead>
                                    <tr>
                                      
                                        <th class="no-sort">Sl no</th>
                                     
                                        <th>From</th>

                                        <th>To</th>

                                        <th>Rate</th>

                                        <th>Actions</th>

                                    </tr>
                    			</thead>
                    			
                        
                          <tbody>
                                

                    		<?php $i=1; ?>
                    				
									      <?php 

                        if(!empty($special_rates) && count($special_rates)>0):
                       
									      foreach($special_rates as $item=>$val):
                        
                        ?>

                        <tr>
                       			
                        <td class=""><?= $i ?></td>
                    
                        <td><?= date('d M Y',strtotime($val->from_date)); ?></td>

                        <td><?= date('d M Y',strtotime($val->to_date)); ?></td>

                        <td><?= $val->rate ?></td>
                        
                        <td>

                        <a style="color:rgb(102, 102, 102);" onclick="return confirm('Delete this rate?')" href="<?php echo base_url();?>admin/SpecialRates/Delete/<?= $val->rid ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete"><i style="color:red" class="fa fa-trash"></i> Delete</a>
                        
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
          </div>  


              </div><!-- /.box -->
			 
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
 
 <script type="text/javascript">   
	$(document).ready(function(){
		var maxField = 10; 
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper'); 
		var fieldHTML = '<div> <input class="form-control" name="image[]" multiple type="file" required style="width:40%;display:inline-block">&nbsp&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/></a></div><br>'; //New input field html 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ 
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	});
	
	
</script>
     
<script type="text/javascript">   
	$(document).ready(function(){
		var maxField = 10; 
		var addButton = $('.add_button1'); 
		var wrapper = $('.field_wrapper1'); 
		var fieldHTML = '<div> <input class="form-control" name="Factitle[]" multiple type="text" required style="width:40%;display:inline-block"><input class="form-control" name="Facimage[]" multiple type="file" required style="width:40%;display:inline-block">&nbsp&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/></a></div><br>'; //New input field html 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ 
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	});
	
	
</script>
