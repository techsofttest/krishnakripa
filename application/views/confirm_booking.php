<?php $this->load->view('header');?>



<?php 

$check_in_date="";

$check_out_date="";

$children=0;

$hotel="";

$adults=1;

$rooms_count=1;


if(!empty($_GET['checkin'])) 
{

$check_in_date = $_GET['checkin'];

}


if(!empty($_GET['checkout'])) 
{

$check_out_date = $_GET['checkout'];

}


if(!empty($_GET['adults'])) 

{

$adults = $_GET['adults'];

}

if(!empty($_GET['hotel'])) 

{

$hotel = $_GET['hotel'];

}

if(!empty($_GET['children']))

{

$children = $_GET['children'];

}

if(!empty($_GET['rooms_count']))
{
$rooms_count = $_GET['rooms_count'];
}

?>



<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/attraction-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Confirm And Pay
</h1>
           
        </div>
    </div>
</div>




<div class="Carts-ccsec th-cart-wrapper">

<div class="container">

 
	 
<div class="row">

<div class="col-lg-12 text-center my-3">

<?php
$query_params = [
                 'room_id'     => $this->input->get('room_id'),
                 'checkin'     => $this->input->get('checkin'),
                 'checkout'    => $this->input->get('checkout'),
                 'adults'      => $this->input->get('adults'),
                 'children'    => $this->input->get('children'),
                 'rooms_count' => $this->input->get('rooms_count'),
                 'hotel_type' => $this->input->get('hotel_type'),
];
?>

<a class="btn btn-danger" href="<?= base_url(); ?>Check?<?= http_build_query($query_params)?>"><i class="fa-solid fa-arrow-left"></i> Return To Booking</a>

</div>



<div class="col-lg-4 ">
<div class="Booking-left">
 
<div class="booki-box1">

 
									
<h3><?= $hotel_details['hotel_name']; ?></h3>
<p><?= $hotel_details['address_line_1'] ?></p>
<p><?= $hotel_details['address_line_2'] ?></p>
<p>Pin : <?= $hotel_details['address_pincode']; ?></p>


<ul>
  

                                       
<?php foreach($facilities as $fac){  ?>
<li><img src="<?= base_url(); ?>uploads/Rooms/<?= $fac->Facimage ?>" title="<?= $fac->Factitle ?>"></li>
<?php } ?>

                                   


</ul>
 			
									
</div>

 
<div class="booki-box2">
<h3>Your booking details</h3>

<h4>Room </h4>
<h5><?= $room['name']; ?></h5>
<div class="row mb-30 mt-30">

<div class="col-lg-6 col-md-6">

<div class="cc-check">
<h4>Check-in</h4>
<h5><?php echo date('D',strtotime($check_in_date)) ?>, <?php echo date('d M Y',strtotime($check_in_date)) ?></h5>

<p>From 1:00 PM</p>
</div>
</div>
<div class="col-lg-6 col-md-6">

<div class="cc-check">
<h4>Check-out</h4>
<h5><?php echo date('D',strtotime($check_out_date)); ?> , <?php echo date('d M Y',strtotime($check_out_date)); ?></h5>

<p>Until 11:00 AM</p>
</div>
</div>
</div>
<hr>
<h4>Total length of stay:</h4>
<h5><?= $booking_details['no_of_days'] ?> night</h5>
<hr>
<h4>You selected</h4>
<h5><?= $rooms_count ?> room for <?= $adults ?> adults <?php if($children>0) { ?> <?= $children ?> children <?php } ?></h5>
</div>


<div class="booki-box3">
<h3>Your price summary</h3>

<table class="table table-bordered">

<tr>

<th>Room</th>

<td class="text-end"><?= $booking_details['total_price'] ?></td>

</tr>


<?php if(!empty($booking_details['extra_price'])) { ?>
<tr>

<th><?= $booking_details['extra_desc'] ?></th>

<td class="text-end"><?= $booking_details['extra_price'] ?></td>

</tr>

<?php } ?>



<tr>

<th>Tax</th>

<td class="text-end"><?= $booking_details['gst'] ?></td>

</tr>


</table>

<div class="price-bbg ">

<div class="pps-1">Price</div>
<div class="pps-2 text-end" >RS <?= $booking_details['grand_total']; ?>
<span> Includes taxes and fees</span></div>
</div>

 
</div>

</div>
</div>
<div class="col-lg-8 ">
<div class="Booking-right">

<div class="Booking-right-ss">
<h3>Enter your details</h3>

<form action="<?php echo base_url()?>Check/BookNow" method="POST">

<div class="row   Guest pay-form">

        <div class="col-lg-6 form-group col-sm-6">
		  
		  <label>First Name</label>
            <input type="text" class="form-control" placeholder="First Name" name="fname" required>
          </div>

          <div class="col-lg-6 form-group col-sm-6">
		    <label>Last Name</label>
            <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
          </div>

          <div class="col-lg-6 form-group col-sm-6">
		        <label>Mobile</label>
             <input type="text" class="form-control" placeholder="Mobile" name="mobile" required>
          </div>

          <div class="col-lg-6 form-group col-sm-6">
		        <label>Email</label>
             <input type="email" class="form-control" placeholder="Email" name="email" required/>
          </div>

          <div class="col-lg-12 form-group col-sm-12">
		      <label>Address</label>
          <textarea rows="3" class="form-control" placeholder="Address" name="address" required></textarea>
          </div>

          <div class="col-lg-12 form-group col-sm-12">
		      <label>Notes/Preferences</label>
          <textarea rows="3" name="notes"  class="form-control" placeholder="Notes/Preferences..."></textarea>
          </div>


          <input type="hidden"  name="room_id" value="<?= $room['roomid'] ?>">

          <input type="hidden"  name="check_in" value="<?= $check_in_date ?>">

          <input type="hidden"  name="check_out" value="<?= $check_out_date ?>">

          <input type="hidden"  name="adults" value="<?= $adults ?>">

          <input type="hidden"  name="children" value="<?= $children ?>">

          <input type="hidden"  name="no_of_rooms" value="<?= $rooms_count ?>">

		 
		      <div class="col-lg-12 form-group ">

            <button type="submit" class="as-btn  ">Pay Now</button>

          </div>

		
        </div>

         </form>

</div>
</div>
</div>
</div>
 
 </div>
</div>



 




<?php $this->load->view('footer'); ?>

<script>$(window).on("scroll", function() {

    if ($(this).scrollTop() > 50) {

      $("#sticky-wrapper").addClass("is-sticky");

    } else {

      $("#sticky-wrapper").removeClass("is-sticky");

     

    }

  });

	</script> 


<script>


 var header = $('#header-sticky');
    var win = $(window);
    
    win.on('scroll', function() {
        if ($(this).scrollTop() > 300) {
           
			 $("#back-top").addClass("back-top-animation");
        } else {
           
			$("#back-top").removeClass("back-top-animation");
        }
    });

</script> 







</body>
</html>