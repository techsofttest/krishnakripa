<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->

  <style>
  .link-toggle-container{
    background: #000000;
    padding: 5px 9px;
    margin: 5px 10px;
    border-radius: 10px;
    text-align: center;
    color: white;
  }

  .skin-green .sidebar a.link-toggle-btn{
  
    color:white !important;
    padding: 5px;
    border-radius: 10px;
    font-size: 15px;
    display: inline-block;
    width: 50%;
  }

  .skin-green .sidebar a.link-toggle-btn:hover{



  }

  .skin-green .sidebar a.link-toggle-btn.active {
      background: #ffffff !important;
      color: black !important;
  }
  </style>
  
  <ul class="sidebar-menu">

  <?php
  $website="";
  $booking="";
  if(empty($this->session->userdata('manage')))
  {
  $booking="active";
  }
  else
  {
  $website="active";
  }

  ?>



    <div class="link-toggle-container">


        <a href="<?= base_url() ?>admin/Home/ToggleMenu/Website" class="link-toggle-btn <?= $website ?>">Website</a>

        <a href="<?= base_url() ?>admin/Home/ToggleMenu/Booking" class="link-toggle-btn <?= $booking; ?>">Booking</a>


    </div>



    <li class="treeview <?php if($this->uri->segment(2)=="home" || $this->uri->segment(2)=="")  :echo 'active'; endif; ?>"> 
    
      <a href="<?= base_url() ?>admin/home"> <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span> </a>
   
    </li>   


    <?php if($this->session->userdata('manage')=="bookings" || empty($this->session->userdata('manage')))

    {

    ?>

    <li class="treeview <?php if($this->uri->segment(2)=="Bookings")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i> <span>Bookings</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if($this->uri->segment(3)=="Add"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Bookings/Add"> <i class="fa fa-plus-square"></i><span>New Booking</span></a> </li>
         
      <li class="<?php if( ($this->uri->segment(2)=="Bookings" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditBooking"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Bookings"> <i class="fa fa-plus-square"></i><span>All Bookings</span></a> </li>   
          
      </ul>
      </li>




      <li class="treeview <?php if($this->uri->segment(2)=="Payments")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-money" aria-hidden="true"></i> <span>Payments</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if($this->uri->segment(3)=="Paid"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Payments/Paid"> <i class="fa fa-plus-square"></i><span>View All</span></a> </li>

      </ul>

      </li>




      <li class="treeview <?php if($this->uri->segment(2)=="Reports")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-book" aria-hidden="true"></i> <span>Reports</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if($this->uri->segment(3)=="View"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Reports/View"> <i class="fa fa-plus-square"></i><span>View Reports</span></a> </li>

      </ul>

      </li>




      <li class="treeview <?php if($this->uri->segment(2)=="Customers")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-user" aria-hidden="true"></i> <span>Customers</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if( ($this->uri->segment(2)=="Customers" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditBooking"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Customers"> <i class="fa fa-plus-square"></i><span>View Customers</span></a> </li>   
          
      </ul>
      </li>





    <?php
    } else {
    ?>
  
  
    <li class="treeview <?php if($this->uri->segment(2)=="Banners" )  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-image" aria-hidden="true"></i> <span>Home Banner</span> </a>
      <ul class="treeview-menu">
      
      
       <li class="<?php if(($this->uri->segment(2)=="Banners") || ($this->uri->segment(3)=="EditBanner") ) :echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Banners"> <i class="fa fa-plus-square"></i><span>Manage Home Banners</span></a> </li>
      
          </ul>
          </li>

                 
	   <!-- <li class="treeview <?php if($this->uri->segment(2)=="InnerBanner")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-image" aria-hidden="true"></i> <span>Inner Page Banners</span> </a>-->
    <!--  <ul class="treeview-menu">-->
    <!--   <li class="<?php if(($this->uri->segment(3)=="InnerBanner") || ($this->uri->segment(3)=="InnerBanner")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/InnerBanner"> <i class="fa fa-plus-square"></i> <span>Edit/View Inner Page Banners</span></a> </li>-->
    <!--  </ul>-->
    <!--</li>-->
    
      <li class="treeview <?php if( $this->uri->segment(2)=="CMS" ||$this->uri->segment(2)=="Partners" || $this->uri->segment(2)=="CMS" || ($this->uri->segment(2)=="CMS") && ($this->uri->segment(4)=="5") || ($this->uri->segment(2)=="CMS") && ($this->uri->segment(4)=="6") )  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-file-code-o" aria-hidden="true"></i> <span>Home Page Contents</span> </a>

      <ul class="treeview-menu">    

      <li class="<?php if(($this->uri->segment(2)=="CMS") && ($this->uri->segment(4)=="1") ) :echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/CMS/EditCMS/1"> <i class="fa fa-plus-square"></i><span>
About Us</span></a> </li>   

<li class="<?php if(($this->uri->segment(4)=="8") && ($this->uri->segment(4)=="") ) :echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/CMS/Top"> <i class="fa fa-plus-square"></i><span>

Features</span></a> </li> 
<li class="<?php if(($this->uri->segment(4)=="8") && ($this->uri->segment(4)=="") ) :echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/CMS/Why"> <i class="fa fa-plus-square"></i><span>

Other Contents</span></a> </li> 
</ul>
</li>   

      <li class="treeview <?php if($this->uri->segment(2)=="Categories")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i> <span>Room Types</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if($this->uri->segment(3)=="AddCategory"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Categories/AddCategory"> <i class="fa fa-plus-square"></i><span>Add Room Type</span></a> </li>
         
        <li class="<?php if( ($this->uri->segment(2)=="Categories" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditCategory"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Categories"> <i class="fa fa-plus-square"></i><span>View/Edit Room Type</span></a> </li>
          
      </ul>
      </li>   
           

      <li class="treeview <?php if($this->uri->segment(2)=="Rooms" || $this->uri->segment(2)=="Available_dates")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i> <span>Residency</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if($this->uri->segment(3)=="AddRooms"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Rooms/AddRooms"> <i class="fa fa-plus-square"></i><span>Add Room</span></a> </li>
         
        <li class="<?php if( ($this->uri->segment(2)=="Rooms" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditRoom"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Rooms"> <i class="fa fa-plus-square"></i><span>View/Edit Rooms</span></a> </li>
        
        <?php /*
        <li class="<?php if(($this->uri->segment(2)=="Available_dates" && $this->uri->segment(3)=="")):echo 'active'; endif; ?>"><a href="<?php echo base_url();?>admin/Available_dates"><i class="fa fa-calendar" aria-hidden="true"></i><span> Available Dates</span>
              </a>
        </li>   
        */ ?>  
          
      </ul>
      </li>

      <li class="treeview <?php if($this->uri->segment(2)=="Stay" || $this->uri->segment(2)=="Available_stay_dates")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i> <span>Executive Stay</span> </a>
      
      <ul class="treeview-menu">
         
      <li class="<?php if($this->uri->segment(3)=="AddStay"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Stay/AddRooms"> <i class="fa fa-plus-square"></i><span>Add Room</span></a> </li>
         
        <li class="<?php if( ($this->uri->segment(2)=="Stay" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditStay"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Stay"> <i class="fa fa-plus-square"></i><span>View/Edit Rooms</span></a> </li>
        
        <?php /*
        <li class="<?php if(($this->uri->segment(2)=="Available_stay_dates" && $this->uri->segment(3)=="")):echo 'active'; endif; ?>"><a href="<?php echo base_url();?>admin/Available_stay_dates"><i class="fa fa-calendar" aria-hidden="true"></i><span> Available Dates</span>
              </a>
        </li>     
        */ ?>
          
      </ul>
      </li>
      

      <li class="treeview <?php if($this->uri->segment(2)=="Restaurent")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i> <span>Restaurent Image</span> </a>
      <ul class="treeview-menu">
         
         <li class="<?php if($this->uri->segment(3)=="AddRestaurent"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Restaurent/AddRestaurent"> <i class="fa fa-plus-square"></i><span>Add Restaurent Image</span></a> </li>        
         
          <li class="<?php if( ($this->uri->segment(2)=="Restaurent" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditRestaurent"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Restaurent"> <i class="fa fa-plus-square"></i><span>View/Edit Restaurent Image</span></a> </li>          
      </ul>
    </li>
     
     <li class="treeview <?php if($this->uri->segment(2)=="Attractions")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-bookmark" aria-hidden="true"></i> <span>Attractions</span> </a>
      <ul class="treeview-menu">
      
       <li class="<?php if(($this->uri->segment(3)=="AddAttractions")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Attractions/AddAttractions"> <i class="fa fa-plus-square"></i> <span>Add Attractions</span></a> 					       </li>
      
        <li class="<?php if(($this->uri->segment(3)=="") || ($this->uri->segment(3)=="EditAttractions")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Attractions"> <i class="fa fa-plus-square"></i> <span>View/Edit Attractions</span></a>        </li>
        
      </ul>
    </li>  



    <li class="treeview <?php if($this->uri->segment(2)=="Gallery")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i> <span>Gallery</span> </a>
      <ul class="treeview-menu">
         
         <li class="<?php if($this->uri->segment(3)=="AddGallery"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Gallery/AddGallery"> <i class="fa fa-plus-square"></i><span>Add Image</span></a> </li>        
         
          <li class="<?php if( ($this->uri->segment(2)=="Gallery" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditGallery"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Gallery"> <i class="fa fa-plus-square"></i><span>View/Edit Images</span></a> </li>


          <li class="<?php if($this->uri->segment(3)=="AddYutube"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Gallery/AddYutube"> <i class="fa fa-plus-square"></i><span>Add Yutube Url</span></a> </li>         
         
         <li class="<?php if( ($this->uri->segment(2)=="Gallery" && $this->uri->segment(3)=="") || $this->uri->segment(3)=="EditGallery"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Gallery/Yutube"> <i class="fa fa-plus-square"></i><span>View/Edit Yutube Url</span></a> </li>
          
      </ul>
    </li>


      
          
    
    <li class="treeview <?php if($this->uri->segment(2)=="Contact")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-phone" aria-hidden="true"></i> <span>Contact Info</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if(($this->uri->segment(3)=="Contact") || ($this->uri->segment(3)=="EditContact")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Contact"> <i class="fa fa-plus-square"></i> <span>Edit/View Contact</span></a> </li>
      </ul>
    </li>
    
    
   
   
    
    <li class="treeview <?php if($this->uri->segment(2)=="Seo")  :echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-file-text" aria-hidden="true"></i> <span>Seo Page</span> </a>
      <ul class="treeview-menu">
        <li class="<?php if(($this->uri->segment(3)=="EditSeo") || ($this->uri->segment(3)=="")):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/Seo"> <i class="fa fa-plus-square"></i> <span>View Seo Page</span></a> </li>
      </ul>
    </li>

    <?php
    }
    ?>
    
    
    <li class="treeview <?php if($this->uri->segment(2)=="change_password" ):echo 'active'; endif; ?>"> <a href="#"> <i class="fa fa-cog"></i> <span>Settings</span> </a>
      <ul class="treeview-menu">
          
        <li class="<?php if($this->uri->segment(2)=="change_password"):echo 'active'; endif; ?>" > <a href="<?php echo base_url();?>admin/change_password"> <i class="fa fa-lock"></i> <span>Change Password</span></a> </li>
        
        <li> <a href="<?php echo base_url();?>admin/login/logout"> <i class="fa fa-sign-out"></i> <span>Logout</span></a> </li>
      </ul>
    </li>
  </ul>
</section>
<!-- /.sidebar -->