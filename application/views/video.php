<?php $this->load->view("header");?>

<div class="breadcumb-wrapper " data-bg-src="<?php echo base_url()?>assets/img/attraction-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Videos
</h1>
           
        </div>
    </div>
</div>

<div class="Attractions-inner-sec">
<div class="container">
  <div class="row">
  <?php foreach($video as $vid){?>
 <div class="col-lg-4 col-md-6">
<?php preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $vid->title, $matches);?>
 <iframe width="420" height="345" src="https://www.youtube.com/embed/<?php echo $matches[1]?>"></iframe>
 </div>
 <?php } ?>
			
  
  </div>
    </div>

</div>

        <?php $this->load->view("footer");?>