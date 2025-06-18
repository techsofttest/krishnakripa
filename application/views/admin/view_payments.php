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
           Manage Payments
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">

          <form>

          <div class="col-xs-12" style="margin:10px 0px;">

                <div class="row">

                    <div class="col-sm-3">
                      <label>Date Filter</label>
                      <select class="form-control" id="dateFilter" name="">
                        <option value="day">Date</option>
                        <option value="week">Weekly</option>
                        <option value="month">Monthly</option>
                      </select>
                    </div>

                    <div class="col-sm-3">
                      <label>Date From</label>
                      <input class="form-control" type="date" name="date_from" id="dateFrom" onclick="this.showPicker()">
                    </div>

                    <div class="col-sm-3">
                      <label>Date To</label>
                      <input class="form-control" type="date" name="date_to" id="dateTo" onclick="this.showPicker()">
                    </div>

                    <script>
                    function getMonday(d) {
                      d = new Date(d);
                      var day = d.getDay(),
                          diff = d.getDate() - day + (day === 0 ? -6 : 1); // adjust when day is sunday
                      return new Date(d.setDate(diff));
                    }
                    function getSunday(d) {
                      d = new Date(d);
                      var day = d.getDay(),
                          diff = d.getDate() - day + 7;
                      return new Date(d.setDate(diff));
                    }
                    function pad(n) { return n < 10 ? '0' + n : n; }
                    function formatDate(date) {
                      return date.getFullYear() + '-' + pad(date.getMonth() + 1) + '-' + pad(date.getDate());
                    }
                    document.getElementById('dateFilter').addEventListener('change', function() {
                      var filter = this.value;
                      var today = new Date();
                      var from = '', to = '';
                      if (filter === 'week') {
                        var monday = getMonday(today);
                        var sunday = getSunday(today);
                        from = formatDate(monday);
                        to = formatDate(sunday);
                      } else if (filter === 'month') {
                        var first = new Date(today.getFullYear(), today.getMonth(), 1);
                        var last = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        from = formatDate(first);
                        to = formatDate(last);
                      } else {
                        from = formatDate(today);
                        to = formatDate(today);
                      }
                      document.getElementById('dateFrom').value = from;
                      document.getElementById('dateTo').value = to;
                    });
                    </script>


                      <div class="col-sm-3" style="">
                        <label>Customer</label>
                        <select class="form-control" id="" name="customer">
                          <option value="">Select Customer</option>
                         <?php foreach($customers as $cus){ ?>

                          <option value="<?= $cus->cus_id ?>" <?php if((!empty($_GET['customer'])) && $cus->cus_id==$_GET['customer']) { echo "selected"; } ?>><?= $cus->first_name ?> <?= $cus->last_name ?></option>

                        <?php } ?>

                        </select>
                  
                      </div>




                </div>

                




                <div class="row" style="margin:10px 0px;">
              
                    <div class="col-sm-12" style="text-align:center">
                      <button type="submit" class="btn btn-success">Filter</button>
                      <a href="" class="btn btn-warning" href="<?= base_url(); ?>admin/Payments/Print<?php '?' . $_SERVER['QUERY_STRING']; ?>">Print</a>
                      <a href="<?= base_url(); ?>admin/Payments" class="btn btn-danger">Reset</a>
                    </div>

                
                </div>



            </div>


                  </form>





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

                                        <th>Date</th>
                                     
                                        <th>Booking ID</th>

                                        <th>Name</th>

                                        <th>Phone</th>
                                        
                                        <th>Method</th>

                                        <th>Notes</th>

                                        <th>Debit</th>

                                        <th>Credit</th>
                                       
                                    </tr>
                    			</thead>
                    			
                        
                          <tbody>
                                
                    				<?php $i=1;?>
                    				
									      <?php 
									
                        if(!empty($payments) && count($payments)>0):
                        // Loop through each payment item
                        // $payments is expected to be an array of payment objects
                        // Each object should have properties like bp_paid_on, uid, first_name, last_name, phone_number, bp_pay_method, bp_notes, bp_type, and bp_amount
                        
									      foreach($payments as $item=>$val):?>

                        <tr>
                       			
                        <td class=""><?= $i ?></td>

                        <td><?= date('d-m-Y',strtotime($val->bp_paid_on)) ?></td>
                    
                        <td><?= $val->uid ?></td>

                        <td><?= $val->first_name ?> <?= $val->last_name ?></td>
                     
                        <td><?= $val->phone_number ?></td>

                        <td><?= $val->bp_pay_method; ?></td>

                        <td><?= $val->bp_notes; ?></td>

                        <td style="text-align:right"><b style="color:red"><?php if($val->bp_type=="debit") { echo $val->bp_amount; } else { echo "-"; } ?></b></td>

                        <td style="text-align:right"><b style="color:green"><?php if($val->bp_type=="credit") { echo $val->bp_amount; } else { echo "-"; } ?></b></td>

                        </tr>
                                    
					  				    <?php 
                        $i++; 
                        endforeach;
                        ?> 
                                    
                      </tbody> 
                   				
                                
                  	
                      <tfoot>

                        <tr>
                       			
                        <td class="" style="text-align:right;font-size:20px;" colspan="7">Total</td>

                        <td style="text-align:right;color:red;">
                          <b>
                          <?php
                          $debit_total = array_sum(array_map(function($p) {
                            return (isset($p->bp_type) && $p->bp_type === "debit") ? $p->bp_amount : 0;
                          }, $payments));
                          echo format_currency($debit_total);
                          ?>
                          </b>
                        </td>


                        <td style="text-align:right;color:green;">
                          <b>
                          <?php
                          $credit_total = array_sum(array_map(function($p) {
                            return (isset($p->bp_type) && $p->bp_type === "credit") ? $p->bp_amount : 0;
                          }, $payments));
                          echo format_currency($credit_total);
                          ?>
                          </b>
                        </td>

                        </tr>


                      </tfoot>

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
 
 <script>
 
	$('#datatable').on( 'draw.dt', function () {
    
	$('#datatable').show();
    $('.loader').removeClass("loader");
   
	});
	
 	</script>
   