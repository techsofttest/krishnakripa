<?php $this->load->view("header")?>

<div class="breadcumb-wrapper " data-bg-src="assets/img/hotel-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Hotels</h1>

        </div>
    </div>
</div>


<div class="Hotel-innerpsec">
<div class="container">
<div class="row">
  <div class="col-lg-12">
    <div class="mtmwork ">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 ">
          <div class="sett-img">
            <div class="shapescgc"> <img src="<?php echo base_url()?>uploads/<?php echo $res['image']?>" width="100%"> </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 right">
          <div class="mwork">
            <h4><?php echo $res['pageName']?>
</h4>
            <p><?php $str = trim(html_entity_decode(strip_tags($res['pageDescription']))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >70) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 70))."\n".".....";} ?></p>
          <div class="mt-10"><a href="<?php echo base_url()?>krishnakripa-residency" class="as-btn  mt-0">View Rooms <i class="far fa-arrow-right"></i></a></div>
		  </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="mtmwork">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 left">
          <div class="mwork">
            <h4><?php echo $exe['pageName']?>

</h4>
            <p><?php $str = trim(html_entity_decode(strip_tags($exe['pageDescription']))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >70) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 70))."\n".".....";} ?></p>
        <div class="mt-10"><a href="<?php echo base_url()?>krishnakripa-executive-stay" class="as-btn  mt-0">View Rooms <i class="far fa-arrow-right"></i></a></div>
		</div>
        </div>
        <div class="col-lg-6 col-md-12 ">
          <div class="sett-img">
            <div class="shapescgc"> <img src="<?php echo base_url()?>uploads/<?php echo $exe['image']?>" width="100%"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
  
  
  
  
  
</div>


</div>

</div>


        <?php $this->load->view("footer")?>