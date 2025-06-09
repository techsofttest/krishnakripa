

<?php $this->load->view('header');?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
.list_rows
{
	margin-bottom: 10px;
    padding-top: 5px;
}
.list_para_det
            {
            width:100%;
			text-align:left;
            }
             .list_dot
             {
             float: right;
    font-size: 20px;
    margin-top: -5px;
    font-weight: 600;
             }
             .list_answer
             {
             float:left;
             font-weight:bold;
             }
.booking-wrapper {
	top: -73px;
	bottom:unset;
}
.room_desc {
	width: 100%;
	display: block !important;
	text-align: center;
}
/*----------- Quantity Increament/Decreament ---------------*/





.qty-container {
	display: flex;
	align-items: center;
	justify-content: center;
}
.qty-container .input-qty {
	text-align: center;
	padding: 6px 10px;
	border: 1px solid #d4d4d4;
	max-width: 80px;
}
.qty-container .qty-btn-minus, .qty-container .qty-btn-plus {
	border: 1px solid #d4d4d4;
	padding: 3px 5px;
	font-size: 21px;
	height: 38px;
	width: 38px;
	transition: 0.3s;
}
.qty-container .qty-btn-plus {
	margin-left: -1px;
}
.qty-container .qty-btn-minus {
	margin-right: -1px;
}
.qty-container label {
	display: block;
	width: 100%;
	text-align: center;
}
.booking_step_heading {
	width: 100%;
	padding: 10px 10px;
	background-image: linear-gradient(to left, #ef7c00, #d16d00, #b45e00, #984f00, #7d4100);
	color: white;
	border-radius: 5px;
	 height:53px;
}
.booking_step_heading h2 {
font-size:20px;
  color:white;
  margin-top: -10px;
}
.table td {
	font-size: 18px;
	padding: 10px 10px;
	vertical-align: top;
}
 .table td:nth-child(2) {
 text-align: right;
}
.grand_total {
	color: red;
	font-weight: 600;
}
.grand_total td {
	font-size:23px;
}
/**********************
TELSTRA CHECKBOX STYLES
***********************/
.checkcontainer {
	display: block;
	width:90%;
	max-width:540px;
	margin:20px auto;
	border:solid 1px #b7b7b7;
	border-radius:10px;
	background:#fff;
}
.checkcontaineractive {
	background:#fbdada;
}
.checkform {
	display:table;
	vertical-align:middle;
}
.checkform .check, .checkform .text {
	display:table-cell;
	vertical-align:middle;
	padding:10px;
}
.checkform .check {
	text-align: center;
	padding:10px 10px 10px 0px;
}
.checkform .text {
	text-align: left;
	padding:10px 10px 10px 0px;
}
.checkform .check label {
	padding:10px;
}
.checkform .check input[type="checkbox"] {
	width:33px;
	height:33px;
}
.checkcontainer label input[type="checkbox"]:checked > .tesltra-submit {
	margin-top:2000px;
}
.checkform .text label {
	font-size:11px;
	font-weight:bold;
}
.checkcontainer .agreeterms {
	padding:0px;
	box-sizing:border-box;
}
.checkcontainer .agreeterms p {
	padding:10px;
	margin:0;
	font-weight:bold;
	font-size:17px;
}

.fac_icon li {
	display: inline-block;
	font-size: 25px;
	padding: 5px 15px;
}
.rooms1 .item .con p {
	font-size: 15px;
}

.ui-datepicker
{
	z-index: 100!important;
}
.form-control-checkbox
{
	float: right;
    width: 2em;
    height: 2em;
    margin-left: 1em
}


.rooms1 .item {
    
    height: 100%;

}


.radio{
    
    border: 2px solid lightblue;
    cursor:pointer;
    margin: 2px 0; 
    opacity: 0.7;
    border: 1px solid #bdbdbd;
    transition: all .3s ease;
    transform: scale(0.99);
   
}

.radio.selected{
    border-color: #ef7c00 !important;
    opacity: 1;
    transform: scale(1);
    transition: all .3s ease;
}

.radio:hover{
    border-color: #7c7c7c;
    opacity: 1;
    transform: scale(1);
    transition: all .3s ease;
}


.booking_counts {
    background: #d2d2d2;
    color: black;
    padding: 15px 0px;
    border-radius: 10px;
}

.booking_counts i{
  font-size: 30px;
}


.booking_counts span{
  display:block;
}


.price_details span
{

  font-size: 30px;
    font-weight: 600;
    padding: 0px 5px;
    color: red;

}
.Guest input, textarea{
  border: 1px solid #00000033 !important;
    margin-bottom: 10px;
}


.qtybtn {
    padding: 0px 10px;
    font-size: 20px;
    background: #0e4a9b;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    user-select: none;
}



</style>
<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/attraction-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Rooms
</h1>
           
        </div>
    </div>
</div>


<?php $this->load->view('booking_sec'); ?>
 
<section class="services rooms1" style="margin-top: 90px;">


  
   <form method="post">
  <div class="container" >
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12 col-sm-12 booking_step_heading">
        <h2 style="float:left" >You Selected Your Room For <?php echo $datediff;?> Nights</h2>  
      </div>
    </div>

    <?php 
    

    $total_price_nights     = 0;
	  $disc_price_nights      = 0;
	  $total_price_extra_bed  = 0;
	  $total_amount_tmp       = 0;
	  $total_gst              = 0;
	  $total_amount           = 0;


    $checkindate  = $_GET['checkindate'];
    $checkoutdate = $_GET['checkoutdate'];
    $rooms_count  = $_GET['rooms_count'];
    $adults       = $_GET['adults'];
    $children     = $_GET['children'];
    $total_person = intval($adults)+intval($children);

    $bed_tmp     = fmod($total_person,3);

    $extra_bed_count = 0;

    $persons = $total_person;

    $total_occupancy = $rooms_count*2;

    $rooms_bc= $rooms_count;

    $total_person_bc = $total_occupancy;

    
    if($total_occupancy<$total_person)

    {

    for($r=1;$r<=$rooms_count;$r++)
    
    {

      $to=$rooms_bc*2;
      
      if($persons>2 && $to<$persons)

        {
          
          $extra_bed_count++;

          $persons = $persons-3;

          $rooms_bc--;

        }

    }

   

  }

    $extra_bed = $extra_bed_count;  ?>



<div class="row text-center my-2 booking_counts">
    
<div class="col-lg-1"></div>


<div class="col-lg-3"><i class='bx bx-door-open'></i> <span>Rooms : <?php echo $rooms_count;?></span></div>


<div class="col-lg-3"><i class='bx bxs-user'></i> <span>Adults : <?php echo $adults;?></span></div>


<div class="col-lg-3"><i class='bx bxs-user-minus'></i> <span>Children : <?php echo $children;?></span></div>


<div class="col-lg-2">

<!--<i class='bx bx-bed' ></i> <span>Extra Bed : <?php echo $extra_bed;?></span>-->

</div>

<div class="col-lg-12 pt-3">

<p style="color:#ff8300;font-size:18px;display: flex;justify-content: center;align-items: center;"><i class='bx bx-info-circle' style="font-size: 25px;padding-right: 5px;"></i> 1 Room has maximum capacity of 2 people, You may change no of rooms according to your preference.</p>

</div>

</div>

    <?php

  $available_count=0;
 
  if(!empty($available_rooms))

  {

  $i=0; 

  foreach($available_rooms as $new=>$val) 

  {

  
  $available = TRUE;  

  $each_day = $this->Admin_model->check_room_each_day($val->roomid,$_GET['checkindate'],$_GET['checkoutdate']);

  foreach($each_day as $check_each)
  {
    
    $available_on_day = $check_each->avail_room;

    if($available_on_day<$_GET['rooms_count'])
    {
     
      $available=FALSE;

    }

  }

  
  
  if($available==TRUE)
  {

	if( ($i==$i) )
	{


  ?>
     
      <div class="row my-3 radio" data-value="<?php echo $val->roomid; ?>" title="Click To Select This Room">
      <div class="col-md-6 p-0">
        <div class="item">
         <a href="<?php echo base_url();?>rooms/<?php echo $val->room_slug_name;?>"> <div class="position-re o-hidden"><img src="<?php echo base_url();?>uploads/Rooms/<?php echo $val->image;?>" alt=""> </div></a>
            <div class="con">
            <h6><a href="<?php echo base_url();?>rooms/<?php echo $val->room_slug_name;?>">Rs <?php echo $val->rate;?> / Night</a></h6>
           
             <p><?php echo $val->avail_room;?>&nbsp; Rooms Available</p> 
            
            <div class="line"></div>

            <div class="row facilities">

              <div class="col col-lg-2">

                <p>Room Size : <?php echo $val->room_size; ?></p>            
               
                
              </div>

              <!--<div class="col-lg-2">-->
              <!--  <p>Extra Bed : <?php echo $val->extrabed_price; ?>/-</p>-->
              <!--</div>-->
              <div class="col col-lg-2 text-right">
                <div class="permalink"> <a target="_blank" href="<?php echo base_url();?>rooms/<?php echo $val->room_slug_name;?>">Learn More <i class="bi bi-arrow-right"></i></a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
           
      
      <div class="col-md-6 p-0 bg-cream ">

        <div class="content">


          <div class="cont text-left room_desc">
            
            <h4><?php echo $val->name;?></h4>            
           
          </div>


          <div class="row">  

            <div class="col-lg-6 text-center">
            
              <div class="qty-container">
              
              <div class="input_fields_wrap_<?php echo $val->roomid?> input_fields_wrap">
                
               
              <input type="hidden" value="1" style="width: 25%;text-align: center;display:inline-block;" class="cboNumRooms" id="cboNumRooms-<?php echo $val->roomid;?>" readonly/>
               
              
              </div>

              
              </div>
            </div>


            <div class="row">


              <div class="col-lg-12 text-center price_details">
              
                <p>Rs <span><?php echo $val->rate; ?></span>/Night</p>

              </div>

            
            </div>



            
            <div class="row">

                <div class="col-lg-12">
            
                </div>


            </div>
       
            
          </div>
        </div>
      </div>


    </div>




      <input type="hidden" id="single_price<?php echo $val->roomid;?>" value="<?php echo $val->rate;?>">
      <input type="hidden" id="total_rooms<?php echo $val->roomid;?>" value="<?php echo $val->avail_room;?>">
      <input type="hidden" id="selected_rooms<?php echo $val->roomid;?>" value="0">
      <input type="hidden" id="total_price<?php echo $val->roomid; ?>" value="0">

      

      
      <input type="hidden" id="s_roomid" value="<?php echo $val->roomid;?>">

     


      <input type="hidden" id="s_total_price_nights<?php echo $val->roomid; ?>"  value="<?php echo $total_price_nights;?>">
      <input type="hidden" id="s_disc_price_nights<?php echo $val->roomid; ?>" value="<?php echo $disc_price_nights;?>">
      <input type="hidden" id="s_total_price_extra_bed<?php echo $val->roomid; ?>" value="<?php echo $total_price_extra_bed;?>">
      <input type="hidden" id="s_total_gst<?php echo $val->roomid; ?>" value="<?php echo $total_gst;?>">
      <input type="hidden" id="s_total_amount<?php echo $val->roomid; ?>" value="<?php echo $total_amount;?>">
   


    <?php  

      $i++;
	}

$available_count++;

}



      } 
      ?>


    <?php 
    }

    ?>
    

    <?php  if($available_count<1) { ?>

    <div class="col-lg-12 text-center my-3">
    <h2 class="avail">No Rooms Available</h2>
    </div>

    <?php }  ?>
    </form>
    
    <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12 col-sm-12 booking_step_heading">
        <h2>Enter Guest Details</h2>
      </div>
    </div>        
<div class="row">
<div class="col-lg-8">
    <div class="row my-3 Guest">
      <form method="post" action="<?php echo base_url()?>Check/Enquiry" id="check-form">
          <input type="hidden" value="<?php echo $_GET['checkindate']?>" name="checkin">
          <input type="hidden" value="<?php echo $_GET['checkoutdate']?>" name="checkout">
          <input type="hidden" value="<?php echo $_GET['hotel']?>" name="hotel">
          <input type="hidden" value="<?php echo $_GET['adults']?>" name="adults">
          <input type="hidden" value="<?php echo $_GET['children']?>" name="children">
          <input type="hidden" value="<?php echo $_GET['rooms_count']?>" name="rooms_count">
           <input type="hidden" value="<?php echo $total_rate;?>" name="totalrate">
            <input type="hidden" value="<?php echo $room_gst;?>" name="gst">
             <input type="hidden" value="<?php echo $grand_rate;?>" name="grand">
        <div class="row">
          <div class="col-lg-6">
            <input type="text" class="form-control" placeholder="Name" name="name" required>
          </div>
          <div class="col-lg-6">
            <input type="email" class="form-control" placeholder="Email" name="email" required/>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" placeholder="Mobile" name="mobile" required>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" placeholder="Address" name="address" required>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" placeholder="City" name="city" required>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control" placeholder="Post Code" name="post_code" required>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control" placeholder="Country" name="country" required>
          </div>
          <div class="col-lg-12">
<textarea name="bed_pref"  class="form-control" placeholder="Comment..."></textarea>
          </div>
        </div> 
        
          <!-- Google reCAPTCHA widget -->
 <div class="form-group col-12">
        <div class="g-recaptcha" data-sitekey="6LdhoLAqAAAAAMH-IZ8__VbUYsFwrNvpSkbIdd1o" required></div>
    </div>
        
        
        
      <div style="display: flex;align-items: center;justify-content: center;">      
    <div class="col-lg-4" >   
    <input class="as-btn style4 shadow-none" type="submit" name="sub" value="Submit">
      </div></div>
  </form>
</div>
</div>
 <?php if(!empty($available_rooms)){?>
<div class="col-lg-4" style="margin-top:18px;">

<table class="table">
          <tr>
            <td>No Of Days</td>
            <td id="display_nights"><?php echo $datediff;?> Nights</td>
          </tr>
          <tr>

          <tr>
            <td>No Of Rooms</td>
            <td id="display_nights"><?php echo $rooms_count;?> Rooms</td>
          </tr>
          <tr>

            <td>Total Amount</td>
            <td id="display_amount">Rs.&nbsp;<?php echo $total_rate;?></td>
          </tr>         
          <tr>
            <td>GST</td>
            <td id="display_gst"><?php echo $room_gst;?>%</td>
          </tr>
          <tr class="grand_total">
            <td>Grand Total</td>
            <td id="display_grandtotal">Rs.&nbsp;<?php echo $grand_rate;?></td>
          </tr>
        </table>
      </div>
      <?php } ?>
    </div>
</div>
</div>
</section>

<?php $this->load->view("footer")?>
<script>

$( document ).ready(function() {

var adults = parseInt($('#adult_count_search').val()) || 0;

var childs = parseInt($('#child_count_search').val()) || 0;

var adults_count = adults+childs;

var rooms_count = Math.ceil(adults_count/3);

$('#rooms_count_search option').each(function() {
    $(this).prop('disabled', Number($(this).val()) < rooms_count)
})

  
});

</script>


<script type="text/javascript">
function changeval(roomcount,roomid)
{
var adult = document.getElementById("adult_"+roomcount+"_"+roomid).value;

alert(adult)
if(adult == 3)
{
document.getElementById("extrabed_"+roomcount+"_"+roomid).checked = true;
}
else
{
document.getElementById("extrabed_"+roomcount+"_"+roomid).checked = false;	
}

//'extrabed_'+roomcount'_'+roomid
}
alertify.set('notifier','position', 'top-center');


 var x = 1; 
function check(crtid)
{
	   
        //var val1            = $("#cboNumRooms-"+crtid).val();
	    var max_fields      = parseInt($('#total_rooms'+crtid).val()); 
        var single_price    =  parseInt($('#single_price'+crtid).val());
        var selected_rooms  = parseInt($('#selected_rooms'+crtid).val());
        var wrapper         = $(".room_det_"+crtid); 
	    var add_button      = $(".add_field_button_"+crtid);
		
		 $('#cboNumRooms-'+crtid).val(x);
		 
		//var x = val1; 
	    var roomid = crtid;
        if(selected_rooms<=max_fields)
        {
	    x++; 
	     alert(x)
		 
	      $(wrapper).append('<div class="col-lg-2 text-center"><p style="padding-top:8px"><strong>Room '+x+'</strong></p></div><div class="row"><div class="col-lg-3 text-center"><select class="form-control" onChange="changeval('+x+','+roomid+')" name=""><option value="1">1 Adult</option><option value="2" selected>2 Adults</option><option value="3">3 Adults</option></select></div><div class="col-lg-3 text-center"><select class="form-control" name=""><option value="0" selected>0 Child</option><option value="1">1 Child</option><option value="2">2 Child</option><option value="3">3 Child</option><option value="4">4 Child</option></select></div><div class="col-lg-4 text-center"><p style="color:#e10014;"><span style="float:left"><input class="form-control-checkbox" type="checkbox" name="extrabed" value="1" id="extrabed_"> </span><i class="flaticon-bed"></i>Extra bed</p></div></div><div class="col-lg-12 text-center"><div class="row"><div class="col-lg-3 text-center"><select class="form-control" name=""><?php for($agef=0;$agef<11;$agef++) { ?><option value="<?php echo $agef;?>"><?php echo $agef;?> Year<?php if($agef>1) { echo 's';}?> Old</option><?php } ?></select></div><div class="col-lg-3 text-center"><select class="form-control" name=""><?php for($agef=0;$agef<11;$agef++) { ?><option value="<?php echo $agef;?>"><?php echo $agef;?> Year<?php if($agef>1) { echo 's';}?> Old</option><?php } ?></select></div><div class="col-lg-3 text-center"><select class="form-control" name=""><?php for($agef=0;$agef<11;$agef++) { ?><option value="<?php echo $agef;?>"><?php echo $agef;?> Year<?php if($agef>1) { echo 's';}?> Old</option><?php } ?></select></div><div class="col-lg-3 text-center"><select class="form-control" name=""><?php for($agef=0;$agef<11;$agef++) { ?><option value="<?php echo $agef;?>"><?php echo $agef;?> Year<?php if($agef>1) { echo 's';}?> Old</option><?php } ?></select></div></div></div>'); 
		
        }

        else
        {
         
          alertify.error('Maximum Rooms Selected');

          return false;
        }

        var selected_rooms = ++selected_rooms;
        
        var total_price = single_price * selected_rooms;

        $('#selected_rooms'+crtid).val(selected_rooms);

        $('#total_price'+crtid).val(total_price);

}	



function remove(crtid)
{


}

	   


$(function() {
      
   $("#checkindate").datepicker({
      dateFormat: "dd-mm-yy" ,
      minDate: 0,
      onSelect: function(date) {
       var arr = date.split("-");
       var date = new Date(arr[2]+"-"+arr[1]+"-"+arr[0]);

var d = date.getDate();

var m = date.getMonth();

var y = date.getFullYear();

var minDate = new Date(y, m, d + 1);

$("#checkoutdate").datepicker('option','minDate', minDate);

}
     ,  
     })

   $("#checkoutdate").datepicker({
     dateFormat: "dd-mm-yy" ,
     })
 
});



   </script> 


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

<!-- Quantity Button Start --> 

<script>

var buttonPlus  = $(".qty-btn-plus");
var buttonMinus = $(".qty-btn-minus");

var incrementPlus = buttonPlus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  $n.val(Number($n.val())+1 );
});

