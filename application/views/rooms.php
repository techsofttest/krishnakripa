<?php $this->load->view("header")?>


<style>

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


<section  class="room-detailsec">
    <div class="container">
	
	
	<div class="row align-items-center">
	<div class="col-lg-6 col-md-6">
	
	<div class="room-left">
	<img src="<?php echo base_url()?>uploads/Rooms/<?php echo $room['image']?>" width="100%">
	 </div>
</div>
	<div class="col-lg-6 col-md-6">
	
	<div class="room-right">
	
	  <div class="room-details mt-30">
                    <div class="room-details_price">
                        <span class="room-details_subtitle">RS <?php echo $room['rate']?> / NIGHT</span>
                        <div class="service-star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h2 class="room-details_title"><?php echo $room['name']?></h3>
                    <p><?php echo $room['description']?></p>
                </div>
	
	
	</div>
	
	</div>
	
	
	
	</div>
	
	
	
       
    </div>
	

	
	<div class=" Gallery-in-se" data-bg-src="<?php echo base_url()?>assets/img/red-bg.jpg">

  <div class="container">
  

  
  <div class="row">


  <!-- Tab STart -->

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab" aria-controls="home" aria-selected="true">Gallery</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab" aria-controls="features" aria-selected="false">Features</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="book-tab" data-bs-toggle="tab" data-bs-target="#book" type="button" role="tab" aria-controls="book" aria-selected="false">Book</button>
  </li>
</ul>

<!--
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">B</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">C</div>
</div>
-->

  <!-- Tab End -->

  <div class="container">
	
<div class="row tab-content">

    <!-- Gallery Start -->

    <div id="gallery"  class="col-lg-12 tab-pane show active fade">

    <div class="">
    <div class="row  gal-row grid-container gutter-30 has-init-isotope" >
        <?php foreach($moreimages as $more){?>
                <div class="col-lg-4 col-md-4 col-sm-6 rounded img-hover-wrap" >
                <div class="img-hover-card" > <a href="<?php echo base_url()?>uploads/Rooms/<?php echo $more->more_image?>" class="popup-image" ><img src="<?php echo base_url()?>uploads/Rooms/<?php echo $more->more_image?>" alt=""></a>
                    <div class="img-hover-detail">
                    
                    </div>
                </div>
                </div>
        <?php } ?>
                
            </div>
        </div>
    </div>

    <!-- Gallery End -->


    <!-- Features Start -->
    <div id="features" class="tab-pane fade col-md-12 col-lg-12">
                                
                    <div class="room-details">
                                    
                                    <div class="service-box-wrapper">
                                <?php  foreach($fac as $facl) {	?>
                                        
                                        <div class="service-box style5">
                                            <div class="service-box_icon">
                                                <img src="<?php echo base_url();?>uploads/Rooms/<?php echo $facl->Facimage;?>" alt="">
                                            </div>
                            
                                            <div class="service-box_content">
                                                <h3 class="service-box_title"><?php echo $facl->Factitle;?></h3>
                                            </div>
                                        </div>
                                        
                                <?php } ?>
                                        
                                    </div>
                                    
                                    <?php echo $room['facilities']?>
                                
                                </div>
                            </div>

            <!-- Features End -->



            <!-- Book Start -->


            <div id="book" class="tab-pane fade col-md-12 col-lg-12">


            <div class="form-room">
	
	<div class="container">
	
	 <div class="row justify-content-center">

            <div class="col-xxl-6 col-lg-6">
                <div class="sidebar">
                    <div class="widget style2">
                        <div class="widget-content">
                            <h3 class="widget-title text-center">Book Your Room</h3>
                        </div>
                        <?php echo form_open(base_url().'check',array('method'=>"GET","class" => "contact-form style5"))?>
                            <div class="row">
                                <input type="hidden" name="room_selected" value="<?= $room['roomid']; ?>">

                                <?php /*
                                <div class="form-group col-12">
                                    <i class="fal fa-user"></i>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Your Full Name" required>
                                </div>

                                <div class="form-group col-12">
                                    <i class="fal fa-envelope"></i>
                                    <input type="email" class="form-control" name="email" 
                                        placeholder="Your email" required>
                                </div>

                                <div class="form-group col-12">
                                    <i class="fa-regular fa-phone"></i>
                                    <input type="tel" class="form-control" name="number"
                                        placeholder="Phone Number" required>
                                </div>
                                */ ?>

                                <div class="form-group col-md-6">
                                <select name="adults" class="form-dropdown nice-select" required>  
                                    <option value="" disabled selected hidden>No. Adults</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    </select>
                                </div>
								<div class="form-group col-md-6">
                                    <select name="children" class="form-dropdown nice-select" required>  
                                        <option value="" disabled selected hidden>No. Childrens</option>
                                          <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
								
                                <div class="form-group col-md-6">
                                    <div class="booking-check">
                                        <input type="text" id="datepicker"  class="date-pick form-control" name="checkindate"  placeholder="Check in" required>
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="booking-check">
                                         <input type="text" class="date-pick form-control" id="datepicker1" name="checkoutdate"  placeholder="Check Out" required>
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
								<div class="form-group col-md-12">
                                    <select name="rooms_count" class="form-dropdown nice-select" required>  
                                        <option value="" disabled selected hidden>Select rooms</option>
                                          <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                    </select>
                                </div>
                                
                               
                                <div class="form-btn col-12 text-center">
                                    <input type="submit" class="as-btn shadow-none" name="submit" value="Check" style="z-index:0">
                                </div>
                            </div>
                           
                        </form>
                    </div>
                </div>
              
            </div>
        </div>
	
	</div>
	
	
	</div>




            </div>



            <!-- Book End -->






</div>  
  </div>
</div>
	


</section>







        <?php $this->load->view("footer")?>
        
        
        
        
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

        