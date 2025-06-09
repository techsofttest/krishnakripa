

<?php 

$check_in_date="";

$check_out_date="";

$children="";

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

if(!empty($_GET['children']))

{

$children = $_GET['children'];

}

if(!empty($_GET['rooms_count']))
{
$rooms_count = $_GET['rooms_count'];
}

?>



<div class="booking-wrapper" id="booking_section_home">
<div class="container">
  <div class="booking-inner clearfix">

    <!--<p>Children Above 5 Years</p>-->

    <form class="form1 clearfix d-flex justify-content-center" action="<?php echo base_url(); ?>Check">
      <div class="col1 c1">
        <div class="input1_wrapper">
          <label>Check in</label>
          <div class="input1_inner">
            <input type="text" class="form-control input" id="checkindate" name="checkindate" placeholder="Check in" autocomplete="off" value="<?php echo $check_in_date; ?>" required>
          </div>
        </div>
      </div>

      <div class="col1 c2">
        <div class="input1_wrapper">
          <label>Check out</label>
          <div class="input1_inner">
            <input type="text" class="form-control input " id="checkoutdate" name="checkoutdate" placeholder="Check out" autocomplete="off" value="<?php echo $check_out_date; ?>" required>
          </div>
        </div>
      </div>

      <div class="col2 c3">
      
        <div class="select1_wrapper">
          <label>Adults</label>
          <div class="select1_inner">
            <select id="adult_count_search" class="select2 select" name="adults" required>
              <option value="" hidden>No Of Adults</option>
              <?php for($ad=1;$ad<21;$ad++) { ?>
              <?php if($ad == 1) { ?>
              <option value="<?php echo $ad;?>" <?php if($adults==$ad) { echo "selected"; } ?> ><?php echo $ad;?> Adult</option>
              <?php } else { ?>
              <option value="<?php echo $ad;?>" <?php if($adults==$ad) { echo "selected"; } ?> ><?php echo $ad;?> Adults</option>
              <?php }} ?>
             </select>
          </div>
        </div>
      </div>

      <div class="col2 c4">
        <div class="select1_wrapper">
          <label>Children</label>
          <div class="select1_inner">
            <select id="child_count_search" class="select2 select"  name="children" required>
            <option disabled style="color:red;" value="">Childrens Above 5Y</option>
            <option value="" selected hidden>No Of Children</option>
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
      </div>

                       

     

      <div class="col2 c5">
      
        <div class="select1_wrapper">
          <label>Rooms</label>
          <div class="select1_inner">

            <select id="rooms_count_search" class="select2 select" name="rooms_count" required>

              <option value="" hidden>Select Rooms</option>
              
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
      </div>


      <div class="col3 c6">
        <button type="submit" class="btn-form1-submit">Check Availability</button>
      </div>



    </form>
  </div>
</div>
</div>


