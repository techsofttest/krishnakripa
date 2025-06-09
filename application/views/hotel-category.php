<?php $this->load->view("header")?>

<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/hotel-category-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title"><?php echo $res['pageName']?></h1>

        </div>
    </div>
</div>


<div class="Hotel-catinnerpsec">
<div class="container">

<div class="hotel-title-area">




<p><?php echo $res['pageDescription']?></p>


</div>

</div>

</div>
<div class="Hotel-catinnerrooms">
<div class="container">

<div class="row">
  <?php $n=0;
  foreach($res_data as $rest){
  $n++;
  if($n%2==0){?>
<div class="col-lg-12">
<div class="Hotelwork ">
      <div class="row align-items-center">
        <div class="col-lg-5 col-md-12 ">
		 <div class="hsett-img">
          <div class="hshapescgc"><a href="<?php echo base_url()?>rooms/<?php echo $rest->room_slug_name?>"> <img src="<?php echo base_url()?>uploads/Rooms/<?php echo $rest->image?>" width="100%"></a> </div></div>
        </div>
        <div class="col-lg-7 col-md-12 right">
          <div class="hmwork">
           <h4><a href="<?php echo base_url()?>rooms/<?php echo $rest->room_slug_name?>"><?php echo $rest->name?></a></h4>
<h5>RS <?php echo $rest->rate?> / NIGHT</h5>
<div class="service-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
 <p> <?php echo $rest->description?></p>



       <a href="<?php echo base_url()?>rooms/<?php echo $rest->room_slug_name?>" class="as-btn style-new">Read More</a>
	   </div>
        </div>
      </div>
    </div>

</div>

<?php } else { ?>

<div class="col-lg-12">
<div class="Hotelwork">
      <div class="row align-items-center">
      
        <div class="col-lg-7 col-md-12 left">
          <div class="hmwork">
            <h4><a href="<?php echo base_url()?>rooms/<?php echo $rest->room_slug_name?>"><?php echo $rest->name?></a></h4>
<h5>RS <?php echo $rest->rate?> / NIGHT</h5>
<div class="service-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
<p><?php echo $rest->description?></p>


       <a href="<?php echo base_url()?>rooms/<?php echo $rest->room_slug_name?>" class="as-btn style-new">Read More</a>
	   </div>
        </div>
		  <div class="col-lg-5 col-md-12 ">
		   <div class="hsett-img">
          <div class="hshapescgc"><a href="<?php echo base_url()?>rooms/<?php echo $rest->room_slug_name?>"> <img src="<?php echo base_url()?>uploads/Rooms/<?php echo $rest->image?>" width="100%"></a> </div></div>
        </div>
      </div>
    </div>

</div>
</div>
<?php } }?>


</div>

</div>
      

        <?php $this->load->view("footer")?>