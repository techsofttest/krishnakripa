<!doctype html>
<html class="no-js" lang="zxx">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php echo $seo_data['m_title']?></title>
<meta name="author" content="">
<meta name="description" content="<?php echo $seo_data['m_dis']?>">
<meta name="keywords" content="<?php echo $seo_data['m_key']?>">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" href="<?php echo base_url()?>assets/img/favicon.png">

<!--============================== 
	  Google Fonts
	============================== -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Playfair+Display:wght@400;500;600;700;800;900&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<!--==============================
	    All CSS File
	============================== -->
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
<!-- Fontawesome Icon -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/fontawesome.min.css">
<!-- Magnific Popup -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/magnific-popup.min.css">
<!-- Slick Slider -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/slick.min.css">
<!-- nice-select -->

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>

.swal2-popup.swal2-toast {

padding: 2em 1em 1em 1em !important;

height:100px !important;

}
.swal2-toast-shown .swal2-container {
 width:fit-content !important;
}

</style>

<body>

<!--==============================
    Mobile Menu
  ============================== -->
<div class="as-menu-wrapper">
  <div class="as-menu-area text-center">
    <button class="as-menu-toggle"><i class="fal fa-times"></i></button>
    <div class="mobile-logo"> <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/img/logo.png" alt="" height="79px"></a> </div>
    <div class="as-mobile-menu">
      <ul>
        <li > <a href="<?php echo base_url()?>">Home</a> </li>
                 <li > <a href="<?php echo base_url()?>about">About us</a>
                </li>
                <li class="menu-item-has-children"> <a href="<?php echo base_url()?>hotels">Hotels</a>
                  <ul class="sub-menu">
                    <li><a href="<?php echo base_url()?>krishnakripa-residency">Krishnakripa Residency</a></li>
                    <li><a href="<?php echo base_url()?>krishnakripa-executive-stay">Krishnakripa Executive Stay</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo base_url()?>restaurent">Restaurant</a> </li>
               
                <li><a href="#">Nearby Attractions</a> </li>
                <li><a href="#">Contact Us</a> </li>
      </ul>
    </div>
  </div>
</div>
<!--==============================
    Header
============================== --> 
<!--============================== 
	Header Area
==============================-->
<header class="as-header header-layout2 header-absolute">
  <div class="header-top">
    <div class="container  text-lg-start text-center">
      <div class="menu-top">
        <div class="row justify-content-center justify-content-lg-between align-items-center">
          <div class="col-auto d-none d-xl-block">
            <div class="header-links">
              <ul>
                <li><i class="fat fa-phone"></i><a href="tel:+91 8086100803">+91 8086100803</a></li>
				<li><i class="fat fa-phone"></i><a href="tel:+91 8086100806">+91 8086100806</a></li>
               
                <li><i class="fat fa-envelope"></i><a href="mailto:krishnakriparesidency@gmail.com">krishnakriparesidency@gmail.com</a></li>
              </ul>
            </div>
          </div>
          <div class="col-auto d-none d-xl-block">
            <div class="headersocial-right">
              <div class="as-social "> <a href="https://www.facebook.com/krishnakriparesidency" target="_blank"><i class="fab fa-facebook-f"></i></a> <a href="#" target="_blank"><i class="fab fa-twitter"></i></a> <a href="https://www.instagram.com/krishnakriparesidency?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><i class="fab fa-instagram"></i></a> <a href="https://www.youtube.com/watch?v=wkKhQ1veMw4" target="_blank"><i class="fab fa-youtube"></i></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-memuss">
  <div class="sticky-wrapper">
   <div class="container ">
    <div class="menu-area">
     
        <div class="row justify-content-between justify-content-lg-between align-items-center">
          <div class="col-auto">
            <div class="header-logo style1"> <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/img/logo.png" alt=""></a> </div>
          </div>
          <div class="col-auto">
            <nav class="main-menu d-none d-lg-block">
              <ul>
                <li > <a href="<?php echo base_url()?>">Home</a> </li>
                 <li > <a href="<?php echo base_url()?>about">About us</a>
                </li>
                <li class="menu-item-has-children"> <a href="<?php echo base_url()?>hotels">Hotels</a>
                  <ul class="sub-menu">
                  <li><a href="<?php echo base_url()?>krishnakripa-residency">Krishnakripa Residency</a></li>
                    <li><a href="<?php echo base_url()?>krishnakripa-executive-stay">Krishnakripa Executive Stay</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo base_url()?>restaurant">Restaurant</a> </li>
               
                <li><a href="<?php echo base_url()?>attractions">Nearby Attractions</a> </li>
                <li><a href="<?php echo base_url()?>contact">Contact Us</a> </li>
              
              </ul>
            </nav>
            <button type="button" class="as-menu-toggle d-inline-block d-lg-none"><i
                                  class="far fa-bars"></i></button>
          </div>
          <div class="col-auto">
            <div class="header-button style2"> <a href="<?php echo base_url()?>book-online" class="as-btn style4 shadow-none">Book online </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</header>
