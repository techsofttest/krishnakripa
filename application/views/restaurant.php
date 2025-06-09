<?php $this->load->view("header")?>
<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/restaurant-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Restaurant</h1>

        </div>
    </div>
</div>
<div class="Rerst-maininnersec">
<div class="container">
<div class="Rest-shadow">
<div class="row align-items-center">
<div class="col-lg-6 col-md-6">
<div class="rest-innerimg">
<img src="<?php echo base_url()?>uploads/<?php echo $rest['image']?>" alt="">

</div>

</div>
<div class="col-lg-6 col-md-6">
<div class="rest-innerdesc">


          <div class="title-area mb-10">
            <h2 class="sec-title "><?php echo $rest['pageName']?>
</h2>
          </div>
          <p><?php echo $rest['pageDescription']?></p>
        
        
        </div>

</div>

</div>




</div>
</div>


</div>




<div class="Rerst-innersec" data-bg-src="assets/img/pattern-china-fade.png">

<div class="container">


 <div class="row  gal-row grid-container gutter-30 has-init-isotope" >


 <?php foreach($Rest_data as $rest){?>
            <div class="col-lg-4 col-md-4 col-sm-6 rounded img-hover-wrap" >
              <div class="img-hover-card" > <a href="<?php echo base_url()?>uploads/Restaurent/<?php echo $rest->res_img?>" class="popup-image" ><img src="<?php echo base_url()?>uploads/Restaurent/<?php echo $rest->res_img?>" alt=""></a>
                <div class="img-hover-detail">
                 
                </div>
              </div>
            </div>
    <?php } ?>
            
          </div>
    </div>
  </div>
       
        <?php $this->load->view("footer")?>

<!-- Main Js File --> 
<script src="<?php echo base_url()?>assets/js/main.js"></script> 
 <script src="<?php echo base_url()?>assets/js/functions.js"></script> 
<script src="<?php echo base_url()?>assets/js/plugins.min.js"></script>
