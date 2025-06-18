<!DOCTYPE html>
<html>
      <head>
      
      <?php $theme="#ffffff";
	  	$theme_secondary="#e23428";
            $theme_grey = "#757575";
	    ?>
      
	  <style>
	  
	  .skin-green .main-header .navbar {
   		 background-color: <?php echo $theme; ?> !important;
	   }
	  
	  .skin-green .main-header .logo {
         background-color: white !important;
	  }
	  
	  .skin-green .sidebar-menu>li:hover>a, .skin-green .sidebar-menu>li.active>a {
      
	  background: <?php echo $theme; ?> !important;
	  
	  }

        .skin-green .wrapper, .skin-green .main-sidebar, .skin-green .left-sid
         {
            background-color: <?= $theme; ?> !important;
         }

         .skin-green .sidebar a
         {
         color:<?= $theme_grey ?> !important;
         }

         .skin-green .main-header .navbar .sidebar-toggle
         {
         color:<?= $theme_grey ?> !important; 
         }

         .skin-green .main-header .navbar .nav>li>a
         {
            color: <?= $theme_grey ?> !important; 
         }

         .skin-green .sidebar a:hover {
         color:<?= $theme_secondary ?> !important;
         border-left: 5px solid <?= $theme_secondary ?> !important;
         font-weight: 700;
         }

         .skin-green .sidebar-menu>li:hover>a, .skin-green .sidebar-menu>li.active>a
         {
         color:<?= $theme_secondary ?> !important;
         border-left: 5px solid <?= $theme_secondary ?> !important; 
         font-weight: 700;
         }

         .skin-green .treeview-menu>li.active>a, .skin-green .treeview-menu>li>a:hover {
         color: #000000 !important;
         font-weight: 700;
         }

         .small-box .icon>a
         {
            color:black !important;
         }

         .small-box>.small-box-footer
         {
            color:white !important;
            background:black !important;
         }

         .sidebar-menu
         {
           /*margin-top: 35px !important;*/
         }


         .skin-green .sidebar-menu>li>.treeview-menu
         {
            background:none !important;
         }

         .small-box {
         background: #cce5fe;
         }

	  
         /*
	  .btn-primary {
    
	   background-color: <?php echo $theme; ?> !important;
   		
	   border-color: <?php echo $theme; ?> !important;
		 
	  }
         */
	  
	  div .bg-yellow {
 
   	 background-color: <?php echo $theme; ?> !important;
		}
	  
	  
	  
.ck-editor__editable_inline {
    min-height: 150px;
}
	.editimg img{
		max-height:250px;
		max-width:250px;
		}


      /* Action Buttons Start*/

      .action-button
      {
         padding: 5px;
         border-radius: 10px;
         font-size: 10px;
         margin: 10px 0px;
      }

      /* Action Buttons End */
	

</style>
      
      <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href=" <?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
      
      
      <meta charset="UTF-8">
      <title>
      <?php if(@$seo_title){echo $seo_title;} else{ echo "Dashboard -  Admin"; }?>
      </title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.4 -->
      <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

      <link href="<?php echo base_url();?>assets/admin/css/timepicker.css" rel="stylesheet" type="text/css" />

      <!-- Font Awesome Icons -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <!-- Ionicons -->
      <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
      <!-- jvectormap -->
      <link href="<?php echo base_url();?>assets/admin/js/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/js/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- Theme style -->
      <link href="<?php echo base_url();?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/css/styles1.css" rel="stylesheet" type="text/css" />
      <!-- AdminLTE Skins. Choose a skin from the css/skins	

      <link href="<?php echo base_url();?>assets/admin/js/alertify/alertify.core.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url();?>assets/admin/js/alertify/alertify.default.css" rel="stylesheet" type="text/css" />
       folder instead of downloading all of them to reduce the load. -->
      <?php /*?><link href="<?php echo base_url();?>assets/admin/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" /><?php */?>
      <link href="<?PHP echo base_url();?>assets/admin/js/fancybox/jquery.fancybox.css" rel="stylesheet">

      <link href="<?php echo base_url();?>assets/admin/css/validationEngine.css" rel="stylesheet" type="text/css" />

      <link href="<?php echo base_url();?>assets/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
      
      <link href="<?php echo base_url();?>assets/admin/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
      
      <link href="<?php echo base_url();?>assets/admin/css/_all-skins.min.css" rel="stylesheet" type="text/css" />
      
      <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet" type="text/css" />


      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      </head>
      <body class="skin-green sidebar-mini">
<div class="wrapper">
<header class="main-header"> 
        
        <!-- Logo --> 
        <a href="<?php echo base_url() ?>admin/Home" class="logo"> 
        
       <!-- <img src="<?php echo base_url();?>assets/admin/img/circlelogo.png" style="width:20%;" >-->
  <!-- mini logo for sidebar mini 50x50 pixels --> 
 
  <!-- logo for regular state and mobile devices --> 
  <span class="logo-lg" style="height:100%">
   
   <img src="<?php echo base_url();?>assets/admin/img/logo.png" style="width: 100%;height: 100%;object-fit: contain;">

   

</span>

 </a> 
        
    <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation"> 
    <!-- Sidebar toggle button--> 
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
    

    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">

      

      <ul class="nav navbar-nav">
        <li> <a href="<?php echo base_url();?>admin/login/logout" ><i class="fa fa-sign-out"></i>&nbsp; Sign Out</a> </li>
      </ul>


            </li>
            </ul>
          </div>
      </nav>
      </header>

     <script type="text/javascript">
	  var base_url  ="<?php echo base_url();?>";
	  </script>


<style>


</style>