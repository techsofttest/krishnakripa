<?php $this->load->view("header")?>


<!-- Magnific Popup -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/magnific-popup.min.css">


<style>

.buy-theme{
  z-index:0px;
}

.nav-tabs
{
    justify-content: center;
    border-bottom:unset;
}

.nav-link.active {
    color: #ffffff !important;
    background-color: #d10707 !important;
}

.nav-tabs .nav-link {
    margin: 0px 5px;
}

</style>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/hotel-room-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title"><?php echo $room['name']?></h1>
        </div>
    </div>
</div>



 <div class="Rpoom-ddsec">
   <div class="container">
       <div class="row justify-content-between align-items-center">
	
	<div class="col-lg-8 col-md-8">
   <div class="product-about Poo-detail">
		<div class="title-area   mb-10 "> 
          <h2 class="sec-title"><?= $room['name']; ?></h2>
        
 
    </div>
         
	 <div class="deal-rating mar-bottom-15 mb-30">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
 
      </div>
	     </div>
	  <div class="col-auto mb-30">
	  
	   <p class="priceee">RS <?= $room['rate']; ?> / NIGHT</p>
	  </div>
	     
    </div>
    <div class="row ">
	
	<div class="col-xl-8 col-lg-8">

	<div class="row hh-dd-row">
  
  <div class="col-lg-12 col-md-12 col-12">
  <div class="hh-gal-img">
  
  <a href="#" data-bs-toggle="modal" data-bs-target="#SigninModal" class="image-open"><img class="hh-hal-left" src="<?php echo base_url(); ?>uploads/Rooms/<?= $room['image'] ?>"></a>
  </div>
  
  </div>
  

  <?php foreach($moreimages as $mimage){ ?>

  <div class="col-lg-2">
  <div class="hh-gal-img">
  <a href="#" data-bs-toggle="modal" data-bs-target="#SigninModal" class="image-open"><img class="hh-hal-bottom" src="<?= base_url(); ?>uploads/Rooms/<?= $mimage->more_image ?>"></a>
  </div>
  </div>

  <?php } ?>



  </div>
  
  
  
  
<div class="Price-sec">


<?php if(!empty($room['description'])){ ?>

<h3>Room Details</h3>
  
<p><?= $room['description']; ?></p>

<?php } ?>


 
<h3>Room Facilities</h3>

<ul>

<?php foreach($fac as $facility){ ?>

<li><img src="<?= base_url(); ?>uploads/Rooms/<?= $facility->Facimage ?>" alt=""><?= $facility->Factitle ?></li>

<?php } ?>

</ul>

</div>

</div>

<div class="col-lg-4 col-md-8">

<div class="rooright">

<?php echo form_open(base_url().'Check/Confirm',array('method'=>"GET",'class' => "RContactpage-form"))?>

<input name="hotel_type" value="<?= $room['hotel'] ?>" type="hidden">

<input name="room_id" value="<?= $room['roomid']; ?>" type="hidden">

<h3>Book Now</h3>

          <div class="row">
         
          
          <div class="form-group col-md-12">
			    <label>Check In & Check Out</label>

            <input type="text" id="daterangepikr"  placeholder="Check In - Check Out" class="form-control" value="" autocomplete="off" readonly/>
				   
            <input type="hidden" class="form-control" name="checkin" id="checkin_value" autocomplete="off"
                            placeholder="Check In"  value="" required>

            <input type="hidden" class="form-control" name="checkout" id="checkout_value" autocomplete="off"
                            value="" required>
			 
              </div>
			  
		 
			 
			 		    <div class="form-group col-md-12">
												
                        <div class="form-group">
								 
										 	 <div class=" room-adults" onclick="qtySelector()">
											 <span ><span id="adult-id">1</span> adult · <span id="children-id">0</span> children · <span id="room-id">1</span> room</span>
											  
			
 
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
                <input type="text" id="1" name="adults" value="1" class="field" />
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
                  <input type="text" id="2" name="children" value="0" class="field" />
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
                <input type="text" id="3" name="rooms_count" value="1" class="field" />
                <button type="button" id="add3" class="add" data-id="room-id">+</button>
                </div>
							
							</div>
							</div>
						
						</div>
						
						</div>
						
						</div>





											


				  </div>



				 </div>

               
			      
                <div class="col-12 mt-10">
              <button type="submit" class="as-btn">Book Now</button>
            </div>
          </div>

        <?php echo form_close()?>

</div>

</div>
   </div>
   

  </div>
 </div>




 <div class="modal fade singnup-modal" id="SigninModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <div class="modelcontainer right-panel-active" id="container">
	  
	  <h3 class="ttyii"><?= $room['name']; ?></h3>
	      <div class="row  gal-rows  "  >

          <?php foreach($moreimages as $mimage){ ?>
 
            <div class="col-lg-4 col-md-4 col-sm-6 rounded img-hover-wrap" >
              
              <div class="img-hover-card" > <a href="javascript:void(0);"   data-fancybox="gallery"><img src="<?= base_url(); ?>uploads/Rooms/<?= $mimage->more_image ?>" alt=""></a>
              
              <div class="img-hover-detail">
                <h3 class="img-hover-title"><a href="javascript:void(0);" >   </a></h3>
              </div>

              </div>
            </div>

            <?php } ?>
            
          </div>
	  
        <div class="form-container sign-up-container">
		
		
		<div class="formsecrr">
         
		  <h2>  </h2>
          
        
		  
		 
		  </div>
        </div>
       
        
      </div>
    </div>
  </div>
</div>











        <?php $this->load->view("footer")?>



        <script type="text/javascript">

document.addEventListener("DOMContentLoaded", function() {

  
$('.add').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
    var targetId = $(this).data('id');
    $('#'+targetId+'').html($(this).prev().val());
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
      startDate: moment().startOf('day'),
      endDate: moment().endOf('day'),
      minDate: moment().startOf('day'),
      opens: 'left',
      autoUpdateInput: false,
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

        
        
        
        
<script>
    /*
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
       
    document.getElementById('book-form').addEventListener('submit', function(event) {
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            // Prevent form submission
            event.preventDefault();
            // Show an alert if reCAPTCHA is not completed
            alert("Please complete the reCAPTCHA to submit the form.");
        }
    });
    */
</script>
        
        
        
<script src="<?php echo base_url()?>assets/js/main.js"></script> 

        