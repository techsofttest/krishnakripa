<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<style>
.totals{
    text-align: right;
    font-size: 25px;
    font-weight: 600;
}

</style>

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
           Manage Bookings
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>
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
            
            
            
            
						<?php echo form_open('',array('method'=>"POST",'enctype'=>"multipart/form-data",'id'=>"add_gallery"))?>
			
				   <!-- Form Element sizes -->
				    <div class="box box-success">				
					  <div class="box-body">
						 
                 <?php $parent = $this->uri->segment(4); ?>         
                 
                 

                <div class="row"> 
                <div class="col-xs-12 col-sm-12 row-seperate text-center">

                <h3>Booking</h3>

                </div>
                </div>

                  
                         
                 <div class="row">
						                     
                 <div class="col-xs-12 col-sm-6 row-seperate">
                 <label>Check In<strong style="color:#F00;">*</strong></label>
	               <input id="checkin" class="form-control" name="check_in"   type="date" min="<?= date('Y-m-d'); ?>" onclick="this.showPicker()" required>	
							    
                 </div>


                 <div class="col-xs-12 col-sm-6 row-seperate">
                 <label>Check Out<strong style="color:#F00;">*</strong></label>
	               <input id="checkout" class="form-control room_check" name="check_out"  type="date" onclick="this.showPicker()" required>	
							    
                 </div>



                  </div>     
                  
                  


                   <div class="row">
						                     
                 <div class="col-xs-12 col-sm-4 row-seperate">
                  <label>Adults<strong style="color:#F00;">*</strong></label>
	                
                  <select class="form-control room_check" name="adults" required>
                  <option value="">Select No Of Adults</option>
                  <?php for($i=1;$i<=15;$i++){ ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                  <?php } ?>
                  </select>
							    
                 </div>


                 <div class="col-xs-12 col-sm-4 row-seperate">
                  <label>Children<strong style="color:#F00;">*</strong></label>

	                <select class="form-control room_check" name="childrens" required>
                  <option value="">Select No Of Children</option>
                  <?php for($i=0;$i<=10;$i++){ ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                  <?php } ?>
                  </select>
							    
                 </div>


                 <div class="col-xs-12 col-sm-4 row-seperate">

                 <label>No Of Rooms<strong style="color:#F00;">*</strong></label>
	               <input class="form-control room_check" id="no_of_rooms" name="rooms"  type="number" required>	
							    
                 </div>


                  </div>                        
                          
                          
                     


                  <style>

                    .card-input-element {
                        display: none;
                    }

                    .card-input {
                        margin: 10px;
                        padding: 00px;
                    }

                    .card-input:hover {
                        cursor: pointer;
                    }

                    .card-input-element:checked + .card-input {
                        box-shadow: 0 0 1px 1px #2ecc71;
                    }


                    .w-100
                    {

                    width:100%;

                    }


                  </style>



                <div class="row"> 
                <div class="col-xs-12 col-sm-12 row-seperate text-center">

                <h3>Room</h3>

                </div>
                </div>

                          

              <div class="row"> 

                <div class="col-xs-12 col-sm-12 row-seperate">

                 <label>Room Type <strong style="color:#F00;">*</strong> </label>
                             
                <div class="row"> 

                <div class="col-sm-3">
                <label class="w-100">
                <input type="radio" name="room_type" class="card-input-element room_check type_select" value="0" checked/>
                <div class="panel panel-default card-input">
                <div class="panel-heading"> All</div>
                   
                  </div>
                </label>

                </div>


							  <?php
                foreach($room_types as $rt){
                ?>
               
                <div class="col-sm-3">
                <label class="w-100">
                <input type="radio" name="room_type" class="card-input-element room_check type_select" value="<?= $rt->cat_id ?>" />
                <div class="panel panel-default card-input">
                <div class="panel-heading"> <?= $rt->cat_title; ?></div>
                   
                  </div>
                </label>

                </div>
                <?php
                }
                ?>
                </div>




                </div>

							  </div>





                <div class="row room_details" style="display:none;"> 

                <div class="col-xs-12 col-sm-12 row-seperate">

                 <label>Room<strong style="color:#F00;">*</strong> </label>
                             
                <div class="row">
                  
                <div class="col-sm-12">

                <table class="table table-striped table-bordered">

                  <thead>

                  <tr>

                  <th>Choose</th>

                  <th>Image</th>

                  <th>Room Name</th>

                  <th>Available Rooms</th>

                  <th>Rate</th>

                  </tr>

                  </thead>


                  <tbody id="room-sec">


                  </tbody>


                </table>

                </div>
              

                </div>


                </div>

							  </div>








                 <div class="row"> 
                  <div class="col-xs-12 col-sm-12 row-seperate text-center">

                  <h3>Customer</h3>

                 </div>
                 </div>


    
                <div class="row">


                 <div class="col-xs-12 col-sm-6 row-seperate">
                
                <label> Phone <strong style="color:#F00;">*</strong></label>
                <div class="input-group">
							  <input class="form-control phone_input" name="phone" autocomplete="off" required>	
                
                <span class="input-group-addon transparent">
                <i id="phone_status_icon" class='fa fa-question' aria-hidden='true'></i>
                </span>

                </div>
							  </div>


                <div class="col-xs-12 col-sm-6 row-seperate">
                              <label> Email <strong style="color:#F00;"></strong></label>
							  <input class="form-control email_input" type="email" name="email" autocomplete="off">	
							        </div>

                  </div>



                  <div class="row">
						 

                  <div class="col-xs-12 col-sm-6 row-seperate">
                  <label> First Name <strong style="color:#F00;">*</strong></label>
							    <input class="form-control f_name_input" type="text" name="f_name" autocomplete="off" required>

							    </div>


                  <div class="col-xs-12 col-sm-6 row-seperate">
                    <label> Last Name <strong style="color:#F00;">*</strong></label>
							    <input class="form-control l_name_input" type="text" name="l_name" autocomplete="off" required>	
							    </div>
                   

                  </div>



                   <div class="row">
						 

                  <div class="col-xs-12 col-sm-6 row-seperate">
                  <label> Address <strong style="color:#F00;"></strong></label>
							    <textarea class="form-control address_input" name="address" autocomplete="off"></textarea>

							    </div>

                   <div class="col-xs-12 col-sm-6 row-seperate">
                          <label> ID Proof <strong style="color:#F00;"></strong></label>
							            <input class="form-control" type="file" name="">
							     </div>


                  </div>



                   <div class="row"> 
                <div class="col-xs-12 col-sm-12 row-seperate text-center">

                <h3>Payment & Status</h3>

                </div>
                </div>




                  <div class="row">
						 
                    <div class="col-xs-12 col-sm-6 row-seperate">
                              <label> Payment Method <strong style="color:#F00;">*</strong></label>

                              <select class="form-control" name="payment_method" required>
                                  <option value="">Select Payment Method</option>
                                  <option value="cash">Cash</option>
                                  <option value="card">Card</option>
                                  <option value="upi">UPI</option>
                                  <option value="online">Online</option>  
                              </select>
							  
							        </div>



                       <div class="col-xs-12 col-sm-6 row-seperate">
                              <label> Booking Status <strong style="color:#F00;">*</strong></label>
                              <select class="form-control" name="booking_status" required>
                                  <option value="">Select Booking Status</option>
                                  <option value="pending">Pending</option>
                                  <option value="confirmed">Confirmed</option>
                                  <option value="cancelled">Cancelled</option>  
                              </select>
							  
							        </div>

                     

                   </div>




                  <div class="row">

                    <div class="col-xs-12 col-sm-6 row-seperate">
                          <label> Payment Details/Notes <strong style="color:#F00;"></strong></label>
							            <textarea class="form-control" name="payment_notes"></textarea>	
							        </div>

                       <div class="col-xs-12 col-sm-6 row-seperate">
                              <label> Special Requirements / Notes <strong style="color:#F00;"></strong></label>
							                <textarea class="form-control" name="booking_notes"></textarea>	
							        </div>

                   </div>



                  

                  <div class="row">

                  <div class="col-xs-12 col-sm-12 row-seperate">
                  
                  <table class="table table-striped">

                  <tr>

                    <th>Room Total</th>
                    <td  class="totals" id="room_total"></td>

                  </tr>


                  <tr>

                    <th>Tax</th>
                    <td class="totals" id="tax"></td>

                  </tr>


                   <tr>

                    <th>Total Amount</th>
                    <td class="totals" id="total_amount">

                    </td>
                    <input type="hidden" id="total_amount_val" name="total_amount">

                  </tr>


                  <tr>

                    <th>Current Payment</th>
                    <td class="totals" ><input class="totals" value="0" name="current_payment"></td>

                  </tr>


                  </table>

                  </div>

                  </div>


                          
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Add</button>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                    	
                  </div>



              </div><!-- /.box -->
            

			  <?php echo form_close()?>


        
              
              
          </div><!-- /.col -->
          </div><!-- /.row -->
        

        </section>
          <?php $this->load->view('admin/includes/footer');?>

          <script>
            $(document).ready(function() {


                $('.room_check').on('change', function() {
                    var selectedType = $('.type_select:checked').val();
                    //$('.type_select').val()('change');
                    var check_in_date = $('input[name="check_in"]').val();
                    var check_out_date = $('input[name="check_out"]').val();
                    // Fetch and display available rooms based on the selected room type
                    $.ajax({
                        url: '<?php echo base_url("admin/Bookings/GetRoomsAvailable"); ?>',
                        type: 'POST',
                        data: { room_type: selectedType,check_in: check_in_date, check_out: check_out_date },
                        success: function(response) {
                           var data = JSON.parse(response)
                           if(data.status==1)
                           {
                            $('#room-sec').html(data.html);
                            $('.room_details').show();
                           }
                           else
                           {
                             $('.room_details').hide();
                            alert(data.msg);
                           }
                        }
                    });
                });



                 $('.phone_input').on('input', function() {

                  var phone_val = $(this).val();

                  $('#phone_status_icon').removeClass();
                  //$('#phone_status_icon').addClass('');

                  if (phone_val.length >= 6) {

                  $.ajax({
                        url: '<?php echo base_url("admin/Bookings/CheckCustomer"); ?>',
                        type: 'POST',
                        data: { phone: phone_val},
                        success: function(response) {
                           var data = JSON.parse(response)
                           if(data.status==1)
                           {
                           //console.log(data);
                           $('.email_input').val(data.data.email_address);
                           $('.f_name_input').val(data.data.first_name);
                           $('.l_name_input').val(data.data.last_name);
                           $('.address_input').val(data.data.address_input);
                           $('#phone_status_icon').removeClass();
                           $('#phone_status_icon').addClass('fa fa-check text-success');
                           }
                           else
                           {
                           //console.log(data);
                           $('.email_input').val('');
                           $('.f_name_input').val('');
                           $('.l_name_input').val('');
                           $('.address_input').val('');
                           //$('#phone_status_icon').removeClass();
                           //$('#phone_status_icon').addClass('fa fa-cross text-danger'); 
                           }
                        }
                    });

                  }

                 });


                // Use event delegation for dynamically added elements
                $(document).on('change', '.room_select', function() {

                  var room_id = $(this).val();

                  var no_of_rooms = $('#no_of_rooms').val();

                  var check_in_date = $('input[name="check_in"]').val();
                 
                  var check_out_date = $('input[name="check_out"]').val();

                   $.ajax({
                        url: '<?php echo base_url("admin/Bookings/CalculatePrice"); ?>',
                        type: 'POST',
                        data: { room_id: room_id,no_of_rooms:no_of_rooms,check_in:check_in_date,check_out:check_out_date},
                        success: function(response) {
                           var data = JSON.parse(response)
                           if(data.status==1)
                           {
                           $('#room_total').html(data.subtotal);
                           $('#tax').html(data.tax_amount);
                           $('#total_amount').html(data.total);
                           $('#total_amount_val').val(data.total);
                           }
                           else
                           {
                           $('#room_total').html('');
                           $('#tax').html('');
                           $('#total_amount').html('');
                           $('#total_amount_val').val(0);
                           }
                        }
                    });



                  
                });


            });
          </script>



          <script>
            const checkin = document.getElementById('checkin');
            const checkout = document.getElementById('checkout');

            checkin.addEventListener('change', function () {
              const checkinDate = this.value;
              // Set minimum checkout date to one day after check-in
              if (checkinDate) {
                const minCheckout = new Date(checkinDate);
                minCheckout.setDate(minCheckout.getDate() + 1);

                const yyyy = minCheckout.getFullYear();
                const mm = ('0' + (minCheckout.getMonth() + 1)).slice(-2);
                const dd = ('0' + minCheckout.getDate()).slice(-2);
                const minDateStr = `${yyyy}-${mm}-${dd}`;

                checkout.min = minDateStr;

                // Auto-reset checkout if it's before the new min
                if (checkout.value && checkout.value <= checkinDate) {
                  checkout.value = minDateStr;
                }
              }
            });
          </script>

 
   
 
 
 
  
    
 