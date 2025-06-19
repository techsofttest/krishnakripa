<?php $this->load->view('admin/includes/header');?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

      <style>


        .fac-box
        {
        text-align: center;
        margin: 10px 0px;
        box-shadow: 0px 0px 3px 3px #0000002e;
        padding: 10px;
        border-radius: 10px;
        }

        .fac-box img
        {
        height: 40px !important;
        width: 40px !important;
        object-fit: contain;
        }

        .fac-box h3
        {
        font-size:13px;
        margin:2px;

        }

        .fac-box a
        {

        color: red;

        }


         .img-box
        {
        text-align: center;
        margin: 10px 0px;
        box-shadow: 0px 0px 3px 3px #0000002e;
        padding: 10px;
        border-radius: 10px;
        }

        .img-box img
        {
        height: 100px !important;
        width: 100% !important;
        object-fit: contain;
        }

        .img-box h3
        {
        font-size:13px;
        margin:2px;

        }

        .img-box a
        {

        color: red;

        }

        
      </style>

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
           Manage Rooms
          </h1>
          <ol class="breadcrumb">
          
           <li style="float:left;margin-right:2em"><a href="<?php echo base_url();?>admin/Menu"><i class="fa fa-dashboard"></i>Admin Home</a></li>
          </ol>
        </section>

		<?php $parent = $this->uri->segment(3); ?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">  
			<form name="add_menu" id="add_menu" method="POST" enctype="multipart/form-data" >
            
        <?php if($this->session->flashdata('success')) {?>
        <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('success');?> </div>
        <?php }?>
        <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-error"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('error');?> </div>
        <?php }?>   
            
			<div class="box">
                <div class="box-body">
				<!-- Form Element sizes -->
				  <div class="box box-success">
					<div class="box-header with-border">
					  <h2 class="box-title">Edit Rooms Details</h2>
                      <div style="float:right;">
                  <a href="javascript:history.back()" style="color:#92170f" title="back"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                  </div>
					</div>
					<div class="box-body">
						  
                          
          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Room Type<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-4 row-seperate">
                    <select name="type" class="form-control">
                      <option value="">Select</option>

                  <?php foreach($type_data as $cat){?>

                    <option value="<?php echo $cat->cat_id?>" <?php if($cat->cat_id == $arr_pack["category"]){ echo "selected";}?>><?php echo $cat->cat_title?></option>

                  <?php } ?>

                    </select>      			 
				           </div>
                          </div>

                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Name<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                             <input type="text" name="name" class="form-control" required value="<?php echo $arr_pack["name"];?>">
							</div>
                          </div>
                          
                           
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Date Available<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-4 row-seperate">
                             <input type="text" disabled class="form-control" value="<?php echo date('d/m/y',strtotime($arr_pack["startdate"]))."-".date('d/m/y',strtotime($arr_pack["enddate"]))?>">
							</div>
                          </div>
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Update Date Range<strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-4 row-seperate">
                             <input type="text" name="datefilter"  class="form-control">
							</div>
                          </div>
                           
                           
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Available Rooms  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-4 row-seperate">
<input type="text" id="text-input" name="avail_room" onKeyPress="return isNumeric(event)" placeholder="Available Rooms" class="form-control" value="<?php echo $arr_pack["avail_room"]?>" required>
							</div>
                          </div>
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
						
                              <label> Room Rate <strong style="color:#F00;">*</strong></label>
                             </div>
                                <div class="col-xs-12 col-sm-4 row-seperate">
<input type="text" id="text-input" name="rate" onKeyPress="return isNumeric(event)" placeholder="Offer Price" class="form-control" value="<?php echo $arr_pack["rate"]?>" required>
							</div>
              </div>
						   
                        
<!--                           <div class="row">-->
<!--						     <div class="col-xs-12 col-sm-3 row-seperate">-->
<!--							 <label> Extrabed Price  <strong style="color:#F00;">*</strong></label>-->
<!--                             </div>-->
<!--                             <div class="col-xs-12 col-sm-4 row-seperate">-->
<!--<input type="text" id="text-input" name="extrabed_price" placeholder="Extrabed Price" class="form-control"  onKeyPress="return isNumeric(event)" value="<?php echo $arr_pack["extrabed_price"]?>" required>-->
<!--							</div>-->
<!--                          </div>-->


                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Room Size  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-4 row-seperate">
<input type="text" name="room_size" placeholder="Room Size" class="form-control" value="<?php echo $arr_pack["room_size"]?>" required>
							</div>
                          </div>
                           <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Tax (%) <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-4 row-seperate">
