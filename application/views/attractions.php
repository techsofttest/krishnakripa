<?php $this->load->view("header");?>

<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/attraction-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Nearby Attractions
</h1>
           
        </div>
    </div>
</div>

<div class="Attractions-inner-sec">
<div class="container">
  <div class="row">
  <?php foreach($attraction as $att){?>
  <div class="col-lg-4 col-md-4 col-sm-6 d-flex" >
                <div class="blog-card">
                    <div class="blog-img-wrapper">
                    <div class="blog-img">
                        <img src="<?php echo base_url()?>uploads/Attractions/<?php echo $att->att_image?>" alt="">
                    </div>
                    </div>
                    <div class="blog-box_content">
					<a href="<?php echo base_url()?>uploads/Attractions/<?php echo $att->att_image?>" class="icon-btn popup-image"><i class="fa-regular fa-image"></i></a>
                        <h3 class="blog-title box-title"> <a href="javascript:void();"><?php echo $att->att_title?></a></h3>
						<p><?php echo $att->att_desc?></p>
                        
                      
                    </div>
                </div> 
            </div>
<?php } ?>
			
  
  </div>
    </div>

</div>

        <?php $this->load->view("footer");?>