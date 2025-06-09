<?php $this->load->view('admin/includes/header');?>
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
           Manage Contact
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit Contact</h2>
					</div>
					<div class="box-body">
						     
         
                          
                      <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Address </label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
							  <textarea class="form-control" name="maddress" rows="5" cols="40"  ><?php echo $cms_data['maddress']; ?></textarea>	
							</div>
                          </div>
                          
                          
                          

                           <div class="row">
                 <div class="col-xs-12 col-sm-3 row-seperate">
               <label>Residency <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
       <textarea class="form-control" name="phone"><?php echo $cms_data['phone']; ?></textarea>	  
              </div>
                          </div>
                          
                          
                          
                            <div class="row">
                 <div class="col-xs-12 col-sm-3 row-seperate">
               <label>Executive stay<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                                   <textarea class="form-control" name="phone2"><?php echo $cms_data['phone2']; ?></textarea>	
     
              </div>
                          </div>
                          
      
                          <div class="row">
                 <div class="col-xs-12 col-sm-3 row-seperate">
               <label>Thaza<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                                   <textarea class="form-control" name="phone3"><?php echo $cms_data['phone3']; ?></textarea>	
    
              </div>
                          </div>
                  

                           <div class="row">
                 <div class="col-xs-12 col-sm-3 row-seperate">
               <label>Email<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
      <input class="form-control" name="email"  value="<?php echo $cms_data['email']; ?>"  type="text" required>  
              </div>
                          </div>


                          

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Update</button>
					 <a href="javascript:history.go(-1)" class="btn btn-primary">Go back</a>
                  </div>
              </div><!-- /.box -->
			  </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

