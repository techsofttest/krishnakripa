 
<?php $this->load->view('admin/includes/header');?>
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
  </style>

  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
     
      </aside>
  
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Settings
	  </h1>
	  <ol class="breadcrumb">
	
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
     	<?php if($this->session->flashdata('success')) {?>
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
							<?php echo $this->session->flashdata('success');?>
					</div>
        <?php }?>
	  <div class="row">
		<div class="col-md-3">

		  <!-- Profile Image -->
		  <!-- /.box -->
		</div><!-- /.col -->
		<div class="col-md-12">
		  <div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#change_passwors" data-toggle="tab">Reset Password</a></li>
			 
			</ul>
			<div class="tab-content">
			  <div class="active tab-pane" id="change_passwors">
				<form method="post" action="<?php echo base_url() ?>admin/Forgot_password/ForgotPassword" id="form-password" class="formValidation form-horizontal">
				 
				  <div class="form-group">
					<label for="new" class="col-sm-2 control-label">Enter Email<span class="required">*</span> </label>
					<div class="col-sm-10">
					<input type="email" placeholder="Email" class="form-control" name="email_r" onkeyup="getemailcheck_otp(this.value);"  required/>
            <p id='tabemaill' style="display:none;color:red;margin: 0px;"> </p>
					</div>
				  </div>
				 
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" class="btn btn-danger" >Submit</button>
                      <button type="button" onclick="window.location='<?php echo base_url();?>admin';" class="btn btn-primary">Cancel</button>
					</div>
                   
				  </div>
				</form>
			  </div><!-- /.tab-pane -->
			  
				<!-- second tab end here-->
			</div><!-- /.tab-content -->
		  </div><!-- /.nav-tabs-custom -->
		</div><!-- /.col -->
	  </div><!-- /.row -->

	</section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <?php $this->load->view('admin/includes/footer');?>
  <?php if($this->session->flashdata('Forget')){?>
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
  title: 'A password reset link has been sent to your email, Use that link to reset your password'
})
</script>
<?php } ?>

<?php if($this->session->flashdata('fornotfound')){?>
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
  title: 'User with this email address not found'
})
</script>
<?php } ?>

 