var incrementMinus = buttonMinus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  var amount = Number($n.val());
  if (amount > 0) {
    $n.val(amount-1);
  }
});


</script> 




<script>


$('.radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
    var val = $(this).attr('data-value');
    //alert(val);
    $('#f_roomid').val(val);
    $('#f_roomid').change();
});


//$('input[type=radio][name=selected_room]').change(function() {

  $('#f_roomid').change(function() {    

    var roomid = this.value;

    var total_price = $('#s_total_price_nights'+roomid).val();

    var discount_price = $('#s_disc_price_nights'+roomid).val();

    var extrabed_price = $('#s_total_price_extra_bed'+roomid).val();

    var total_gst = $('#s_total_gst'+roomid).val();

    var final_amount = $('#s_total_amount'+roomid).val();

   //Update Hidden Totals Depending On Selected Room

   $('#f_total_price_nights').val(total_price);

   $('#f_disc_price_nigths').val(discount_price);

   $('#f_total_price_extra_bed').val(extrabed_price);

   $('#f_total_gst').val(total_gst);

   $('#f_total_amount').val(final_amount);

   $('#f_roomid').val(roomid);

   //


  //Show To Customer

   $('#display_amount').html(total_price);

   $('#display_discount').html(discount_price);

   $('#display_extrabed').html(extrabed_price);

   $('#display_gst').html(total_gst);

   $('#display_grandtotal').html(final_amount);

});


