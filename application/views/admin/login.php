<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Krishnakripa Residency  | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url();?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/validationEngine.css" />
    <!-- iCheck -->
     
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
     <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    
	.btn-primary {
    background-color: #0079d1;
    border-color: #cde5f5;
	}
 
  .sweet-alert button {
    display: none !important;
  }
  .swal2-toast-shown .swal2-container {
    width: fit-content !important;
  }
  .swal2-popup.swal2-toast .swal2-title {
    font-size: 22px !important;
  }
 
    
	.btn-primary {
    background-color: #0079d1;
    border-color: #cde5f5;
	}
 
    </style>
    
    
  </head>
  <body class="login-page" style="background:#4b98d754;">

    <div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);">
      <!-- <img src="<?php echo base_url();?>assets/admin/img/logo.png" style="width:200px;height:100px;"> -->
       </a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
<div class="login-logo">
        <a href="javascript:void(0);">
         <img src="<?php echo base_url();?>assets/admin/img/logo.png" style="width:100%;">
      <!-- <img src="<?php echo base_url();?>assets/admin/img/logo.png" style="width:40%;"/>-->
       <!--ADMIN<br>
        <b>Shopping</b>--></a>
      </div>        <p class="login-box-msg">Sign in to start your session</p>
		<?php if($this->session->flashdata('success')) {?>
		<div class="callout callout-danger" id="error">
              <h4>Warning!</h4>
              <p> <?php echo $this->session->flashdata('success');?></p>
            </div>
		<?php } ?>
		<?php if($this->session->flashdata('password-success')) {?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						  <?php echo $this->session->flashdata('password-success');?>
					</div>
         <?php }?>
        <form action="<?php echo base_url();?>admin/login" method="post" name="admin_login" id="admin_login">
          <div class="form-group has-feedback">
            <input type="text" class="form-control validate[required]" name="admin_username" id="admin_username" placeholder="Username" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control validate[required]" placeholder="Password" name="password" id="password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <!-- /.col -->
            <div class="col-xs-12">
              <button style="width:80px;margin:0px auto;" type="submit" class="btn btn-primary btn-block btn-flat" >Sign In</button>
			 
            </div><!-- /.col -->
          </div>
        </form>
		
	<div style="text-align:center;margin-top:5px"><a href="<?php echo base_url();?>admin/Forgot_password">I forgot my password</a></div>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/admin/js/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/admin/js/iCheck/icheck.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/admin/js/jquery.validationEngine-en.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/jquery.validationEngine.js"></script>
		
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
	<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>assets/admin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
		
  <script type="text/javascript">
$(function(){
	$("#admin_login").validationEngine();
	$('#admin_login :input:enabled:visible:first').focus();
	setTimeout(function() {
         $('#error').fadeOut();
      }, 5000);
	  
});
</script>
  </body>
</html>

<?php if($this->session->flashdata('Reseted')){?>
<script>
 const Toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Password Reset Successfully'
})
</script>
<?php } ?>

<?php if($this->session->flashdata('Invalidlink')){?>
<script>
 const Toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'Invalid Link'
})
</script>
<?php } ?>

