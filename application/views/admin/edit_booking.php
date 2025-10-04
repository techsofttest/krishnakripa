<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<style>
.totals{
    text-align: right;
    font-size: 25px;
    font-weight: 600;
}

/* Repeater CSS Start */

        .file-input-container {
            position: relative;
            margin-bottom: 15px;
        }
        
        .input-with-button {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .input-with-button input[type="file"] {
            flex: 1;
        }
        
        .btn-action {
            min-width: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.2s ease;
        }
        
        .btn-add {
            background-color: #28a745;
            color: white;
        }
        
        .btn-add:hover {
            background-color: #218838;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
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
	               <input id="checkin" class="form-control date_select" name="check_in"  type="date" min="" value="<?= date('Y-m-d',strtotime($booking['check_in_date'])) ?>" onclick="this.showPicker()" required>	
							    
                 </div>


                 <div class="col-xs-12 col-sm-6 row-seperate">
                 <label>Check Out<strong style="color:#F00;">*</strong></label>
	               <input id="checkout" class="form-control date_select" name="check_out" min="<?= date('Y-m-d',strtotime($booking['check_in_date'])) ?>" value="<?= date('Y-m-d',strtotime($booking['check_out_date'])) ?>"  type="date" onclick="this.showPicker()" required>	
							    
                 </div>



                  </div>     
                  
                  


                  <?php /*
                  <div class="row">
						                     
                  <div class="col-xs-12 col-sm-4 row-seperate">
                  <label>Adults<strong style="color:#F00;">*</strong></label>
                  <select class="form-control room_check" name="adults" required>
                  <option value="">Select No Of Adults</option>
                  <?php for($i=1;$i<=15;$i++){ ?>
                  <option value="<?= $i ?>" <?php if($i==$booking['adults']) { echo "selected"; } ?>><?= $i ?></option>
                  <?php } ?>
                  </select>
                 </div>


                 <div class="col-xs-12 col-sm-4 row-seperate">
                  <label>Children<strong style="color:#F00;">*</strong></label>

	                <select class="form-control room_check" name="childrens" required>
                  <option value="">Select No Of Children</option>
                  <?php for($i=0;$i<=10;$i++){ ?>
                  <option value="<?= $i ?>" <?php if($i==$booking['children']) { echo "selected"; } ?>><?= $i ?></option>
                  <?php } ?>
                  </select>
                 </div>


                 <div class="col-xs-12 col-sm-4 row-seperate">

                 <label>No Of Rooms<strong style="color:#F00;">*</strong></label>
	               <input class="form-control room_check" id="no_of_rooms" name="room_count"  type="number" value="<?= $booking['no_of_rooms']; ?>" required>	
							    
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


                <div class="row room_details"> 

                <div class="col-xs-12 col-sm-12 row-seperate">

                 <label>Room<strong style="color:#F00;">*</strong> </label>
                             
                <div class="row">
                  
                <div class="col-sm-12">

                <table class="table table-striped table-bordered">

                  <thead>

                  <tr>

                  <th>Image</th>

                  <th>Room Name</th>

                  <th>Available Rooms</th>

                  <th>Rate</th>

                  </tr>

                  </thead>


                  <tbody id="">

                  <tr>
			
                  <td><img src='<?= base_url() ?>/uploads/Rooms/<?=$booking['image'] ?>' style='height:80px;width:80px;'></td>

                  <td><?= $booking['name'] ?></td>

                  <td><?= $booking['avail_room'] ?></td>

                  <td><?= $booking['rate'] ?></td>

                  </tr>


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
                
                <label> Room No <strong style="color:#F00;"></strong></label>
							  <input class="form-control" name="room_no" autocomplete="off" value="<?= $booking['booking_room_no'] ?>">	
                

                </div>

                <div class="col-xs-12 col-sm-6 row-seperate">
                
                <label> Register No <strong style="color:#F00;"></strong></label>
							  <input class="form-control" name="reg_no" autocomplete="off" value="<?= $booking['booking_register_no'] ?>">	
                

                </div>


                <div class="col-xs-12 col-sm-4 row-seperate">
                
                <label> Phone <strong style="color:#F00;">*</strong></label>
                <div class="input-group">
							  <input class="form-control phone_input" name="phone" autocomplete="off" value="<?= $booking['customer_phone_number'] ?>" required>	
                
                <span class="input-group-addon transparent">
                <i id="phone_status_icon" class='fa fa-question' aria-hidden='true'></i>
                </span>

                </div>
							  </div>


                <div class="col-xs-12 col-sm-4 row-seperate">
                
                <label>Alternate Phone</label>
               
							  <input class="form-control" name="phone_alt" value="<?= $booking['customer_phone_number_alt']; ?>" autocomplete="off">	
                
							  </div>


                <div class="col-xs-12 col-sm-4 row-seperate">
                              <label> Email <strong style="color:#F00;"></strong></label>
							  <input class="form-control email_input" type="email" value="<?= $booking['customer_email']; ?>" name="email" autocomplete="off">	
							        </div>

                  </div>



                  <div class="row">
						 

                  <div class="col-xs-12 col-sm-6 row-seperate">
                  <label> First Name <strong style="color:#F00;">*</strong></label>
							    <input class="form-control f_name_input" type="text" name="f_name" value="<?= $booking['customer_first_name']; ?>" autocomplete="off" required>

							    </div>


                  <div class="col-xs-12 col-sm-6 row-seperate">
                    <label> Last Name <strong style="color:#F00;"></strong></label>
							    <input class="form-control l_name_input" type="text" name="l_name" value="<?= $booking['customer_last_name']; ?>" autocomplete="off">	
							    </div>
                   

                  </div>



                   <div class="row">
						 

                  <div class="col-xs-12 col-sm-6 row-seperate">
                  <label> Address <strong style="color:#F00;"></strong></label>
							    <textarea class="form-control address_input" name="address" autocomplete="off"><?= $booking['customer_address']; ?></textarea>

							    </div>

                        <div class="col-xs-12 col-sm-6 row-seperate">
                        <label> Update ID Proof <strong style="color:#F00;"></strong></label>

							          <div id="fileInputsContainer">
                        <div class="file-input-container">
                            <div class="input-with-button">
                                <input class="form-control" type="file" name="id_proof[]">
                                <button type="button" class="btn-action btn-add" onclick="addFileInput()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        </div>

                        <?php
          // If stored as JSON:
          if(!empty($booking['id_proof']))
          {
          $id_proofs = json_decode($booking['id_proof'], true);
          $ipn=1;
          foreach($id_proofs as $proof) {
          ?>
            <a download href="<?= base_url(); ?>uploads/Booking/<?= $proof; ?>" class="btn btn-warning"><i class="fa fa-print"></i> ID Proof <?= $ipn++; ?></a>
          <?php
          }

        }

          ?>
          
          


                  </div>

      </div>


                <div class="row"> 
                <div class="col-xs-12 col-sm-12 row-seperate text-center">

                <h3>Other Details</h3>

                </div>
                </div>


              <div class="row">

                  <div class="col-xs-12 col-sm-12 row-seperate">
                        <label> Special Requirements / Notes <strong style="color:#F00;"></strong></label>
                        <textarea class="form-control" name="booking_notes"><?= $booking['booking_notes']; ?></textarea>	
                  </div>

                </div>



                  

                  <div class="row">

                  <div class="col-xs-12 col-sm-12 row-seperate">
                  
                  <table class="table table-striped">


                    <tr>

                    <th>Room Total</th>
                    <td class="totals" id="room_total">
                    <?= round($booking['room_total']); ?>
                    </td>

                    </tr>


                     <tr>

                    <th>Additional</th>
                    <td class="totals" id="addon_total">
                    <?= round($booking['addon_amount']); ?>
                    </td>

                    </tr>



                    <tr id="extra_sec" style="display:none;">

                    <th>Extras (Kids)</th>

                    <td class="totals text-right" id="extra_price"></td>

                    </tr>



                    <tr>  

                    <th>Tax</th>
                    <td class="totals" id="tax">
                    <?= round($booking['tax_amount']); ?>
                    </td>

                    </tr>


                    <tr>

                    <th>Discounts</th>
                    <td class="totals text-right" >
                      <input class="text-right" name="discount" id="discount_amount" value="<?= round($booking['total_discounts']); ?>">
                    </td>
                    
                    </tr>

                
                   <tr>

                    <th>Total Amount</th>
                    <td class="totals" id="total_amount">
                    <?= round($booking['total_amount']); ?>
                  
                  </td>

                  <input type="hidden" name="room_total" id="room_total_val" value="<?= $booking['room_total']; ?>">
                  <input type="hidden" id="total_amount_val" name="total_amount" value="<?= $booking['total_amount']; ?>">
                  <input type="hidden" id="tax_amount_val" name="tax_amount" value="<?= $booking['tax_amount']; ?>">
                  <!--<input type="hidden" id="room_total_val" name="room_total">-->
                  <input type="hidden" id="addon_total_val" name="addon_amount" value="">
                  <input type="hidden" id="extra_price_val" name="extra_price">
                  <input type="hidden" id="extra_desc_val" name="extra_desc">

                  </tr>


                  </table>

                  </div>

                  </div>
                          
                  <div class="box-footer">

                    <button type="submit" class="btn btn-primary" id="submitbutton">Update</button>

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


              /*
                $('.room_check').on('change input', function() {
                    var selectedType = $('.type_select:checked').val();
                    //$('.type_select').val()('change');
                    var check_in_date = $('input[name="check_in"]').val();
                    var check_out_date = $('input[name="check_out"]').val();
                    var room_count = $('#no_of_rooms').val();
                    if (!room_count) room_count = 1;
                    // Fetch and display available rooms based on the selected room type
                    $.ajax({
                        url: '<?php echo base_url("admin/Bookings/GetRoomsAvailable"); ?>',
                        type: 'POST',
                        data: {room_count:room_count, room_type: selectedType,check_in: check_in_date, check_out: check_out_date },
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


                */


                  // Use event delegation for dynamically added elements
                  $(document).on('change input', '.room_select,#discount_amount,.date_select', function() {

                  var room_id = <?= $booking['booking_room_id'] ?>;

                  var booking_source = $('#booking_source_select').val() ?? 0;

                  var room_total = $('#room_total_val').val() ?? 0;

                  var no_of_rooms = <?= $booking['no_of_rooms'] ?>;

                  var check_in_date = $('input[name="check_in"]').val();
                 
                  var check_out_date = $('input[name="check_out"]').val();

                  var discounts = $('#discount_amount').val();

                  var children = $('#childrens_input').val();

                  var addons = [];

                  /*
                  $('.addon_row:visible').each(function(){
                      var ao_id = $(this).data('id'); // from data-id
                      var qty = parseInt($(this).find('.ao_quantity').val()) || 0;
                      if(qty > 0){
                          addons.push({id: ao_id, quantity: qty});
                      }
                  });
                  */

                  var addon_total = <?= $booking['addon_amount'] ?>;


                   $.ajax({
                        url: '<?php echo base_url("admin/Bookings/CalculatePrice"); ?>',
                        type: 'POST',
                        data: {booking_source:booking_source,room_id: room_id,no_of_rooms:no_of_rooms,check_in:check_in_date,check_out:check_out_date,discounts:discounts,children:children,room_total:room_total,addons:addons,addon_total:addon_total},
                        success: function(response) {
                           var data = JSON.parse(response)
                           if(data.status==1)
                           {
                           $('#room_total').html(data.base_price);
                           $('#room_total_val').val(data.base_price);
                           $('#addon_total').html(data.addon_total);
                           $('#addon_total_val').val(data.addon_total);
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
                           $('#tax_amount_val').val(0);
                           $('#total_amount').html('');
                           $('#addon_total').html('');
                           $('#addon_total_val').val(0);
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
        function addFileInput() {
            const container = document.getElementById('fileInputsContainer');
            
            // Remove plus button from current last input and add delete button
            const lastInput = container.lastElementChild;
            const lastButton = lastInput.querySelector('.btn-action');
            lastButton.className = 'btn-action btn-delete';
            lastButton.innerHTML = '<i class="fa fa-trash"></i>';
            lastButton.setAttribute('onclick', 'removeFileInput(this)');
            
            // Create new input container with plus button
            const newInputContainer = document.createElement('div');
            newInputContainer.className = 'file-input-container';
            newInputContainer.innerHTML = `
                <div class="input-with-button">
                    <input class="form-control" type="file" name="id_proof[]">
                    <button type="button" class="btn-action btn-add" onclick="addFileInput()">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            `;
            
            container.appendChild(newInputContainer);
        }
        
        function removeFileInput(button) {
            const inputContainer = button.closest('.file-input-container');
            const container = document.getElementById('fileInputsContainer');
            
            // Don't remove if it's the only input left
            if (container.children.length > 1) {
                inputContainer.remove();
                
                // Make sure the last remaining input has the plus button
                const lastInput = container.lastElementChild;
                const lastButton = lastInput.querySelector('.btn-action');
                if (!lastButton.classList.contains('btn-add')) {
                    lastButton.className = 'btn-action btn-add';
                    lastButton.innerHTML = '<i class="fas fa-plus"></i>';
                    lastButton.setAttribute('onclick', 'addFileInput()');
                }
            }
        }
    </script>

 
 
 
  
    
 