<?php $this->load->view("header")?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
.with-errors li{
  color:red;

}
.frame-head{
  font-size: 18px;
    font-weight: 400;
    text-align: center;
    padding: 5px;
    color: white;  
    margin-bottom: 4px;
    background-color: #3995c8;
}
</style>
   
<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/c-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Contact Us</h1>
           
        </div>
    </div>
</div>

<div class="contact-inner-sec">
<div class="container">
  <div class="title-area mb-25 text-center">
            <!--<h2 class="border-title h3">Contact Our Team</h2>-->
          </div>
<div class="row align-items-center">
<div class="col-lg-5 col-md-6 mb-30 mb-xl-0">
        <div class="me-xxl-5 ">
        
          <div class="contact-feature">
            <div class="contact-feature-icon"><i class="fas fa-location-dot"></i></div>
            <div class="media-body">
              <p class="contact-feature_label">Krishnakripa Residency</p>
              Building no: XV/421, XV/422<br>
Ambalamedu PO,
Kuzhikkadu-682 303
              <!--Building No. XV/421, XV/422, Ambalamugal P O, Kuzhikkadau - 682303, Kochi, Kerala-->
              <a href="tel:<?php echo $con_data['phone']?>" class="contact-feature_link"><span><?php echo $con_data['phone']?></span></a>
	  </div>
          </div>
		            <div class="contact-feature">
            <div class="contact-feature-icon"><i class="fas fa-location-dot"></i></div>
            <div class="media-body">
              <p class="contact-feature_label">Krishnakripa Executive stay</p>
              <span>Near HOC Main Gate, <br>Opp.BPCL Kochi Refinery, <br>Ambalamugal- 682 302</span>
              <a href="tel:<?php echo $con_data['phone2']?>" class="contact-feature_link"><span><?php echo $con_data['phone2']?></span></a>
		  </div>
          </div>
		    <div class="contact-feature">
            <div class="contact-feature-icon"><i class="fas fa-location-dot"></i></div>
            <div class="media-body">
              <p class="contact-feature_label">Thaza Restaurant</p>
              <span><?php echo $con_data['maddress']?></span>
              <a href="tel:+91 8086100806" class="contact-feature_link"><span><?php echo $con_data['phone3']?></span></a>
		  </div>
          </div>
		  <div class="contact-feature">
            <div class="contact-feature-icon"><i class="fal fa-envelope"></i></div>
            <div class="media-body">
              <p class="contact-feature_label">Email Address</p>
              <a href="mailto:<?php echo $con_data['email']?>" class="contact-feature_link"><span><?php echo $con_data['email']?></span></a> </div>
          </div>

        </div>
      </div>
	  
	  <div class="col-lg-7 col-md-6">

	  <?php echo form_open('',array('method'=>'POST','id'=>'contact-form','class'=>'contact-form style3'))?>
                   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <i class="fal fa-user"></i>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name"  required="required" data-error="Name is required.">
                <div class="help-block with-errors"></div>
                           
                        </div>
                        <div class="form-group col-md-6">
                            <i class="fal fa-envelope"></i>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your email"  required="required" data-error="Email is required.">
                <div class="help-block with-errors"></div>
                           
                        </div>
                        <div class="form-group col-md-6">
                            <i class="fa-regular fa-phone"></i>
                            <input type="number" class="form-control js-input-mobile"  maxlength="10" name="phone" id="number" placeholder="Phone Number"  required="required" data-error="Number is required.">
                <div class="help-block with-errors"></div>
                           
                        </div>
                       <div class="form-group col-md-6">
                            <i class="fa-thin fa-file"></i>
                            <input type="tel" class="form-control" name="subject" id="subject" placeholder="Subject" >
                            <span id="subject_error" class="text-danger"></span>                        </div>
                        <div class="form-group col-12">
                            <i class="fa-thin fa-pencil"></i>
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control style3" placeholder="Your Message" ></textarea>

                        </div>
                        <div class="contact-btn col-12 text-center">
                            <button class="as-btn shadow-none" type="submit">Send Message Now</button> 
                        </div>
                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                <?php echo form_close();?>
	  
	  </div>

</div>


</div>



<div class="container" style="margin-top:20px">
    
    <div class="row">
        <div class="col-lg-4">
             <p class="frame-head">Krishnakripa Residency</p>
             <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3929.5085240096396!2d76.3884189793457!3d9.974786000000009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1skrishnakripa%20residency%20kuzhikkadau-!5e0!3m2!1sen!2sin!4v1714018463947!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            
        </div>
         <div class="col-lg-4">
                     <p class="frame-head">Krishnakripa Executive stay</p>  
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.5576495198256!2d76.37845147503079!3d9.970712390133173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0875804f81c257%3A0xbff0abd260f9f28b!2sCapital%20O%20Krishnakripa%20Executive%20Stay!5e0!3m2!1sen!2sin!4v1707220889050!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            
        </div>
        
         <div class="col-lg-4">
              <p class="frame-head">Thaza Restaurant</p>
             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1964.537471319366!2d76.36463386522814!3d10.010668497025275!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0875db337d588f%3A0xf79e0784c8ce8e80!2sThaza%20Restaurant!5e0!3m2!1sen!2sin!4v1708065545597!5m2!1sen!2sin" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            
        </div>
    </div>

</div>


</div>

    
        <?php $this->load->view("footer")?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
        
    <script>
    $(function() {  
  $("#contact-form").validator();
  $("#contact-form").on("submit", function(e) {        
    
  });
});
    </script>