
<?php $this->load->view("header")?>




<style>
    
    
    





.wrapper {
  max-width: 680px;
  margin: 60px auto;
  padding: 0 20px;
}

.youtube {
  background-color: #000;
  margin-bottom: 30px;
  position: relative;
  padding-top: 56.25%;
  overflow: hidden;
  cursor: pointer;
}
.youtube img {
  width: 100%;
  top: -16.82%;
  left: 0;
  opacity: 0.7;
}
.youtube .play-button {
  width: 90px;
  height: 60px;
  background-color: #333;
  box-shadow: 0 0 30px rgba( 0,0,0,0.6 );
  z-index: 1;
  opacity: 0.8;
  border-radius: 6px;
}
.youtube .play-button:before {
  content: "";
  border-style: solid;
  border-width: 15px 0 15px 26.0px;
  border-color: transparent transparent transparent #fff;
}
.youtube img,
.youtube .play-button {
  cursor: pointer;
}
.youtube img,
.youtube iframe,
.youtube .play-button,
.youtube .play-button:before {
  position: absolute;
}
.youtube .play-button,
.youtube .play-button:before {
  top: 50%;
  left: 50%;
  transform: translate3d( -50%, -50%, 0 );
}
.youtube iframe {
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
}

    
    
</style>




<link rel="stylesheet" href="/resources/demos/style.css">
 <?php
	function getYoutubeEmbedUrl($url){
     $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
     $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id ;
}
	?>
 <style>

.hero-slider-2 {
  display: block;
  height:650px;
}
 
.hero-slider-2.slide-hero-wrap:not(:first-child) {
    display: none !important;
}
 
.hero-slider-2 img {
    width: 100% !important;
}


@media(min-width:992px)
{
  .bann-img
  {
    height:90vh;
  }
}


@media(max-width:525px)
{
  .bann-img
  {
    min-height:155px;
  }

}

</style>
 
<div class="as-hero-wrapper hero-1" id="hero">
  <div class="hero-slider-2 as-carousel" data-autoplay="true" data-fade="true" data-slide-show="1" data-md-slide-show="1"
        data-arrows="true" data-xl-arrows="true" data-ml-arrows="true" data-lg-arrows="true">
        
        <?php 
        $first=true;
        foreach($banner_data as $ban){
        
        ?>
     <div class="slide-hero-wrap">
    <div class="as-hero-slide"> 
    
   
    <img src="<?php echo base_url();?>uploads/Banners/<?php echo $ban->ban_image?>" alt="" class="bann-img" >
    
    
      <div class="Banner-slide" >
        <div class="container">
		<div class="row justify-content-center">
          <div class="col-lg-8 ">
            <div class="hero-style1"> 
              <h1 class="hero-title" data-ani="slideindown" data-ani-delay="0.0s"><?php echo $ban->ban_main_heading?></h1>
              <p class="hero-subtext" data-ani="slideindown" data-ani-delay="0.1s"><?php echo $ban->ban_sub_heading?></p>
            </div>
          </div>
        </div>
		</div>
      </div>
    </div>
      </div>
      
    <?php } ?>
  
  
    </div>
  </div>
</div>
<?php $this->load->view("booking_sec")?>
<!--==============================
About Area  
==============================-->
<div class="about-section-two" id="about-sec" data-bg-src="assets/img/pattern-china-fade.png">
  <div class="container">
  
  <div class="about-title-area">
<div class="title-area text-center mb-20">
<span class="sub-title">About</span>

<h2 class="sec-title"><?php echo $about['pageName']?></h2>
<p><?php $str = trim(html_entity_decode(strip_tags($about['pageDescription']))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >60) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 60))."\n".".....";} ?></p></div>
<div class="Abb-btn"><a href="<?php echo base_url()?>about" class="as-btn shadow-none">More About Us </a> <a href="tel:+91 8086100803" class="as-btn mstyle1 shadow-none">Make A Call</a> </div>

</div>


<div class="row align-items-center">
<div class="col-lg-6 col-md-6">
<div class="Abuu-img">
<img class="lazy" data-original="<?php echo base_url()?>uploads/<?php echo $about['image']?>" alt="" height="417px;">

</div>

</div>

<div class="col-lg-6 col-md-6">
<div class="row">
<?php $n=0;foreach($feat as $fet){
  $n++;?>
<div class="col-md-6 col-lg-6 ">
        <div class="sservice-box wow fadeInUp">
          <div class="sservice-box_icon">
            <div class="global-icon"><img class="lazy" data-original="assets/img/s<?php echo $n?>.png" alt="Icon" width="64px" height="64px"></div>
          </div>
          <h3 class="box-title"><a href="#"><?php echo $fet->pageName?></a></h3>
          <p class="sservice-box_text"><?php echo $fet->pageDescription?></p>
        </div>
      </div>
<?php } ?>
     
  </div>
