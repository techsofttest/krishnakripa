<?php $this->load->view('admin/includes/header');?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>
      
    

      <style>
      
        .btn
        {
          margin:5px 5px;
        }


        div.dataTables_filter
        {
        display:none;
        }
        
          
        
        #datatable_filter
        {
        display:none;	
        }

      </style>
        
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage Bookings
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  


             <div class="row" style="margin:10px 0px;">

                    <div class="col-lg-3"></div>
                       
                      <div class="col-lg-6">

                       
        <div class="type-toggle-container">

        <a href="javascript:void(0);" data-id="" class="type-toggle-btn <?php if($this->input->get('hotel_type') == 0 || empty($this->input->get('hotel_type'))) { echo "active"; } ?>">All</a>

        <a href="javascript:void(0);" data-id="1" class="type-toggle-btn <?php if($this->input->get('hotel_type') == 1 ) { echo "active"; } ?>">Residency</a>

        <a href="javascript:void(0);" data-id="2" class="type-toggle-btn <?php if($this->input->get('hotel_type') == 2 ) { echo "active"; } ?>">Stay</a>

        </div>
                      
                      </div>
                       
                    <div class="col-lg-3"></div>
            
            </div>


            <div class="row">



                <div class="col-xs-12" style="margin:10px 0px;">

                <form action="" method="get" id="filter_form">

                <input type="hidden" name="hotel_type" value="<?php if(!empty($hotel_type_get=$this->input->get('hotel_type'))) { echo $hotel_type_get; } ?>" id="hotel_type_input">

                <div class="row">

                    <div class="col-sm-3">
                      <label>Date Filter</label>
                      <select class="form-control" id="dateFilter" name="date">
                        <option value="">Date</option>
                        <option value="today">Today</option>
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
                    // Function to get today's date in YYYY-MM-DD format
                    function getTodayDate() {
                      var today = new Date();
                      var dd = String(today.getDate()).padStart(2, '0');
                      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                      var yyyy = today.getFullYear();
                      return yyyy + '-' + mm + '-' + dd;
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
                      } 
                      else if(filter === 'today')
                      {
                      var todaydate = getTodayDate(today);
                      from = todaydate;
                      to = todaydate;
                      }
                      else {
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



                    <div class="col-sm-3" style="">

                    <label>Room Number</label>

                     <input class="form-control" type="text" name="room_no_search" value="<?= $_GET['room_no_search'] ?? "" ?>">

                    </div>


                  
                </div>




                <div class="row" style="margin:10px 0px;">
              
                    <div class="col-sm-12" style="text-align:center">
                      <button type="submit" class="btn btn-success">Filter</button>
                      <a href="<?= base_url(); ?>admin/Bookings" class="btn btn-danger">Reset</a>
                    </div>

                
                </div>




                  </form>



            </div>



            </div>
            


                      <div class="row" style="margin:10px 0px;">
                      <div class="col-lg-3"></div>
                       
                       
                       <div class="col-lg-6">
                       
                       <label class="text-center" style="width:100%;">Enter Search Keyword</label>
                       
                       <input id="custom_search" type="text" class="form-control" value="" placeholder="Booking ID,Phone,Customer Name etc"/>
                       
                       </div>
                       
                       
                       
                       <div class="col-lg-3"></div>
                       
                       </div>


            
            
            
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

                                         <th>Total</th>

                                         <th>Paid</th>

                                         <th>Pending</th>

                                         <th>Payments</th>

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

                        <td><?= $val->name ?><br><b><?= $val->booking_room_no ?? "" ?></b></td>

                        <td>
                        <?= $val->first_name ?> <?= $val->last_name ?><br>
                        <?= $val->phone_number ?>
                        </td>
                      
                        <td class="text-right">
                        <b style="font-size:20px"><?= $val->total_amount; ?></b>
                        </td>



                        <td class="text-right"><b style="color:green;font-size:20px"><?= $val->paid_amount; ?></b></td>


                        <td class="text-right"><b style="color:red;font-size:20px"><?= format_currency($val->total_amount-$val->paid_amount); ?></b></td>

                        <td>
                        <?php 
                        if($val->booking_status=="cancelled"){ ?>
                        <a class="btn btn-warning add_refund_btn" data-type="debit" data-id="<?= $val->booking_id;?>" data-toggle="modal" data-target="#payModal" title="Refund To Customer"><i class="fa fa-reply"></i> Refund</a>
                        <?php } else { ?>
                        <a class="btn btn-primary add_payment_btn" data-type="credit" data-id="<?= $val->booking_id;?>" data-toggle="modal" data-target="#payModal" title="Add Payment To Booking"><i class="fa fa-money"></i> Payment</a>
                        <?php } ?>
                        </td>

                        <td>
                        <?php
                        if($val->booking_status=="pending"){
                        ?>
                        <span class="btn btn-warning status_btn" data-id="<?= $val->booking_id ?>"><i class="fa fa-clock-o" ></i> Pending</span>
                        <?php 
                        }
                        else if($val->booking_status=="confirmed"){
                        ?>
                        <span class="btn btn-success status_btn" data-id="<?= $val->booking_id ?>"><i class="fa fa-check" ></i> Confirmed</span>
                        <?php 
                        } else if($val->booking_status=="cancelled"){
                        ?>
                        <span class="btn btn-danger status_btn" data-id="<?= $val->booking_id ?>"><i class="fa fa-times" ></i> Cancelled</span>
                        <?php
                        }
                        else if($val->booking_status=="checked_in"){
                        ?>
                        <span class="btn btn-success status_btn" data-id="<?= $val->booking_id ?>"><i class="fa fa-sign-in" ></i> Checked In</span>
                        <br><b><?= !empty($val->actual_check_in_date) ? date('d-m-Y', strtotime($val->actual_check_in_date)) : '' ?></b>
                        <br><b><?= !empty($val->actual_check_in_date) ? date('h:i a', strtotime($val->actual_check_in_date)) : '' ?></b>
                        <?php } 
                        else if($val->booking_status=="checked_out") { ?>
                        <span class="btn btn-success status_btn" data-id="<?= $val->booking_id ?>"><i class="fa fa-sign-out" ></i> Checked Out</span>
                        <br><b><?= !empty($val->actual_check_out_date) ? date('d-m-Y', strtotime($val->actual_check_out_date)) : '' ?></b>
                        <br><b><?= !empty($val->actual_check_out_date) ? date('h:i a', strtotime($val->actual_check_out_date)) : '' ?></b>
                        <?php } ?>

                        </td>

                        <td>

                          <div class="row">

                          <div class="col-sm-6">
                          <a style="" class="btn btn-primary" href="<?= base_url(); ?>admin/Bookings/Invoice/<?= $val->booking_id; ?>" target="_blank" title="Print Invoice"><i class="fa fa-file-text"></i> </a>
                          </div>

                          <div class="col-sm-6">
                          <a class="btn btn-primary" href="<?= base_url(); ?>admin/Bookings/View/<?= $val->booking_id; ?>" title="View Booking Details"><i class="fa fa-eye" ></i> </a>
                          </div>

                          </div>

                          <div class="row">

                          <div class="col-sm-6">
                          <a class="btn btn-warning" href="<?= base_url(); ?>admin/Bookings/Edit/<?= $val->booking_id; ?>" title="Edit Booking Details"><i class="fa fa-pencil" ></i> </a>
                          </div>
                          <div class="col-sm-6">
                          <a onclick="return confirm('Delete this booking?')" class="btn btn-danger" href="<?= base_url(); ?>admin/Bookings/Delete/<?= $val->booking_id; ?>" title="Delete Booking"><i class="fa fa-trash" ></i> </a>
                          </div>
                          </div>

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




      <!-- Payment Modal Start -->



      <!-- Modal -->
  <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
          <form id="payment_form" method="post">
          <input type="hidden" id="pay_booking_id" name="booking_id" value="">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Payment To Booking <span></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h4 style="text-align:center" id="">Pending : <span style="color:red;" id="pending_amount"></span></h4>
          <label>Enter Amount</label>
          <input type="number" class="form-control" placeholder="Enter Amount" name="amount" id="amount" required>

          <label>Payment Method</label>
          <select class="form-control" name="payment_method" id="payment_method" required>
            <option value="">Select Payment Method</option>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="upi">UPI</option>
            <option value="online">Online</option>
          </select>

          <label>Payment Date</label>
          <input type="date" class="form-control" name="payment_date" onclick="this.showPicker();" id="payment_date" required>

          <label>Payment Notes</label>
          <textarea class="form-control" placeholder="Enter any notes" name="payment_notes" id="payment_notes"></textarea>

          <input type="hidden" id="payment_type" name="payment_type" value="">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Add Payment?')">Add</button>
      </div>
    </div>
      </form>
  </div>
</div>

    <!-- Payment Modal End -->





    <!-- Status Modal Start -->  

  <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
          <form id="status_form" method="post" action="<?= base_url(); ?>admin/Bookings/Status">
          <input type="hidden" id="status_booking_id" name="booking_id" value="">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Check Out <span></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <label>Booking Status</label>
          <select class="form-control" name="booking_status" id="booking_status" required>
            <option value="">Select Booking Status</option>
            <!--<option value="pending">Pending</option>-->
            <option value="confirmed">Confirmed</option>
            <option value="checked_in">Checked In</option>
            <option value="checked_out">Checked Out</option>
            <option value="cancelled">Cancelled</option>
          </select>


          <div class="room_no" style="display:none;">
          <label>Room No</label>
          <input class="form-control" name="room_no" value="">
          </div>

            
          <div class="status_datetime">
          <label>Date</label>
          <input onclick="this.showPicker();" value="<?= date('Y-m-d') ?>" type="date" class="form-control" name="status_date" id="status_date" required>
          </div>

          <div class="status_datetime">
          <label>Time</label>
          <input onclick="this.showPicker();" value="<?= date('H:i') ?>" type="time" class="form-control" name="status_time" id="status_time" required>
          </div>


          <section class="cancel-refund-status" style="display:none;">

          <label> Refund Eligible</label>

          <select class="form-control cancel_refund_eligible" name="refund_eligible" required>

          <option value="" selected>Select Refund Status</option>

          <option value="yes">Yes</option>

          <option value="no" >No</option>

          </select>

          </section>

          <section class="cancel-refund-sec" style="display:none;">

          <label> Refund Amount</label>
          <input type="number" class="form-control" placeholder="Enter Amount" name="amount">

          <label>Payment Method</label>
          <select class="form-control" name="payment_method">
            <option value="">Select Payment Method</option>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="upi">UPI</option>
            <option value="online">Online</option>
          </select>

          <label>Payment Date</label>
          <input type="date" class="form-control" name="payment_date" onclick="this.showPicker();" >

          <label>Transaction Id</label>
          <textarea class="form-control" placeholder="Enter transaction ID/Notes" name="payment_notes" ></textarea>

          <input type="hidden" name="payment_type" value="debit">

          </section>






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Confirm Booking Status?')">Update</button>
      </div>
    </div>
      </form>
  </div>
</div>

    
    <!-- Status Modal End -->









 <?php $this->load->view('admin/includes/footer');?>
 
 <script>
 
	$('#datatable').on( 'draw.dt', function () {
    
	$('#datatable').show();
    $('.loader').removeClass("loader");
   
	});


    $('body').on('click', '.status_btn', function() {

      var bookingId = $(this).data('id');

      $('#status_form')[0].reset();

      $('.room_no').hide();

      $('.status_datetime').hide();

      $('.cancel-refund-status').hide();

      $('.cancel-refund-status select').removeAttr('required');

      $('.cancel-refund-sec').hide();

      $('.cancel-refund-sec input').removeAttr('required');

      $('.cancel-refund-sec select').removeAttr('required');

      $('#status_booking_id').val(bookingId);

      $('#statusModal').modal('show');

    });



    $('body').on('change', '#booking_status', function() {

    $('.cancel-refund-status').hide();

    $('.cancel-refund-status select').removeAttr('required');

    $('.room_no').hide();

    var status = $(this).val();

    if(status == 'checked_in' || status == 'checked_out'){

      if(status=='checked_in')
      {
      $('.room_no').show();
      }
      else
      {
      $('.room_no').hide();
      }

      $('.status_datetime').show();

    } else {

      $('.status_datetime').hide();

    }

    if(status == 'cancelled'){
    
    $('.cancel-refund-status').show();

    $('.cancel-refund-status select').attr('required',true);

    }
    else
    {

    $('.cancel-refund-sec').hide();

    $('.cancel-refund-sec input').removeAttr('required');

    $('.cancel-refund-sec select').removeAttr('required');

    }


    });



    $('body').on('change', '.cancel_refund_eligible', function() {

    if($(this).val()=="yes")

    {

    $('.cancel-refund-sec').show();

    $('.cancel-refund-sec input').attr('required',true);

    $('.cancel-refund-sec select').attr('required',true);

    }

    else
    {

    $('.cancel-refund-sec').hide();

    $('.cancel-refund-sec input').attr('required',false);

    $('.cancel-refund-sec select').attr('required',false);
    
    }

    });





      


  $('body').on('click', '.add_payment_btn,.add_refund_btn', function() {
    
    var bookingId = $(this).data('id');

    var paymentType = $(this).data('type');

    $('#payment_form')[0].reset();

    $('#payment_type').val(paymentType);

    $('#pay_booking_id').val(bookingId);

    $.ajax({
    url : base_url + 'admin/Bookings/GetPending',
    type : 'POST',
    data : {bid: bookingId},  
    success : function(response){
    
    response = JSON.parse(response);

    if(response.status == 'success'){

      if(paymentType == 'credit'){
        
        $('#payment_form').find('h5.modal-title').text('Add Payment To Booking');

        $('#payModal .modal-title span').text(bookingId);

        $('#pending_amount').text(response.pending);

        $('#amount').attr('max', response.pending);

        $('#amount').val(0);

      } else {

        $('#payment_form').find('h5.modal-title').text('Refund To Customer');

        $('#payModal .modal-title span').text(bookingId);

        $('#pending_amount').text(response.total_paid);

        $('#amount').attr('max', response.total_paid);

        $('#amount').val(response.total_paid);

      }
      
    } else {
      alertify.error(response.message);
    }

    }

    });
    //$('#payModal').modal('show');
  });


  $('#payment_form').submit(function(e){

  e.preventDefault();

  //$(form).serialize()

  $.ajax({

    url : base_url + 'admin/Bookings/AddPayment',
    type : 'POST',
    data : $(this).serialize(),

    success : function(response){

      var response = JSON.parse(response);

      if(response.status == 'success'){

        alertify.success(response.message);

        $('#payModal').modal('hide');

        location.reload();

      } else {

        alert(response.message);

      }

    },

  });

  

  });


$( document ).ready(function() {
      oTable = $('#datatable').DataTable(
       
      ); 
      
      $('#custom_search').keyup(function(){
      oTable.search($(this).val()).draw() ;
})
});


$('.type-toggle-btn').click(function(){

  var type = $(this).data('id');

  $('#hotel_type_input').val(type);

  $('#filter_form').submit();

})


	
 	</script>
   