<?php 

$check_in_date="";

$check_out_date="";

$children="";

$hotel="";

$adults="";

$rooms_count="";


if(!empty($_GET['checkindate'])) 
{

$check_in_date = $_GET['checkindate'];

}


if(!empty($_GET['checkoutdate'])) 
{

$check_out_date = $_GET['checkoutdate'];

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
<section class="Ba-form-sec">
 <div class="container">
  <div class="booking-area style3">
 
  <?php echo form_open(base_url().'check',array('method'=>"GET"))?>
    <div class="booking-area-form">
      <div class="booking-box">
        <div class="booking-check">
          <input type="text" class="form-control" name="checkindate" id="datepicker" autocomplete="off"
                            placeholder="Check In"  value="<?php echo $check_in_date; ?>" required>
          <i class="fas fa-calendar-alt"></i> </div>
      </div>
      <div class="booking-box">
        <div class="booking-check">
          <input type="text" class="form-control" name="checkoutdate" id="datepicker1" autocomplete="off"
                            placeholder="Check Out" value="<?php echo $check_out_date; ?>" required>
          <i class="fas fa-calendar-alt"></i> </div>
      </div>

      <div class="booking-box">
        <div class="contact-field">
        <select id="hotel_search" class="form-select" name="hotel" required>
            <option value="">Select</option>             
            <option value="0" <?php if($hotel == "0"){echo "selected";}?>> Premium Residency</option>             
            <option value="1" <?php if($hotel == "1"){echo "selected";}?> > Excecutive Stay</option>
           
           </select>
        </div>
      </div>
      
      <div class="booking-box">
        <div class="contact-field">
        <select class="form-select" id="RoomAvl" name="room" required>
            <option value="">Select Room</option>     
            </select>      
           
        </div>
      </div>
      
      
      <div class="booking-box">
        <div class="contact-field">
          <select name="adults" id="adult_count_search" class="form-select" required="">
            <option value="">Adults</option>
            <?php for($ad=1;$ad<21;$ad++) { ?>
              <?php if($ad == 1) { ?>
              <option value="<?php echo $ad;?>" <?php if($adults==$ad) { echo "selected"; } ?> ><?php echo $ad;?> Adult</option>
              <?php } else { ?>
              <option value="<?php echo $ad;?>" <?php if($adults==$ad) { echo "selected"; } ?> ><?php echo $ad;?> Adults</option>
              <?php }} ?>          
          </select>
        </div>
      </div>
     

      <div class="booking-box">
        <div class="contact-field">
          <select name="children" id="child_count_search" class="form-select" required="">
            <option value="">Childen</option>
            <option value="0" <?php if(empty($children) && isset($_GET['children']) ){ echo "selected"; } ?> >No Children</option>
               <?php for($ch=1;$ch<5;$ch++) { ?>
              <?php if($ch == 1) { ?>
              <option value="<?php echo $ch;?>" <?php if($children==$ch) { echo "selected"; } ?>><?php echo $ch;?> Child</option>
              <?php } else { ?>
              <option value="<?php echo $ch;?>" <?php if($children==$ch) { echo "selected"; } ?>><?php echo $ch;?> Children</option>
              <?php }} ?>
          </select>
        </div>
      </div>
	        <div class="booking-box">
        <div class="contact-field">
          <select name="rooms_count" id="rooms_count_search" class="form-select" required="">
            <option value="">Rooms</option>
            <?php for($roo=1;$roo<11;$roo++) { ?>
              <?php if($roo == 1) { ?>
              <option value="<?php echo $roo;?>" <?php if($rooms_count==$roo) { echo "selected"; } ?> ><?php echo $roo;?> Room</option>
              <?php } else { ?>
              <option value="<?php echo $roo;?>" <?php if($rooms_count==$roo) { echo "selected"; } ?> ><?php echo $roo;?> Rooms</option>
              <?php }} ?>
              <?php if($rooms_count > 10) { ?>
              <option value="<?php echo $rooms_count;?>" selected><?php echo $rooms_count;?> Rooms</option>              
              <?php } ?> 
          </select>
        </div>
      </div>
      <div class="booking-btn-wrapp">
        <div class="booking-btn">
          <button name="search" class="as-btn shadow-none">Search</button>
        </div>
      </div>
    </div>
    </div>
    </div>
 <?php echo form_close()?>
  </div>
</section>