</div>



</div>
  
  
  
  </div>
</div>




<section class="service-sec8" >
<div class="bgserbg-image" style="background-image: url(<?php echo base_url()?>uploads/<?php echo $res['image']?>)"></div>
  <div class="container">
   
	<div class="row justify-content-end">
	<div class="col-lg-7">
	<div class="hotel-textsec">
	<div class="title-area  mb-10">
<span class="sub-title">Hotels</span>

<h2 class="sec-title"><?php echo $res['pageName']?></h2>
</div>


<p><?php $str = trim(html_entity_decode(strip_tags($res['pageDescription']))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >60) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 60))."\n".".....";} ?></p>

 <div class=""><a href="<?php echo base_url()?>krishnakripa-residency" class="as-btn  mt-0">View Rooms<i class="far fa-arrow-right"></i></a></div>

	</div>
	
	
	
	
	</div>
	
	</div>
	
   
	
	

  </div>
</section>


<div class="Room-f-sec">

<div class="container">

<div class="row as-carousel" data-autoplay="true" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2"
            data-sm-slide-show="1" data-xs-slide-show="1" data-arrows="true" data-focuson-select="false">
         
            <?php foreach($res_data as $resd){?>

            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="service-card mb-24">
                    <div class="service-card_img">
                        <img class="lazy" data-original="<?php echo base_url()?>uploads/Rooms/<?php echo $resd->image?>" alt="Service">
                    </div>
                    <div class="service-card_title has-bg">
                        <div class="service-price">
                            <span class="service-card_subtitle">RS <?php echo $resd->rate?> / NIGHT</span>
                            <div class="service-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h3 class="service-card_title"><a href="<?php echo base_url()?>rooms/<?php echo $resd->room_slug_name?>"><?php echo $resd->name?></a></h3>
                    </div>
                    <div class="service-card_content">
                        <div class="service-price">
                            <span class="service-card_subtitle">RS <?php echo $resd->rate?> / NIGHT</span>
                            <div class="service-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h3 class="service-card_title"><a href="<?php echo base_url()?>rooms/<?php echo $resd->room_slug_name?>"><?php echo $resd->name?></a></h3>
                         <p><?php $str = trim(html_entity_decode(strip_tags('$resd->description'))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >30) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 30))."\n".".....";} ?></p>
                        <div class="service-card-btn">
                             <a href="<?php echo base_url()?>rooms/<?php echo $resd->room_slug_name?>" class="as-btn style3 shadow-none">Book now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
          
        </div>


</div>

</div>







<section class="service-sec9" >
<div class="rgserbg-image" style="background-image: url(<?php echo base_url()?>uploads/<?php echo $exe['image']?>)"></div>
  <div class="container">
   
	<div class="row ">
	<div class="col-lg-7">
	<div class="rghotel-textsec">
	<div class="title-area  mb-10">
<span class="sub-title">Hotels</span>

<h2 class="sec-title"><?php echo $exe['pageName']?></h2>
</div>
<p><?php $str = trim(html_entity_decode(strip_tags($exe['pageDescription']))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >60) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 60))."\n".".....";} ?></p>
<div class=""><a href="<?php echo base_url()?>krishnakripa-executive-stay" class="as-btn  mt-0">View Rooms<i class="far fa-arrow-right"></i></a></div>
</div>
</div>	
</div>
	
   
	
	

  </div>
</section>


<div class="RgRoom-f-sec">

<div class="container">

<div class="row as-carousel" data-autoplay="true" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2"
            data-sm-slide-show="1" data-xs-slide-show="1" data-arrows="true" data-focuson-select="false">
            <?php foreach($exstay_data as $exst){?>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="service-card mb-24">
                    <div class="service-card_img">
                        <img class="lazy" data-original="<?php echo base_url()?>uploads/Rooms/<?php echo $exst->image?>" alt="Service">
                    </div>
                    <div class="service-card_title has-bg">
                        <div class="service-price">
                            <span class="service-card_subtitle">RS <?php echo $exst->rate?>/ NIGHT</span>
                            <div class="service-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h3 class="service-card_title"><a href="<?php echo base_url()?>rooms/<?php echo $exst->room_slug_name?>"><?php echo $exst->name?></a></h3>
                    </div>
                    <div class="service-card_content">
                        <div class="service-price">
                            <span class="service-card_subtitle">RS <?php echo $exst->rate?> / NIGHT</span>
                            <div class="service-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h3 class="service-card_title"><a href="<?php echo base_url()?>rooms/<?php echo $exst->room_slug_name?>"><?php echo $exst->name?></a></h3>
                        <p><?php $str = trim(html_entity_decode(strip_tags('$exst->description'))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >30) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 30))."\n".".....";} ?></p>
                        <div class="service-card-btn">
                              <a href="<?php echo base_url()?>rooms/<?php echo $exst->room_slug_name?>" class="as-btn style3 shadow-none">Book now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
      </div>