<input type="text" id="text-input" name="tax" placeholder=" Tax (%)" class="form-control"  onKeyPress="return isNumeric(event)" value="<?php echo $arr_pack["tax"]?>" required>
							</div>
                          </div> 



                  <div class="row">
                  <div class="col-xs-12 col-sm-3 row-seperate">
                  <label>Added Facilities</label>
                  </div>
                    <div class="col-xs-12 col-sm-9 row-seperate">
                    <div class="row">
                    <?php  foreach($fac as $facl) {	?>
                    <div class="col-sm-2">
                    <div class="fac-box">
                    <img  src="<?php echo base_url();?>uploads/Rooms/<?php echo $facl->Facimage;?>" style=""/>
                     <h3><?php echo $facl->Factitle;?></h3>
                    <a class="lnk_new" href="<?php echo base_url();?>admin/Rooms/DeleteRoomsFac/<?php echo $facl->roomid; ?>/<?php echo $facl->imageid; ?>" title="Delete" OnClick="return confirm('Do you want to Delete');">Delete</a>
                    </div>
                    </div>           
				         	<?php } ?>
                    </div>
                    </div>

                    </div>
				

                          <div class="row" style="margin-top:5%">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Add Facility<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper1">                
                  <input  class="form-control" name="Factitle[]"  type="text"  style="width:40%;display:inline-block">                      
	    <input  class="form-control" name="Facimage[]" id="image"  type="file"  style="width:40%;display:inline-block">
      Add More: &nbsp&nbsp; <a href="javascript:void(0);" class="add_button1" title="Add field">
        <img src="<?php echo base_url();?>assets/admin/img/add-icon.png"/></a>
     
        <br /><br />
		</div>
                          </div>      

                            

                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> More Facilities  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
 <textarea name="facilities" id="editor2" rows="9" placeholder="Facilities..." class="form-control"><?php echo $arr_pack["facilities"]?></textarea>                            
							</div>
                          </div> 
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Description  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
 <textarea name="description" id="editor1" rows="9" placeholder="Description..." class="form-control"><?php echo $arr_pack["description"];?></textarea>                            
							</div>
                          </div>
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label> Image  <strong style="color:#F00;">*</strong></label>
                             </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
  <?php
														if($arr_pack["image"]!='')
														{
															?>  
<!--<a href="<?php echo base_url();?>uploads/Rooms/<?php echo $arr_pack["image"]; ?>" class="fancybox-media">-->
<img src="<?php echo base_url();?>uploads/Rooms/<?php echo $arr_pack["image"];?>" style="width:200px;height:200px"/>
<!--</a>-->
															<?php }
															else
															{
																echo "Not Uploaded";}
														?>                         
							</div>
                          </div>

                          <div class="row">
                          <div class="col-xs-12 col-sm-3 row-seperate">
                        <label>Change Image </label>
                                      </div>
                             <div class="col-xs-12 col-sm-9 row-seperate">
                              <input type="file" class="form-control" name="main_img[]" >
							              </div>
                          </div> 


                  <div class="row">
                  <div class="col-xs-12 col-sm-3 row-seperate">
                  <label>More Images </label>
                  </div>
                  <div class="col-xs-12 col-sm-9 row-seperate">
                    <div class="row">
                  <?php  foreach($res as $new=>$val) {	?>
                    <div class="col-sm-4">
                    <div class="img-box">
                    <img  src="<?php echo base_url();?>uploads/Rooms/<?php echo $val->more_image;?>" style="display:block;"/>
                    <a class="lnk_new" href="<?php echo base_url();?>admin/Rooms/DeleteRoomsMore/<?php echo $val->roomid; ?>/<?php echo $val->imageid; ?>" title="Delete" OnClick="return confirm('Do you want to Delete');">Delete</a>
                    </div>
                    </div>       
				         	<?php } ?>
                  </div>
                  </div>

                  </div>
				
						      	</div>
                          </div>  
                   
                          <div class="row">
						     <div class="col-xs-12 col-sm-3 row-seperate">
							 <label>Add New More Image<strong style="color:#F00;">*</strong></label>
                             
                             </div>
                  <div class="col-xs-12 col-sm-9 row-seperate field_wrapper">                
                             
	    <input  class="form-control" name="image[]" id="image"  type="file"  style="width:40%;display:inline-block" >
      Add More: &nbsp&nbsp; <a href="javascript:void(0);" class="add_button" title="Add field">
        <img src="<?php echo base_url();?>assets/admin/img/add-icon.png"/></a>
     
        <br /><br />
		</div>                      
                  

                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbutton">Submit</button>
					<button type="button" onclick="window.history.back()" class="btn btn-primary">Go Back</button>
                  </div>
              </div><!-- /.box -->
			  </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
 
 <script type="text/javascript">   
	$(document).ready(function(){
		var maxField = 10; 
		var addButton = $('.add_button'); 
		var wrapper = $('.field_wrapper'); 
		var fieldHTML = '<div> <input class="form-control" name="image[]" multiple type="file" required style="width:40%;display:inline-block">&nbsp&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/></a></div><br>'; //New input field html 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ 
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	});
	
	
</script>
     
<script type="text/javascript">   
	$(document).ready(function(){
		var maxField = 10; 
		var addButton = $('.add_button1'); 
		var wrapper = $('.field_wrapper1'); 
		var fieldHTML = '<div> <input class="form-control" name="Factitle[]" multiple type="text" required style="width:40%;display:inline-block"><input class="form-control" name="Facimage[]" multiple type="file" required style="width:40%;display:inline-block">&nbsp&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<img src="<?php echo base_url();?>assets/admin/img/remove-icon.png"/></a></div><br>'; //New input field html 
		var x = 1; 
		$(addButton).click(function(){ 
			if(x < maxField){ 
				x++; 
				$(wrapper).append(fieldHTML); 
			}
		});
		$(wrapper).on('click', '.remove_button', function(e){ 
			e.preventDefault();
			$(this).parent('div').remove(); 
			x--; 
		});
	});
	
	
</script>
