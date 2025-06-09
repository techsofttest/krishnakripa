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
    <h1>View Rooms</h1>
    <ol class="breadcrumb">
    <li></li>
      <li style="float:left;margin-right:2em"><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Admin Home</a></li>
    </ol>
  </section>
  
  <!-- Main content -->
  
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <?php if($this->session->flashdata('success')) {?>
        <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('success');?> </div>
        <?php }?>
        <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-error"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('error');?> </div>
        <?php }?>
        <div class="box">
          <div class="box-body">
            <table id="datatable" class="table table-bordered table-striped delTable">
              <thead>
                <tr>
                  <th class="no-sort">Sl no</th>
                   <th>Name</th>
                  <th>Images </th>
                 <th style="width:23%">Room Price</th>
                    <th>Actions</th>
                    </tr>
              </thead>
              <tbody>
                <?php $i=1;?>
                <?php foreach($view_data as $item=>$val):?>
                <tr id="<?php echo $val->roomid;?>">
                  <td><?php echo $i++; ?></td>
                  <td>
                  <strong>
				  <?php echo $val->name; ?>
                  </strong>
                  <br /><br />
                  Size : <?php echo $val->room_size; ?>
                  <br /><br />
                  Room Type: <?php echo $val->cat_title; ?>
                  <br /><br />


                  </td>                 
                  <td>
                   <a href="<?php echo base_url();?>uploads/Rooms/<?php echo $val->image ?>" class="fancybox-media">
                  <img  src="<?php echo base_url();?>uploads/Rooms/<?php echo $val->image;?>" style="width=100px;height:100px;"/>
                  </a>
				</td>
  <td><?php echo $val->rate?></td>
                
                  <td><a style="color:rgb(102, 102, 102);" href="<?php echo base_url(); ?>admin/Stay/EditRooms/<?php echo $val->roomid;?>" class="edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i style="color:rgb(255, 204, 102);" class="fa fa-pencil-square-o"></i> Edit</a><br>
                    <a style="color:rgb(102, 102, 102);" href="<?php echo base_url();?>admin/Stay/DeleteRooms/<?php echo $val->roomid;?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you absolutely sure you want to delete?');"><i style="color:red" class="fa fa-times"></i> Delete</a><br /></td>
                </tr>
                <?php endforeach;?>
              </tbody>
              <input type="hidden" id="alert-notification" value="Are you sure you want to delete this banner record?">
            </table>
          </div>
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('admin/includes/footer');?>
<script>
 
	$('#datatable').on( 'draw.dt', function () {
    
	$('#datatable').show();
    $('.loader').removeClass("loader");
   
	});
	
 	</script>
   