</div>


<div class="Gal-sec">

<div class="container"></div>


</div>


	<div class="Rest-sec">
	
	<div class="container">
	<div class="row align-items-center">
      <div class="col-lg-6 col-md-6 ">
        <div class="Abt-main-left">
          <div class="abt-image"> <img class="lazy" data-original="<?php echo base_url()?>uploads/<?php echo $rest['image']?>" alt="" height="425px"> </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <div class="About-d-right">
          <div class="title-area mb-10">
            <h2 class="sec-title text-white"><?php echo $rest['pageName']?>
</h2>
          </div>
          <p><?php $str = trim(html_entity_decode(strip_tags($rest['pageDescription']))," \t\n\r\0\x0B\xC2\xA0"); 
             if(strlen($str) >70) { 
                 echo implode(' ', array_slice(explode(' ', $str), 0, 70))."\n".".....";} ?></p>
        
          <div><a href="<?php echo base_url()?>thaza-restaurant" class="as-btn white-btn shadow-none">Read More</a></div>
        </div>
      </div>
    </div>
	
	
	</div>
	
	</div>
<div class="Feature-sec">

<div class="container">
<div class="title-area text-center"> <span class="sub-title">Key Facilities</span>
      <h2 class="sec-title ">Our Services</h2>
    </div>
    <div class="row whyrow justify-content-center">
	
	<div class="col-lg-3 col-md-4 col-sm-4 d-flex">
              <div class="whysec"> <a href="javascript:void();">
                <div class="whyicon"> <div class="whyicon-rotate"></div>
				<img data-original="assets/img/f1.png" class="lazy loading" height="50px" width="50px"> </div>
                <h3>Airport Pickup


</h3>
                </a> </div>
            </div>
			
			<div class="col-lg-3 col-md-4 col-sm-4 d-flex">
              <div class="whysec"> <a href="javascript:void();">
                <div class="whyicon"> <div class="whyicon-rotate"></div>
				<img data-original="assets/img/f2.png" class="lazy loading" height="50px" width="50px"> </div>
                <h3>Complimentary Wifi 


</h3>
                </a> </div>
            </div>
			<div class="col-lg-3 col-md-4 col-sm-4 d-flex">
              <div class="whysec"> <a href="javascript:void();">
                <div class="whyicon"> <div class="whyicon-rotate"></div>
				<img data-original="assets/img/f3.png" class=" lazy loading" height="50px" width="50px"> </div>
                <h3>Complimentary  Breakfast


</h3>
                </a> </div>
            </div>
			
			
			<div class="col-lg-3 col-md-4 col-sm-4 d-flex">
              <div class="whysec"> <a href="javascript:void();">
                <div class="whyicon"> <div class="whyicon-rotate"></div>
				<img data-original="assets/img/f6.png" class="lazy loading" height="50px" width="50px"> </div>
                <h3>Barbeque Grill 


</h3>
                </a> </div>
            </div>
			

 

			 <div class="col-lg-3 col-md-4 col-sm-4 d-flex">
              <div class="whysec"> <a href="javascript:void();">
                <div class="whyicon"> <div class="whyicon-rotate"></div>
				<img data-original="assets/img/f9.png" class="lazy loading" height="50px" width="50px"> </div>
                <h3>Yoga session


</h3>
                </a> </div>
            </div>
   



    
    </div>
	  </div>
    </div>
	
	




<section class="gallery-section-three  " id="gallery-sec">
  <div class="container">
    <div class="title-area mb-30 mt-n1"> <span class="sub-title">Image of hotel</span>
      <h2 class="sec-title"> Our Gallery</h2>
    </div>
	
	
	
	<div class="row"> 
  
   <?php foreach($gal1 as $gl1){?>
		   <div class="col-md-4 col-lg-4 ">
       <div class="kggallery-card kggallery-card">
          <div class="kggallery-img"><img class="lazy" data-original="<?php echo base_url(); ?>uploads/Gallery/<?php echo $gl1->gallery_img;?>" ></div>
          <div class="kggallery-content"><a href="<?php echo base_url(); ?>uploads/Gallery/<?php echo $gl1->gallery_img;?>" class="icon-btn popup-image"><i class="fa-solid fa-arrow-up-right"></i></a>
           
          </div>
        </div>        
		   </div>
       <?php } ?>

