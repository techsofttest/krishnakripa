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

                <form action="" method="get">

                <div class="row">

                    <div class="col-sm-3">
                      <label>Date Filter</label>
                      <select class="form-control" id="dateFilter" name="date">
                        <option value="">Date</option>
                        <option value="week">Weekly</option>
                        <option value="month">Monthly</option>
                      </select>
                    </div>

                    <div class="col-sm-3">
                      <label>Date From</label>
                      <input class="form-control" type="date" value="<?php if(!empty($this->input->get('date_from'))) { echo $this->input->get('date_from'); } ?>" name="date_from" id="dateFrom" onclick="this.showPicker()">
                    </div>

                    <div class="col-sm-3">
                      <label>Date To</label>
                      <input class="form-control" type="date" value="<?php if(!empty($this->input->get('date_from'))) { echo $this->input->get('date_to'); } ?>" name="date_to" id="dateTo" onclick="this.showPicker()">
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

                      <select class="form-control" name="payment_status">

                        <option value="" selected>Select Payment Status</option>

                        <option value="2" <?php if($this->input->get('payment_status') == 2) { echo "selected"; } ?>>Paid</option>

                        <option value="1" <?php if($this->input->get('payment_status') == 1) { echo "selected"; } ?>>Partially Paid</option>

                        <option value="0" <?php if($this->input->get('payment_status') == 0) { echo "selected"; } ?>>Unpaid</option>

                      </select>

                    </div>





                </div>

                 <div class="row" style="">
                    <div class="col-sm-3" style="">
                    <label>Customer</label>
                      <select class="form-control"  name="customer">
                        <option value="" selected>Select Customer</option>
                       
                        <?php foreach($customers as $cus){ ?>

                          <option value="<?= $cus->cus_id ?>" <?php if((!empty($_GET['customer'])) && $cus->cus_id==$_GET['customer']) { echo "selected"; } ?>><?= $cus->first_name ?> <?= $cus->last_name ?></option>

                        <?php } ?>

                      </select>
                  
                    </div>

                    <div class="col-sm-3" style="">
                    <label>Room</label>
                      <select class="form-control" id="" name="room">
                         <option value="" selected>Select Room</option>

                        <?php foreach($rooms as $room){ ?>

                          <option value="<?= $room->roomid ?>" <?php if((!empty($_GET['room'])) && $room->roomid==$_GET['room']) { echo "selected"; } ?>><?= $room->name ?></option>

                        <?php } ?>
                      

                      </select>
                    </div>
                  
                </div>




                <div class="row" style="margin:10px 0px;">
              
                    <div class="col-sm-12" style="text-align:center">
                      <button type="submit" class="btn btn-success">Filter</button>
                      <a class="btn btn-warning" href="<?= base_url(); ?>admin/Reports/Print<?php '?' . $_SERVER['QUERY_STRING']; ?>" target="_blank">Print</a>
                      <a href="<?= base_url(); ?>admin/Reports/View" class="btn btn-danger">Reset</a>
                    </div>

                
                </div>




                  </form>



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
                                         <th>Id</th>    
                                     
                                         <th>Period</th>

                                         <th>Room</th>

                                         <th>Customer</th>

                                         <th>Amount</th>

                                         <th>Booking Status</th>

                                         <th>Actions</th>
                                       
                                    </tr>
                    			</thead>
                    			
                        
                          <tbody>
                                
                    				<?php $i=1;?>
                    				
									      <?php 
									
									      foreach($bookings as $item=>$val):?>

                        <tr>
                                        
                        <td><?= $val->uid; ?></td>    
                    
                        <td>

                        <?= date('d M Y',strtotime($val->check_in_date)) ?> <br>To<br> <?= date('d M Y',strtotime($val->check_out_date)) ?>
                      
                        </td>

                        <td><?= $val->name ?></td>

                        <td>
                        <?= $val->first_name ?> <?= $val->last_name ?><br>
                        <?= $val->phone_number ?>
                        </td>
                      
                        <td class="text-right">
                        <b style="font-size:20px"><?= $val->total_amount; ?></b><br>
                        <b style="color:green;font-size:20px"><?= $val->paid_amount; ?></b><br>
                        <b style="color:red;font-size:20px"><?= format_currency($val->total_amount-$val->paid_amount); ?></b>
                        </td>

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
                        
                          <a class="btn btn-primary" href="<?= base_url(); ?>admin/Bookings/View/<?= $val->booking_id; ?>"><i class="fa fa-eye"></i> </a>

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
   