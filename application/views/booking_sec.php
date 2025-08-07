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

if(!empty($_GET['hotel_type'])) 

{

$hotel = $_GET['hotel_type'];

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


<?php /*

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

//End Old Booking Section

*/
?>




<section class="Ba-form-sec">   
 <div class="container">
 	<div class="row justify-content-center">
				<div class="col-xl-10 col-lg-12 col-md-12 abb">
  <div class="booking-area style3">
 
  <?php echo form_open(base_url().'check',array('method'=>"GET"))?>
  
  
  	<div class="banner-inner">
		 
			<div class="row">
			
		
			
								<div class="col-lg-3">
								<div class="form-group">
								 
						<select name="hotel_type" id="hotel_type" class="form-control" required>
            <option value="">Select Hotel</option>             
            <option value="1" <?php if($hotel=="1") { echo "selected"; }  ?>> Premium Residency</option>             
            <option value="2" <?php if($hotel=="2") { echo "selected"; }  ?>> Excecutive Stay</option>
           
           </select>
					<i class="fas fa-bed"></i>
				  </div>
				 </div>
         
				<div class="col-lg-3">
				<div class="form-group">
						<input type="text" id="daterangepikr"  placeholder="Check In - Check Out" class="form-control" value="" autocomplete="off" readonly/>
				    <i class="fas fa-calendar-alt"></i>

            <input type="hidden" class="form-control" name="checkin" id="checkin_value" autocomplete="off"
                            placeholder="Check In"  value="<?php echo $check_in_date; ?>" required>

            <input type="hidden" class="form-control" name="checkout" id="checkout_value" autocomplete="off"
                            value="<?php echo $check_out_date; ?>" required>

				</div>
				</div>
	
												
				 	  <div class="col-lg-3">
										<div class="form-group">
										<div class=" room-adults" onclick="qtySelector()">
										<span ><span id="adult-id"><?= $adults ?></span> adult · <span id="children-id"><?= $children ?></span> children · <span id="room-id"><?= $rooms_count ?></span> room</span>
                    <i class="fas fa-user"></i>
            </div>
											
						<div class="Viewmorezsec dropdowna-list" id="myDIV" style="display:none" >
						<div class="row">
						<div class="col-lg-12">
							<div class="row justify-content-between align-items-center">
							<div class="col-lg-6 col-6 col-sm-7 form-groups">
							
							<label>Adults</label>
							</div>
								<div class="col-lg-6 col-6 col-sm-5 form-groups">
								<div id="field1" class="field"> 
                <button type="button" id="sub" class="sub" data-id="adult-id">-</button>
                <input type="text" id="1" name="adults" value="<?= $adults ?>" class="field" />
                <button type="button" id="add" class="add" data-id="adult-id">+</button>
              </div>
							
							</div>
							</div>
						
						</div>
							<div class="col-lg-12">
							<div class="row justify-content-between align-items-center">

							<div class="col-lg-6 col-6 col-sm-7 form-groups">
							<label>Childrens</label>
							</div>

								  <div class="col-lg-6 col-6 col-sm-5 form-groups">
                  <div id="field2" class="field"> 
                  <button type="button" id="sub2" class="sub" data-id="children-id">-</button>
                  <input type="text" id="2" name="children" value="<?= $children ?>" class="field" />
                  <button type="button" id="add2" class="add" data-id="children-id">+</button>
                  </div>

							</div>
							</div>
						
						</div>
							<div class="col-lg-12">
							<div class="row justify-content-between align-items-center">
							<div class="col-lg-6 col-6 col-sm-7 form-groups">
							
							<label>Room</label>
							</div>
								<div class="col-lg-6 col-sm-5 col-6 form-groups">
								<div id="field3" class="field"> 
                <button type="button" id="sub3" class="sub" data-id="room-id">-</button>
                <input type="text" id="3" name="rooms_count" value="<?= $rooms_count ?>" class="field" />
                <button type="button" id="add3" class="add" data-id="room-id">+</button>
                </div>
							
							</div>
							</div>
						
						</div>
						
						</div>
						
						</div>

            
				  </div>
				 </div>
				 		 
				 
				 <div class="col-lg-2">
				 <div class="text-center">
				 
				 <button type="submit" name="search" class="as-btn shadow-none w-100" value="Search">Search</button>
				 </div>
				 
				 </div>
			</div>
			
		 
			</div>
  
 
   <?php echo form_close()?>


    </div>
  </div>
    </div>
  </div>
</section>


<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function() {

/*
$('.add').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
    var targetId = $(this).data('id');
    $('#'+targetId+'').html($(this).prev().val());
});
*/

$('.add').click(function () {
    var input = $(this).prev();
    var currentVal = parseInt(input.val()) || 0;
    var targetId = $(this).data('id');

    if (targetId === 'adult-id') {
        var roomCount = parseInt($("input[name='rooms_count']").val()) || 1;
        var maxAdults = roomCount * 2;

        if (currentVal < maxAdults) {
            input.val(currentVal + 1);
            $('#' + targetId).html(input.val());
        } else {
            alert('Maximum of ' + maxAdults + ' adults allowed for ' + roomCount + ' room(s).');
        }
    } else {
        input.val(currentVal + 1);
        $('#' + targetId).html(input.val());
    }
});

$('.sub').click(function () {
    if ($(this).next().val() > 0) 
    {
    $(this).next().val(+$(this).next().val() - 1);
    var targetId = $(this).data('id');
    $('#'+targetId+'').html($(this).next().val());
    }
   
});


/*

$('#adult_count_search,#child_count_search').change(function(){

var adults = parseInt($('#adult_count_search').val()) || 0;

var childs = parseInt($('#child_count_search').val()) || 0;

var rooms_count1 = Math.ceil(adults/2);

if((rooms_count1 == 1) && (childs > 2)){

  var rooms_count = rooms_count1+1;
  
} else {
    
  var rooms_count = Math.ceil(adults/2);
}

$("#rooms_count_search").val(rooms_count).change();

$('#rooms_count_search option').each(function() {
    $(this).prop('disabled', Number($(this).val()) < rooms_count)
})

});


$('#adult_count_search_modal,#child_count_search_modal').change(function(){

var adults = parseInt($('#adult_count_search_modal').val()) || 0;

var childs = parseInt($('#child_count_search_modal').val()) || 0; 

var adults_count = adults;

var child_count = childs;

var rooms_count = Math.ceil((adults_count+child_count)/3);

$("#rooms_count_search_modal").val(rooms_count).change();

$('#rooms_count_search_modal option').each(function() {
    $(this).prop('disabled', Number($(this).val()) < rooms_count)
})

});

*/


      $('#daterangepikr').daterangepicker({
      //startDate: moment().startOf('day'),
      //endDate: moment().endOf('day'),
      <?php if(!empty($check_in_date) && !empty($check_out_date)) { ?>
      startDate: moment('<?= $check_in_date ?>'),
      endDate: moment('<?= $check_out_date ?>'),
      <?php } else{ ?>
      startDate: moment().startOf('day'),
      endDate: moment().endOf('day'),
      <?php } ?>
      minDate: moment().startOf('day'),
      opens: 'left',
      autoUpdateInput: true,
      autoApply:true,
      locale: {
      cancelLabel: 'Clear'
      }
      },function(start, end) {
        $('#checkin_value').val(start.format('YYYY-MM-DD'));
        $('#checkout_value').val(end.format('YYYY-MM-DD'));
        });

      $('#daterangepikr').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('ddd DD MMM YYYY') + ' - ' + picker.endDate.format('ddd DD MMM YYYY'));
      });

      $('#daterangepikr').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });


      // Set values on load if already selected (optional)
      let initialVal = $('#daterange').val();
      if (initialVal) {
          let parts = initialVal.split(' - ');
          $('#checkin_value').val(parts[0]);
          $('#checkout_value').val(parts[1]);
      }


});


 function qtySelector() {

  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
   
    x.style.display = "block";
  } else {
 
    x.style.display = "none";
  }
}


</script>