<div class="col-lg-8 col-md-8 ">
<div class="row">
         
          <div class="col-md-12 col-lg-12">
		  
		  <div class="row">
    
      <?php foreach($gal2 as $gl2){?>
		   <div class="col-md-4 col-lg-4 ">
       <div class="kggallery-card kggallery-card1">
          <div class="kggallery-img "><img class="lazy" data-original="<?php echo base_url(); ?>uploads/Gallery/<?php echo $gl2->gallery_img;?>" ></div>
          <div class="kggallery-content"><a href="<?php echo base_url(); ?>uploads/Gallery/<?php echo $gl2->gallery_img;?>" class="icon-btn popup-image"><i class="fa-solid fa-arrow-up-right"></i></a>
           
          </div>
        </div>        
		   </div>
       <?php } ?>
		  
		  </div>
		  

          </div>
     
          <?php foreach($gal3 as $gl3){?>
		   <div class="col-md-4 col-lg-6 ">
       <div class="kggallery-card kggallery-card1">
          <div class="kggallery-img "><img class="lazy" data-original="<?php echo base_url(); ?>uploads/Gallery/<?php echo $gl3->gallery_img;?>" ></div>
          <div class="kggallery-content"><a href="<?php echo base_url(); ?>uploads/Gallery/<?php echo $gl3->gallery_img;?>" class="icon-btn popup-image"><i class="fa-solid fa-arrow-up-right"></i></a>
           
          </div>
        </div>        
		   </div>
       <?php } ?>
        </div>

</div>

</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  </div>

</section>

<div class="Video-gallery-sec" data-bg-src="<?php echo base_url()?>assets/img/video-bg.jpg">

<div class="container">

<div class="row align-items-center justify-content-between">
      <div class="col-lg-7">
        <div class="title-area mb-0">
      <h2 class="sec-title text-white">Video Gallery</h2>
    </div>        
      </div>
      <div class="col-auto">
	  <div class=""><a href="<?php echo base_url()?>video" class="as-btn  shadow-none">View All <i class="far fa-arrow-right"></i></a></div>
	  
	  
	  </div>
    </div>

<div class="row justify-content-center">
<?php foreach($video as $vid ){ ?>
    <?php
	// $ytubeurl = getYoutubeEmbedUrl($vid->title);
	?>
    <div class="col-md-4">
       
        
    <!--
    <iframe width="100%" height="345" src="<?php echo $ytubeurl; ?>"></iframe>
    -->
    
    
    <div class="wrapper">
      <div class="youtube" data-embed="<?php echo $vid->title; ?>">
        <div class="play-button"></div>
      </div>
    </div>
    
    
        </div>
    <?php } ?>
 </div>

 </div>
</div>

</div>



<div class="Attraction-sec">

<div class="container">
<div class="title-area mb-30 text-center"> 
      <h2 class="sec-title"> Nearby Attractions
</h2>
    </div>
 <div class="row as-carousel" data-slide-show="4" data-lg-slide-show="3" data-md-slide-show="2"
            data-sm-slide-show="1" data-xs-slide-show="1" data-arrows="true" data-focuson-select="false">
            <?php foreach($attraction as $att){?>
      <div class="col-md-4 col-lg-3 col-sm-6 filter-item ">
	  <div class="m-gal-card">
        
		
        <div class="attraction-card">
          <div class="gallery-img"> <img class="lazy" data-original="<?php echo base_url();?>uploads/Attractions/<?php echo $att->att_image;?>" alt=""> <a href="<?php echo base_url();?>uploads/Attractions/<?php echo $att->att_image;?>" class="icon-btn popup-image"><i class="fa-regular fa-image"></i></a> </div>
        
        </div>
		<h3><a href="#"><?php echo $att->att_title;?></a></h3>
		
      </div>
      </div>
      <?php } ?>     
      
      
    </div>

</div>


</div>

     
        <?php $this->load->view("footer")?>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

$("img.lazy").lazyload();






( function() {

  var youtube = document.querySelectorAll( ".youtube" );
  
  for (var i = 0; i < youtube.length; i++) {
    
    var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/mqdefault.jpg";
    
    var image = new Image();
        image.src = source;
        image.addEventListener( "load", function() {
          youtube[ i ].appendChild( image );
        }( i ) );
    
        youtube[i].addEventListener( "click", function() {

          var iframe = document.createElement( "iframe" );

              iframe.setAttribute( "frameborder", "0" );
			  iframe.setAttribute( "allow", "autoplay" );
			  iframe.setAttribute( "loading", "lazy" );
              iframe.setAttribute( "allowfullscreen", "" );
              iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?autoplay=1&rel=0&showinfo=0" );

              this.innerHTML = "";
              this.appendChild( iframe );
        } );  
  };
  
} )();




</script>



