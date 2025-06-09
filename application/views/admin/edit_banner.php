<?php $this->load->view('admin/includes/header');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Manage Banner
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
            
            
              <?php if($this->session->flashdata('success')) {?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('success');?>
				</div>
            	<?php }?>
                <?php if($this->session->flashdata('error')) {?>
				<div class="alert alert-error">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
			     	<?php echo $this->session->flashdata('error');?>
				</div>
            	<?php }?>
            
            
            
            
            
            
            
      <?php echo form_open('', array('method'=>"POST",'enctype'=>"multipart/form-data",'id'=>"Edit_banner")); ?>    
		
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit Banner</h2>
					</div>
					<div class="box-body">
						  
                         
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							<label>Heading 1<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	  <input class="form-control" name="main_heading"  placeholder="Main Heading" type="text" value="<?php echo $banner_data['ban_main_heading']; ?>" required>	
							</div>
                          </div>
                          
                          
                          
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							<label>Heading 2<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
	  <input class="form-control" name="sub_heading"  placeholder="Sub Heading" type="text" value="<?php echo $banner_data['ban_sub_heading']; ?>" required>	
							</div>
                          </div>
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Change Image <br />Size(1349x600)<strong style="color:#F00;"></strong></label>
                             </div>
                             
                 <div class="col-xs-12 col-sm-9 row-seperate">
                            
          <input class="form-control" name="image[]"  type="file" style="width:40%;display:inline-block" >
          <br><br>
<a href="<?php echo base_url();?>uploads/Banners/<?php echo $banner_data['ban_image']; ?>" class="fancybox-media">
                  <img src="<?php echo base_url();?>uploads/Banners/<?php echo $banner_data['ban_image']; ?>" style="width:170px"></a> 
  
                   </div>
                      </div>
                      
                      
                       </div>
                          </div>                          
                          
             
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
					 <a href="javascript:history.go(-1)" class="btn btn-primary">Cancel</a>
                  </div>
             
			 <?php echo form_close()?>
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
     </div>
 <?php $this->load->view('admin/includes/footer');?>
 <script type="text/javascript">
	
			//edit function start here
		function editFun(id)
		{
			$.ajax({
				url: "<?php echo base_url('admin/Banners/getEditData'); ?>",
				method:"post",
				data:{id:id},
				dataType:"json",
				success:function(response)
				{
					$('#editID').val(response.id);
					$('#editName').val(response.name);
					$('#editMessage').val(response.message);
					$('#editAge').val(response.age);
					$('#editModal').modal({
						backdrop:"static",
						keyboard:false
					});
				}
			})
		}


		$("#editForm").submit(function(event) {
			event.preventDefault();
			$.ajax({
	            url: "<?php echo base_url('my_controller/update'); ?>",
	            data: $("#editForm").serialize(),
	            type: "post",
	            async: false,
	            dataType: 'json',
	            success: function(response){
	              
	                $('#editModal').modal('hide');
	                $('#editForm')[0].reset();
	                if(response==1)
	                {
	                	alert('Successfully updated');
	                }
	                else{
	                	alert('Updation Failed !');
	                }
	               $('#example1').DataTable().ajax.reload();
	              },
	           error: function()
	           {
	            alert("error");
	           }
          });
		});

		//edit function work end here

	</script>