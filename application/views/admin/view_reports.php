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
           Reports
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">



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
                      <input class="form-control" type="date" id="dateFrom" onclick="this.showPicker()">
                    </div>

                    <div class="col-sm-3">
                      <label>Date To</label>
                      <input class="form-control" type="date" id="dateTo" onclick="this.showPicker()">
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


                    <div class="col-sm-3">

                      <label>Payment</label>

                      <select class="form-control" name="">

                        <option value="day">Paid</option>

                        <option value="day">Unpaid</option>

                      </select>

                    </div>





                </div>

                 <div class="row" style="">
                    <div class="col-sm-3" style="">
                    <label>Customer</label>
                      <select class="form-control" id="" name="">
                        <option value="day">John</option>
                        <option value="week">Doe</option>
                        <option value="month">Paul</option>
                      </select>
                  
                    </div>

                    <div class="col-sm-3" style="">
                    <label>Room</label>
                      <select class="form-control" id="" name="">
                        <option value="day">Suit Room With Bath Tub</option>
                        <option value="week">	Delux Double Room</option>
                        <option value="month">Standard Double Room</option>
                      </select>
                  
                    </div>
                  
                </div>




                <div class="row" style="margin:10px 0px;">
              
                    <div class="col-sm-12" style="text-align:center">
                      <button class="btn btn-success">Filter</button>
                      <button class="btn btn-warning">Print</button>
                      <button class="btn btn-danger">Reset</button>
                    </div>

                
                </div>



            </div>



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
                                        
                                         <th>Check In</th>    
                                     
                                         <th>Check Out</th>

                                         <th>Room</th>

                                         <th>Name</th>

                                         <th>Phone</th>

                                         <th>Pending</th>

                                         <th>Status</th>

                                         <th>Actions</th>
                                       
                                    </tr>
                    			</thead>
                    			
                        
                          <tbody>
                                
                    				<?php $i=1;?>
                    				
									      <?php 
									
									      foreach($bookings as $item=>$val):?>

                        <tr>
                       			
                        <td class=""><?= $i ?></td>
                                        
                        <td><?= date('d M Y',strtotime($val->check_in_date)) ?></td>    
                    
                        <td><?= date('d M Y',strtotime($val->check_out_date)) ?></td>

                        <td><?= $val->name ?></td>

                        <td><?= $val->first_name ?> <?= $val->last_name ?></td>

                        <td><?= $val->phone_number ?></td>

                        <td><b style="color:red;"><?= $val->total_amount-$val->paid_amount; ?></b></td>

                        <td>

                        <?php
                        if($val->booking_status=="pending"){
                        ?>
                        <span class="btn btn-warning">Pending</span>
                        <?php 
                        }
                        else if($val->booking_status=="confirmed"){
                        ?>
                        <span class="btn btn-success">Confirmed</span>
                        <?php 
                        } else {
                        ?>
                        <span class="btn btn-danger">Cancelled</span>
                        <?php
                        }
                        ?>
                        
                        </td>

                        <td>
                        <a class="btn btn-primary"><i class="fa fa-file-text"></i> Invoice</a>
                        </td>

                        </tr>
                                    
					  				    <?php 
                        $i++; 
                        endforeach;
                        ?> 
                                    
                      </tbody> 
                   				
                                <input type="hidden" id="alert-notification" value="Are you sure you want to delete this banner record?">
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
   