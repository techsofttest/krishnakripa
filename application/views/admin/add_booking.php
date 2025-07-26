


<style>
  
  .totals{
      text-align: right;
      font-size: 25px;
      font-weight: 600;
  }
  .span {cursor:pointer; }
	.minus, .plus{
		width:20px;
		height:20px;
		background:#f2f2f2;
		border-radius:4px;
		padding:8px 5px 8px 5px;
		border:1px solid #ddd;
    display: inline-block;
    vertical-align: middle;
    text-align: center;
		}

	input{
		height:34px;
    width: 100px;
    /*text-align: center;*/
    font-size: 26px;
		border:1px solid #ddd;
		border-radius:4px;
    display: inline-block;
    vertical-align: middle;
  }



.guests-input {
	position: relative;
  width: 100%;
  margin: 0 auto;
}
.guests-input button {
	cursor: pointer;
}
.guests-input button:after,
.guests-input button:before {
	content: " ";
	width: 10px;
	height: 2px;
	border-radius: 2px;
	background-color: #484848;
	position: absolute;
	top: 19px
}
.guests-input button:before {
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
	right: 15px
}
.guests-input button:after {
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
	right: 21px
}
.guests-input button.open:before {
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg)
}
.guests-input button.open:after {
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg)
}
.guests-input__options {
	position: absolute;
	width: 100%;
	background-color: #fff;
	-webkit-box-shadow: rgba(72, 72, 72, 0.2) 0px 15px 20px;
	box-shadow: rgba(72, 72, 72, 0.2) 0px 15px 20px;
	border-radius: 2px;
	overflow: hidden;
	height: 0;
	opacity: 0;
	-webkit-transition: all .1s linear;
	transition: all .1s linear
}
.guests-input__options.open {
	opacity: 1;
	height: 146px;
  z-index:1;
}
.guests-input__options>div {
	padding: 10px 0;
	text-align: center
}
.guests-input__options>div:first-child {
	padding-top: 20px
}
.guests-input__options>div:last-child {
	padding-bottom: 35px
}
.guests-input__ctrl {
    display: inline-block;
    border: 1px solid #484848;
    font-size: 20px;
    color: #484848;
    padding: 3px 3px;
    line-height: 10px;
    border-radius: 2px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-transition: all .2s ease;
    transition: all .2s ease;
}
.guests-input__ctrl.disabled {
	color: #d8d8d8;
	border-color: #d8d8d8;
	cursor: default
}
.guests-input__value {
	display: inline-block;
	padding: 0 10px;
	width: 100px;
	cursor: default
}
.guests-input__value span {
	display: inline-block;
	padding-right: 5px
}

