<?php $this->load->view('admin/includes/header');?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/fullcalendar/fullcalendar.min.css" />

<style>

.fc-event {
	font-size: 20px;
	text-align: center;
	/*border: 1px solid #dd9898;*/
	background-color: transparent;
	margin:2px 20px 2px 20px;
}
.fc-content {
/*padding:15px;
	    background-color: #dd9898;*/}
.fc-title {
	color:white;
}
.fc-day-header {
	background-color: #512F50 !important;
	background-image: none;
	line-height: 40px;
	color: #fff;
	font-family: 'existencelight';
	font-size: 18px;
	text-shadow: 1px 1px 1px #333;
}
.fc-unthemed td.fc-today {
	background-color:#41738842
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
    <h1>Manage Available Date</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Admin Home</a></li>
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
            <!-- <a href="#" data-toggle="modal" data-target="#myModal">clickk</a>--> 
            <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Availability</h4>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post">
                      <div class="row form-group">
                        <div class="col col-md-6">
                          <label for="text-input" id="premium1" class=" form-control-label">Premium</label>
                        </div>
                        <div class="col-12 col-md-6">
                          <input type="text" id="premium"  name="avail_room" placeholder="" class="form-control" value="">
                          <input type="hidden" id="event_id"  name="event_id" placeholder="" class="form-control" value="">
                        </div>
                      </div>
                      <div class="sub-lg">
                        <button type="submit" class="btn btn-default submit-login">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="LoadingImage" style=""> 
              <!-- <img src="<?php echo base_url();?>assets/admin/img/loading.gif" />--> 
            </div>
            <div class="section__content section__content--p30">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="overview-wrap">
                      <h2 class="title-1">Manage Available Date</h2>
                    <!--  <a href="#" data-toggle="modal" data-target="#myModal"> <i class="fa fa-user-plus"></i> CLICK</a> -->
                      
                      <!--<a href="view_rooms.php"><button class="au-btn au-btn-icon au-btn--blue">
                                     <i class="fa fa-eye"></i>View Rooms</button></a>--> 
                    </div>
                  </div>
                </div>
                <div class="row m-t-25">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <?php 
 foreach($all_rooms as $new=>$val){ 
 ?>
<a style="color: black;
    font-size: 16px;"> 
    <span style="background-color:<?php echo $val->color;?>;width:10px;height:5px;padding: 4px 22px 4px 3px;"></span> &nbsp;<?php echo $val->name;?> </a>
&nbsp;&nbsp;&nbsp;
                        <?php } ?>
                        <div style="float:right;"> <a href="javascript:history.back()" style="color:#886516" title="back"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a> </div>
                      </div>
                      <form action="" method="post" enctype="multipart/form-data" name="form" class="form-horizontal">
                        <div class="card-body card-block"> 
                          
                          <!--<a id="myModal_upgrade" data-toggle="modal" data-target="#modal-info"><label style="color:green">
                         <i class="fa fa-plus-square"></i> Add facilities</label></a>-->
                          
                          <div class="row form-group">
                            <?php 
									 if(isset($_GET['id']))
									 {
									 ?>
                            <input type="hidden" name="roomid" value="<?php echo $id; ?>" id="roomid"/>
                            <?php } else { ?>
                            <input type="hidden" name="roomid" value="" id="roomid"/>
                            <?php } ?>
                            <div class="col-12 col-md-12"> <span id="datePick"></span>
                              <input type="hidden" name="available_date" id="altField">
                              <div class="response"></div>
                              <div id='calendar'></div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer"> </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
<script src="<?php echo base_url();?>assets/admin/fullcalendar/lib/jquery.min.js"></script> 
<!--<script>$.noConflict();</script>--> 
<script src="<?php echo base_url();?>assets/admin/fullcalendar/lib/moment.min.js"></script> 
<script src="<?php echo base_url();?>assets/admin/fullcalendar/fullcalendar.min.js"></script>




  <footer class="main-footer">
	<div class="pull-right hidden-xs">         
	</div>
	<strong>Copyright &copy; <?php echo date('Y');?> Krishnakripa </strong> All rights reserved.
  </footer>
	<!-- jQuery 2.1.4 -->
    <!--<script src="<?php echo base_url();?>assets/admin/js/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>-->
	<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/admin/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    
   <!-- <script src=".<?php echo base_url();?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>-->
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url();?>assets/admin/js/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/admin/js/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>assets/admin/js/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/admin/js/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
   <script src="<?php echo base_url();?>assets/admin/js/alertify/alertify.min.js" type="text/javascript"></script>

	<!--<script src="<?php echo base_url();?>assets/admin/js/bootstrap/bootstrap.js" type="text/javascript"></script>	-->
	<script src="<?php echo base_url();?>assets/admin/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>	
	<script src="<?php echo base_url();?>assets/admin/js/app.min.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url();?>assets/admin/js/fancybox/jquery.fancybox.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js/jquery.validationEngine-en.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/jquery.validationEngine.js" type="text/javascript"></script>

	<script src="<?php echo base_url();?>assets/admin/js/custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/admin/js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/js/bootstrap-colorpicker.js"></script>
    <!-- page script -->
	<script type="text/javascript">
	function validate()
	{	
	    
		 	$("#add_page").validationEngine('validate');
			 
		var valid = $("#add_page").validationEngine('validate');
		if (valid == true) {
			if ( (textarea=="") || (textarea==null) ) {	
		
					alertify.error("The page content is required.");			
					return false; 
			}
		}
	}
	$(document).ready(function() {
		$("td a").tooltip({ selector: '[data-toggle=tooltip]' });
	});
	</script>
    
   










<?php //$this->load->view('admin/includes/footer');?>
<script>
	/* $(window).on('load',function()
	          {	  
			$('#myModal').modal('show');
			});*/
	
	 
	 
    var i=1;
	function addFile(){ 
	var root=document.getElementById('mytab').getElementsByTagName('tr')[0].parentNode; 
	var oR = cE('tr');
	var oC = cE('td');
	var oI = cE('input'); var oS=cE('span') 
	cA(oI,'type','file');
	cA(oI,'name','attachment[]'); 
	cA(oI,'class','txtNewBox'); 
	oS.style.cursor='pointer'; 
	oS.onclick=function(){ 
	this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode) 
	
	 var j = i - 1; //reduce total no of file
	 i = j;
	 if(i<5){
		 document.getElementById('add_icon').style.display='block';// to show add buttom
		 }
	} 
	oS.appendChild(document.createTextNode('[-]')); 
	oC.appendChild(oI);oC.appendChild(oS);oR.appendChild(oC);root.appendChild(oR); 
	i++;
	if(i>4){
	document.getElementById('add_icon').style.display='none';//to hide add button
	}
		
	}
	function cE(el){ 
	this.obj =document.createElement(el); 
	return this.obj 
	} 
	function cA(obj,att,val){ 
	obj.setAttribute(att,val); 
	return 
	} 
		
	function isNumeric(evt){
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
		return false;
	
	 return true;
	 
	 
	}
	</script> 
