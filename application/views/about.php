<?php $this->load->view("header")?>

<div class="breadcumb-wrapper " data-bg-src="assets/img/about-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">About Us</h1>

        </div>
    </div>
</div>

<div class="About-Desidency">
<div class="container">
    <div class="row align-items-center">
	      <div class="col-lg-6">
        <div class="img-box2">
          <div class="img2"> <img class="image_1" src="<?php echo base_url()?>uploads/<?php echo $about['image']?>" alt=""> </div>
         
          <div class="img4"> <img src="<?php echo base_url()?>assets/img/about3-1.jpg" alt=""> </div>
        </div>
      </div>
      <div class="col-lg-6">
	  
	  <div class="Bt-right">
        <div class="title-area mt-n1 mb-25 mr-50"> <span class="sub-title">About</span>
          <h2 class="sec-title"><?php echo $about['pageName']?></h2>
          <?php echo $about['pageDescription']?>
	   </div>
      
      </div>
      </div>
    </div>
  </div>
</div>




<div class="Ser-sec">
  <div class="container-fluid">
  
  <div class="row">
  
  <div class="col-lg-6 d-flex">
  <div class="Specialities-lists ">
  <div class="Abt-himg">
  <img src="<?php echo base_url()?>uploads/<?php echo $res['image']?>" alt="">
  </div>
  <div class="title-area mb-10">
      <h2 class="sec-title"><?php echo $res['pageName']?></h2>
    </div>
	
	<p><?php echo $res['pageDescription']?></p>
 
  </div>
  
  </div>
   <div class="col-lg-6 d-flex">
  <div class="Beniofits-lists ">
   <div class="Abt-himg">
  <img src="<?php echo base_url()?>uploads/<?php echo $exe['image']?>" alt="">
  </div>
  <div class="title-area mb-10">
      <h2 class="sec-title "><?php echo $exe['pageName']?></h2>
    </div>
 <p><?php echo $exe['pageDescription']?></p>
  </div>
  
  </div>
  
  </div>
  </div>
</div>

<div class="Mission-sec">
<div class="container">

<div class="row">

<div class="col-lg-12">
<div class="Dirework ">
      <div class="row align-items-center">
        <div class="col-lg-5 col-md-12 ">
		 <div class="dsett-img">
          <div class="dshapescgc"> <img src="<?php echo base_url()?>uploads/<?php echo $dir['image']?>" width="100%"> </div></div>
        </div>
        <div class="col-lg-7 col-md-12 right">
          <div class="dwork">
		  <div class="title-area mb-10">
      <h2 class="sec-title "><?php echo $dir['pageName']?> </h2>
    </div>
           <h4>
</h4>
 <p> <?php echo $dir['pageDescription']?></p>



       <!-- <a href="course-detail.html" class="as-btn style-new">Read More</a> -->
	   </div>
        </div>
      </div>
    </div>

</div>



</div>

</div>

<div class="container">
<div class="row">
<div class="col-lg-6 col-md-6 d-flex">

          <div class="cmwork">
           <h4><?php echo $vis['pageName']?></h4>
 <p> <?php echo $vis['pageDescription']?></p>



     
	  
    </div>

</div>

<div class="col-lg-6 col-md-6 d-flex">

          <div class="cmwork">
           <h4><?php echo $mis['pageName']?></h4>
<p><?php echo $mis['pageDescription']?></p>


      
	  
    </div>

</div>



</div>


</div>

</div>
      
  <?php $this->load->view("footer")?>
  <script>


var maxHeight = 0;

$(".Abt-himg img").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});

$(".Abt-himg img").height(maxHeight);


</script>