</script>



<script>

function formValidate()
{

 if($('#f_roomid').val()=="")
  {
    alert('Please Select Room To Continue');
    return false;
  }
  else
  {
    return true;
  }

}

</script>




<script>
  var proQty = $('.pro-qty');
	proQty.prepend('<div class="col-lg-3"><span class="dec qtybtn">-</span></div>');
	proQty.append('<div class="col-lg-3"><span class="inc qtybtn">+</span></div>');
	proQty.on('click', '.qtybtn', function () {
	var $button = $(this);
	var oldValue = $button.parent().find('input').val();
	if ($button.hasClass('inc')) {

	var newVal = parseFloat(oldValue) + 1;
 

		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
    
				var newVal = parseFloat(oldValue) - 1;

     
			} else {
				newVal = 0;
			}
      
		}
		$button.parent().find('input').val(newVal);
    $('#xtrabed_nos').html(newVal);
	});

</script>


  <script>
            
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $recaptcha_secret = "6LdhoLAqAAAAAMDXdlG__dGL4HLhfwR5pFshJfjL"; // Replace with your Secret Key
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verify the reCAPTCHA response
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $response_data = json_decode($verify_response);

    if ($response_data->success) {
        // reCAPTCHA verified successfully
        echo "Message sent successfully!";
    } else {
        // reCAPTCHA failed
        echo "Please complete the reCAPTCHA.";
    }
}
        </script>
        
        <script>
    document.getElementById('check-form').addEventListener('submit', function(event) {
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            // Prevent form submission
            event.preventDefault();
            // Show an alert if reCAPTCHA is not completed
            alert("Please complete the reCAPTCHA to submit the form.");
        }
    });
</script>
        





</body>
</html>