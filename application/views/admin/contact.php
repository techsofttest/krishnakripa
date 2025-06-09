<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<meta name="description" content="<?php echo $seo['m_dis']; ?>">

<meta name="keywords" content="<?php echo $seo['m_key']; ?>">

<title><?php if(!empty($seo['m_title'])) { echo $seo['m_title']; } else{ echo ""; } ?></title>



<!-- Stylesheets -->
<link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<!-- Responsive File -->
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png" type="image/x-icon">
<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.png" type="image/x-icon">
<!-- Responsive Settings -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>
<body>

  <!-- Main Header -->
  
  <?php $this->load->view('user/header'); ?>
  
  
  
  <section> <img src="<?php echo base_url();?>assets/images/detailbanner.jpg" width="100%"> </section>
  
  
  <section class="welcome-section pb-3" style="padding:40px 0px;">
    <div class="auto-container">
      <div class="title-box wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
        <h4>Contact Us</h4>
        <h2>Get In <strong>Touch</strong></h2>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="contact-info-box">
                <div class="icon"><i class="fa fa-map-marker-alt" aria-hidden="true"></i></div>
                <h3>Address</h3>
                <p><?php echo $contact_info['addressline_1']; ?></p>
                <p><?php echo $contact_info['addressline_2']; ?></p>
                <p><?php echo $contact_info['addressline_3']; ?></p>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
              <div class="contact-info-box">
                <div class="icon"><i class="fa fa-phone-alt" aria-hidden="true"></i></div>
                <h3>Phone</h3>
                <p>Mob: <a href="tel:<?php echo $contact_info['phone_1']; ?>"><?php echo $contact_info['phone_1']; ?></a></p>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
              <div class="contact-info-box">
                <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                <h3>Email</h3>
                <p><a href="mailto:<?php echo $contact_info['email_1']; ?>"><?php echo $contact_info['email_1']; ?></a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="contactform">
           
           
           
           
            <form method="post">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Full Name</label>
                    <input  name="name" type="text" id="name" placeholder="Full Name" class="form-control" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input  name="email" type="email" id="name" placeholder="Email Address" class="form-control" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Contact No</label>
                    <input  name="phone" type="text" id="name" placeholder="Phone" class="form-control" required>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="form-group">
                    <label>Subject</label>
                    <input  name="subject" type="text" id="name" placeholder="Subject" class="form-control" required>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" placeholder="Message... " class="form-control" required></textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <button type="submit" class="default-btn">SUBMIT</button>
                </div>
              </div>
            </form>
            
            
            
            
            
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125922.83285133747!2d76.27206532516199!3d9.501029730457157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0884f1aa296b61%3A0xb84764552c41f85a!2sAlappuzha%2C%20Kerala!5e0!3m2!1sen!2sin!4v1628656173212!5m2!1sen!2sin" width="100%" height="434" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </section>
  <!--Features Section-->
  <!--Testimonials Section-->
  <!-- Main Footer -->
  
  <?php $this->load->view('user/footer'); ?>
  
  
<!--End pagewrapper-->

<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>assets/js/owl.js"></script>
<script src="<?php echo base_url();?>assets/js/mixitup.js"></script>
<script src="<?php echo base_url();?>assets/js/appear.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.js"></script>
<script src="<?php echo base_url();?>assets/js/scrollbar.js"></script>
<script src="<?php echo base_url();?>assets/js/datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/validate.js"></script>
<script src="<?php echo base_url();?>assets/js/paroller.js"></script>
<script src="<?php echo base_url();?>assets/js/element-in-view.js"></script>
<script src="<?php echo base_url();?>assets/js/custom-script.js"></script>




<script>


<?php if($this->session->flashdata('success')) { ?>

$('#noti-modal-success').modal('show');

<?php } ?>


<?php if($this->session->flashdata('error')){ ?>

$('#noti-modal-error').modal('show');

<?php } ?>


</script>









<script>


const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

</script>
</body>
</html>