<script>
$(document).ready(function(){
$('.date').datepicker({
format: 'dd-mm-yyyy'
});



$("#datePick").multiDatesPicker({
					altField: '#altField',
					dateFormat:'dd-mm-yy',
					dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
				});
			});
	
	

         </script> 
<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy'});
	
  } );
  
 
  </script> 
<script>
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy'});
  } );
  </script> 
<script>

$(document).ready(function () 
{
		var roomid=$('#roomid').val();
        var calendar = $('#calendar').fullCalendar({
        editable: true,
		header: {
			left : 'prev , next ,today',
			center : 'title',
			right : 'month, agendaWeek,agendaDay'
		},
       // events: "fetch-event.php",
	   loading: function (bool) {
       $("#LoadingImage").show();// Add your script to show loading
	   //alert("123");
    },
	eventAfterAllRender: function (view) {
       //$("#LoadingImage").hide(); // remove your loading 
	     $("#LoadingImage").hide();
		// alert("haii");
    },
	    events: {
		     		
            url: '<?php echo base_url();?>admin/Available_dates/FetchEvent',
            cache: true,
            type: 'POST',
            data: {
				
                //roomid: roomid,
			
				
            },
            error: function () {
                alert('there was an error while fetching events!');
            },
        },
		eventRender: function (event, element, view)
		 {
		
		
              element.css('background-color', event.color)
            
				
        },
        selectable: true,
        selectHelper: true,
        editable: true,       
			 eventClick:  function(event, jsEvent, view)
			  {
				//alert(event.id)  
				//alert(event.title)  
				//alert(event.description)  
						  
			//$("#myModal").modal(show);
			$('#myModal').modal({ show: true });
			 $('#event_id').val(event.id);
            $('#premium').val(event.title);
			$('#premium1').html(event.description);
            //$('#calendarModal').modal(show);
			
			
        },
	
		

    });
	
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script> 