.guests-btn {
	position: relative;
	width: 100%;
	margin: 0px;
	padding: 10px 6px;
	background-color: #fff;
	border: 1px solid #d8d8d8;
	border-radius: 2px;
	text-overflow: ellipsis;
	font-size: 17px;
	-webkit-transition: border-color 0.2s ease;
	transition: border-color 0.2s ease;
	text-align: left;
	color: #484848;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none
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
            
            
            
            
						<?php echo form_open(base_url().'admin/Bookings/Add',array('method'=>"POST",'enctype'=>"multipart/form-data",'id'=>"add_gallery"))?>
			
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
						                   
                 <!--
                 <div class="col-xs-12 col-sm-6 row-seperate">
                 <label>Check In<strong style="color:#F00;">*</strong></label>
	               <input id="checkin" class="form-control" name="check_in"   type="date" min="<?= date('Y-m-d'); ?>" onclick="this.showPicker()" required>	
							    
                 </div>


                 <div class="col-xs-12 col-sm-6 row-seperate">
                 <label>Check Out<strong style="color:#F00;">*</strong></label>
	               <input id="checkout" class="form-control room_check" name="check_out"  type="date" onclick="this.showPicker()" required>	
							   -->

                <div class="col-xs-12 col-sm-4 row-seperate">

                <label>Date Range<strong style="color:#F00;">*</strong></label>

                <input type="text" id="daterangepikr" placeholder="Check In - Check Out" class="form-control" value="" autocomplete="off" readonly/>
				        <i class="fas fa-calendar-alt"></i>
                <input type="hidden" class="room_check" name="check_in" id="checkin" autocomplete="off" required>
                <input type="hidden" class="room_check" name="check_out" id="checkout" autocomplete="off" required>

                </div>
                

                

                 <div class="col-xs-12 col-sm-4 row-seperate">
                  <label for="guests-input-btn">Guests</label>
                    <div class="booking-form__input guests-input">
                        
                        <button type="button" name="guests-btn" id="guests-input-btn" class="form-control">1 guest</button>
                        <div class="guests-input__options" id="guests-input-options">
                            <div>
                                <span class="guests-input__ctrl minus" id="adults-subs-btn">-</span><!-- /.guests-input__ctrl -->
                                <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span><!-- /.guests-input__value -->
                                <span class="guests-input__ctrl plus" id="adults-add-btn">+</span><!-- /.guests-input__ctrl -->
                            </div>
                            <div>
                                <span class="guests-input__ctrl minus" id="children-subs-btn">-</span><!-- /.guests-input__ctrl -->
                                <span class="guests-input__value"><span id="guests-count-children">0</span>Children</span><!-- /.guests-input__value -->
                                <span class="guests-input__ctrl plus" id="children-add-btn">+</span><!-- /.guests-input__ctrl -->
                            </div>

                             <div>
                                <span class="guests-input__ctrl minus-" id="room-subs-btn">-</span><!-- /.guests-input__ctrl -->
                                <span class="guests-input__value"><span id="room-count">0</span>Rooms</span><!-- /.guests-input__value -->
                                <span class="guests-input__ctrl plus-" id="room-add-btn">+</span><!-- /.guests-input__ctrl -->
                            </div>


                        </div><!-- /.guests-input__options -->
                    </div><!-- /.booking-form__input -->

                
                 </div>



                 <div class="col-xs-12 col-sm-4 row-seperate">
                  <label for="">Hotel</label>

                  <select class="form-control room_check" id="hotel_type" name="hotel_type" required>

                  <option value="">Select Hotel</option>

                  <?php foreach($hotels as $hotel){ ?>

                     <option value="<?= $hotel->hotel_id ?>"><?= $hotel->hotel_name ?></option>

                  <?php } ?>

                  </select>

                </div>


                    


                <input type="hidden" class="room_check" id="adults_input" name="adults">

                <input type="hidden" class="room_check" id="childrens_input" name="childrens">

                <input type="hidden" class="room_check" id="no_of_rooms" name="rooms">


                </div>


                
                <?php /*

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
                  <input class="form-control room_check" id="no_of_rooms" name="rooms" type="number" required>	
                  </div>


                  </div>  

                  */ ?>  
                  


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

                <div class="col-sm-2">
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
               
                <div class="col-sm-2">
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
                    <label> Last Name <strong style="color:#F00;"></strong></label>
							    <input class="form-control l_name_input" type="text" name="l_name" autocomplete="off">	
							    </div>


                  </div>



                   <div class="row">
						 

                  <div class="col-xs-12 col-sm-6 row-seperate">
                  <label> Address <strong style="color:#F00;"></strong></label>
							    <textarea class="form-control address_input" name="address" autocomplete="off"></textarea>

							    </div>

                   <div class="col-xs-12 col-sm-6 row-seperate">
                          <label> ID Proof <strong style="color:#F00;"></strong></label>
							            <input class="form-control" type="file" name="id_proof">
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
                                  <option value="confirmed">Confirmed</option>
                                  <option value="cancelled">Cancelled</option>  
                              </select>
							  
							        </div>

                     

                   </div>




                  <div class="row">

                      <div class="col-xs-12 col-sm-6 row-seperate">
                          <label> Transaction Id <strong style="color:#F00;"></strong></label>
							            <textarea class="form-control" placeholder="Enter transaction Id/Notes" name="payment_notes"></textarea>	
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


                  <tr id="extra_sec" style="display:none;">

                    <th>Extras (Kids)</th>

                    <td class="totals text-right" id="extra_price"></td>

                  </tr>


                  <tr>

                    <th>Discounts</th>

                    <td class="totals text-right" ><input class="text-right" value="0" name="discount" id="discount_amount"></td>

                  </tr>




                  <tr>

                    <th>Total Amount</th>
                    <td class="totals" id="total_amount">

                    </td>
                    <input type="hidden" id="total_amount_val" name="total_amount">
                    <input type="hidden" id="tax_amount_val" name="tax_amount">
                    <input type="hidden" id="extra_price_val" name="extra_price">
                    <input type="hidden" id="extra_desc_val" name="extra_desc">

                  </tr>


                  <tr>

                    <th>Advance Payment</th>
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


                $('.room_check').on('change input', function() {
                    var selectedType = $('.type_select:checked').val();
                    //$('.type_select').val()('change');
                    var check_in_date = $('input[name="check_in"]').val();
                    var check_out_date = $('input[name="check_out"]').val();
                    var room_count = $('#no_of_rooms').val();
                    var hotel_type = $('#hotel_type').val();
                    if (!room_count) room_count = 1;
                    // Fetch and display available rooms based on the selected room type
                    $.ajax({
                        url: '<?php echo base_url("admin/Bookings/GetRoomsAvailable"); ?>',
                        type: 'POST',
                        data: {room_count:room_count, room_type: selectedType,check_in: check_in_date, check_out: check_out_date,hotel_type : hotel_type },
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
                           $('.address_input').val(data.data.address);
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



                 $(document).on('change input', '#discount_amount', function() {

                  var discount = $(this).val();

                  var room_id = $('input.room_select:checked').val();      
                  
                  var no_of_rooms = $('#no_of_rooms').val();

                  var check_in_date = $('input[name="check_in"]').val();
                 
                  var check_out_date = $('input[name="check_out"]').val();

                  var discounts = $('#discount_amount').val();

                  var children = $('#childrens_input').val();

                   $.ajax({
                        url: '<?php echo base_url("admin/Bookings/CalculatePrice"); ?>',
                        type: 'POST',
                        data: { room_id: room_id,no_of_rooms:no_of_rooms,check_in:check_in_date,check_out:check_out_date,discounts:discounts,children:children},
                        success: function(response) {
                           var data = JSON.parse(response)
                           if(data.status==1)
                           {
                           $('#room_total').html(data.subtotal);
                           $('#tax').html(data.tax_amount);
                           $('#total_amount').html(data.total);

                           if(data.extra_price>0)
                           {
                            $('#extra_sec').show();
                           }
                           else
                           {
                            $('#extra_sec').hide();
                           }

                           $('#extra_price').html(data.extra_price);
                           $('#extra_price_val').val(data.extra_price);
                           $('#extra_desc_val').val(data.extra_desc);
                           $('#total_amount_val').val(data.total);
                           }
                           else
                           {

                           }
                          }
                         })

                  })



                // Use event delegation for dynamically added elements
                $(document).on('change', '.room_select', function() {

                  var room_id = $(this).val();

                  var no_of_rooms = $('#no_of_rooms').val();

                  var check_in_date = $('input[name="check_in"]').val();
                 
                  var check_out_date = $('input[name="check_out"]').val();

                  var discounts = $('#discount_amount').val();

                   var children = $('#childrens_input').val();

                   $.ajax({
                        url: '<?php echo base_url("admin/Bookings/CalculatePrice"); ?>',
                        type: 'POST',
                        data: { room_id: room_id,no_of_rooms:no_of_rooms,check_in:check_in_date,check_out:check_out_date,discounts:discounts,children:children},
                        success: function(response) {
                           var data = JSON.parse(response)
                           if(data.status==1)
                           {
                           $('#room_total').html(data.subtotal);
                           $('#tax').html(data.tax_amount);
                           $('#tax_amount_val').val(data.tax_amount);

                           if(data.extra_price>0)
                           {
                            $('#extra_sec').show();
                           }
                           else
                           {
                            $('#extra_sec').hide();
                           }

                           $('#extra_price').html(data.extra_price);
                           $('#extra_price_val').val(data.extra_price);
                           $('#extra_desc_val').val(data.extra_desc);

                           $('#total_amount').html(data.total);
                           $('#total_amount_val').val(data.total);
                           }
                           else
                           {
                           $('#room_total').html('');
                           $('#tax').html('');
                           $('#tax_amount_val').val('');
                           $('#total_amount').html('');
                           $('#extra_sec').hide();
                           $('#extra_price').html('');
                           $('#extra_price_val').val(0);
                           $('#extra_desc_val').val('');
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



<script>
  
  const guestBtn = document.querySelector("#guests-input-btn"),
	guestOptions = document.querySelector("#guests-input-options"),
	adultsSubsBtn = document.querySelector("#adults-subs-btn"),
	adultsAddBtn = document.querySelector("#adults-add-btn"),
	childrenSubsBtn = document.querySelector("#children-subs-btn"),
	childrenAddBtn = document.querySelector("#children-add-btn"),
  roomSubsBtn = document.querySelector("#room-subs-btn"),
	roomAddBtn = document.querySelector("#room-add-btn"),
	adultsCountEl = document.querySelector("#guests-count-adults"),
	childrenCountEl = document.querySelector("#guests-count-children"),
  roomCountEl = document.querySelector("#room-count");
  let maxNumGuests = 15,
	isGuestInputOpen = false,
	adultsCount = 1,
	childrenCount = 0;
  roomCount = 1;
updateValues();
guestBtn.addEventListener('click', function (e) {
	if (isGuestInputOpen) {
		guestBtn.classList.remove("open");
		guestOptions.classList.remove("open");
	} else {
		guestBtn.classList.add("open");
		guestOptions.classList.add("open");
	}
	isGuestInputOpen = isGuestInputOpen ? false : true;
	e.preventDefault();
});
adultsAddBtn.addEventListener('click', function () {
	adultsCount = addValues(adultsCount);
	updateValues();
});
adultsSubsBtn.addEventListener('click', function () {
	adultsCount = substractValues(adultsCount, 1);
	updateValues();
});
childrenAddBtn.addEventListener('click', function () {
	childrenCount = addValues(childrenCount);
	updateValues();
});
childrenSubsBtn.addEventListener('click', function () {
	childrenCount = substractValues(childrenCount, 0);
	updateValues();
});

roomAddBtn.addEventListener('click', function () {
	roomCount = addValues(roomCount);
	updateValues();
});
roomSubsBtn.addEventListener('click', function () {
	roomCount = substractValues(roomCount, 1);
	updateValues();
});


function calcTotalGuests() {
	return adultsCount + childrenCount;
}

function addValues(count) {
	return (calcTotalGuests() < maxNumGuests) ? count + 1 : count;
}

function substractValues(count, min) {
	return (count > min) ? count - 1 : count;
}

function updateValues() {
	let btnText = `${adultsCount} Adults`;
	btnText += (childrenCount > 0) ? `, ${childrenCount} Children` : '';
  btnText += (roomCount > 0) ? `, ${roomCount} Rooms` : '';
	guestBtn.innerHTML = btnText;
	adultsCountEl.innerHTML = adultsCount;
	childrenCountEl.innerHTML = childrenCount;
  roomCountEl.innerHTML = roomCount;

  document.getElementById('adults_input').value=adultsCount;
  document.getElementById('childrens_input').value=childrenCount;
  document.getElementById('no_of_rooms').value=roomCount;

  var event = new Event('change');

// Dispatch it.
  document.getElementById('adults_input').dispatchEvent(event);

  document.getElementById('childrens_input').dispatchEvent(event);

  document.getElementById('no_of_rooms').dispatchEvent(event);


	if (adultsCount == 1) {
		adultsSubsBtn.classList.add("disabled");
	} else {
		adultsSubsBtn.classList.remove("disabled");
	} if (childrenCount == 0) {
		childrenSubsBtn.classList.add("disabled");
	} else {
		childrenSubsBtn.classList.remove("disabled");
	} if (calcTotalGuests() == maxNumGuests) {
		adultsAddBtn.classList.add("disabled");
		childrenAddBtn.classList.add("disabled");
	} else {
		adultsAddBtn.classList.remove("disabled");
		childrenAddBtn.classList.remove("disabled");
	}
}


</script>

          <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
          <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
          <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
          <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


        <script>

            var j = jQuery.noConflict();

            j('#daterangepikr').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
            autoApply:true,
            minDate: moment().startOf('day'),
            locale: {
            cancelLabel: 'Clear'
            }
            },function(start, end) {
              j('#checkin').val(start.format('YYYY-MM-DD'));
              j('#checkout').val(end.format('YYYY-MM-DD'));
              });

            j('#daterangepikr').on('apply.daterangepicker', function(ev, picker) {
                j(this).val(picker.startDate.format('ddd DD MMM YYYY') + ' - ' + picker.endDate.format('ddd DD MMM YYYY'));
            });

            j('#daterangepikr').on('cancel.daterangepicker', function(ev, picker) {
                j(this).val('');
            });


        </script>





 
   
 
 
 
  
    
 