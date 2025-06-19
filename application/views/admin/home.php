<?php $this->load->view('admin/includes/header');?>


<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/simple-calendar.css">


<style>
    .calendar-container
    {
        padding: 40px;
        box-shadow: 0px 0px 3px 1px #0000006b;
        border-radius: 10px;
        margin: 50px 0px
    }

    .day.has-event {
    background: red !important;
    color: white;
    }

    .calendar td
    {
    box-shadow: 0px 0px 1px 0px black;
    }

  .room-box {
    text-align: center;
    background: #e1e1e1;
    border-radius: 10px;
    height: 85px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 5px 0px;
    padding: 10px;
  }

  .room-title
  {
  font-size: 15px;
  }

  .room-available
  {
  font-size: 25px;
  }

  .room-price
  {

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
          
         <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <!-- <h2 class="title-1">Dashboard</h2> -->
                                    <!--<button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button>-->
                                </div>
                            </div>
                        </div>
                        
                   <section class="content">


        <?php 

        if(!empty($this->session->userdata('manage')))

        {

        ?>



          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
           <div class="small-box">
                <div class="inner">
                  <h3 style="color:rgba(0, 166, 39, 0)">0<?php //echo $max_order;?></h3>
                  <p>Welcome Admin!</p>
                </div>
                <div class="icon">
                 <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="<?php echo base_url() ?>admin/login/logout" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-user" style="padding-top:10px"></i></a>
                </div>
                <a href="<?php echo base_url() ?>admin/login/logout" class="small-box-footer">
                  Logout <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>



          <div class="col-lg-3 col-xs-6">
              <!-- small box -->
           <div class="small-box">
                <div class="inner">
                  <h3 style="color:rgba(0, 166, 39, 0)">0<?php //echo $max_order;?></h3>
                  <p>Change Password</p>
                </div>
                <div class="icon">
                 <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="<?php echo base_url() ?>admin/change_password" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-lock" style="padding-top:10px"></i></a>
                </div>
                <a href="<?php echo base_url() ?>admin/change_password" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>


          <?php
          }
          else{
          ?>
          


          <div class="row"> 

             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
             <div class="small-box" style="">
                <div class="inner">
                  <h3 style="" id="booking_count"><?php echo $summary['booked_count'];?></h3>
                  <p>Bookings</p>
                </div>
                <div class="icon">
                 <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="#" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-star" style="padding-top:10px"></i></a>
                </div>
                <a href="<?php echo base_url(); ?>admin/Bookings" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              </div>



              <div class="col-lg-3 col-xs-6">
              <!-- small box -->
             <div class="small-box" style="">
                <div class="inner">
                  <h3 style="" id="checkin_count"><?php echo $summary['checkin_count'];?></h3>
                  <p>Check In's</p>
                </div>
                <div class="icon">
                 <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="#" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-sign-in" style="padding-top:10px"></i></a>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              </div>





               <div class="col-lg-3 col-xs-6">
              <!-- small box -->
             <div class="small-box" style="">
                <div class="inner">
                  <h3 style="" id="checkout_count"><?php echo $summary['checkout_count'];?></h3>
                  <p>Check Out's</p>
                </div>
                <div class="icon">
                  <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="#" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-sign-out" style="padding-top:10px"></i></a>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              </div>




              <div class="col-lg-3 col-xs-6">
              <!-- small box -->
             <div class="small-box" style="">
                <div class="inner">
                  <h3 style=""><?php echo $customers;?></h3>
                  <p>Customers</p>
                </div>
                <div class="icon">
                 <!-- <i class="fa fa-shopping-cart"></i>-->
                  <a href="#" style="color:rgba(0, 0, 0, 0.15)"><i class="fa fa-user" style="padding-top:10px"></i></a>
                </div>
                <a href="#" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
              </div>





          </div>




          <div class="row">



                      <div class="col-lg-6">


                      <div id="calender-div">


                      </div>


                    </div>

                                

                        <div class="col-sm-6">
                    		<?php $i=1;?>
                    				
									      <?php 
									
									      foreach($rooms as $item=>$val):?>

                        <div class="col-sm-6">

                          <div class="room-box">

                              <h3 class="room-title"><?= $val->name ?></h3>
                              <p class="room-available" id="<?= $val->room_slug_name ?>"><?= $val->available_rooms ?></p>
                              <p class="room-price"></p>

                          </div>


                        </div>




                        <?php /*
                        <tr>

                        <td class=""><?= $val->name ?></td>
                                        
                        <td><?= $val->rate ?></td>    
                    
                        <td><?= $val->tax ?> %</td>

                        <td><?= $val->avail_room ?></td>

                        <td><?= $val->avail_room ?></td>

                        </tr>
                        */ ?>
                                    
					  				    <?php 

                        $i++; 
                        endforeach;
                        ?>   

                        </div>

          </div>






          <div class="col-lg-12">

                          <table class="table table-bordered delTable">
                    			<thead>
                                    <tr>
                                        <th class="no-sort">Sl no</th>
                                        
                                         <th>Check In</th>    
                                     
                                         <th>Check Out</th>

                                         <th>Room</th>

                                         <th>Name</th>

                                         <th>Phone</th>

                                         <th>Pending</th>
                                       
                                    </tr>
                    			</thead>
                    			
                        
                       <tbody>
                                
                    		<?php $i=1;?>
                    				
									      <?php 
									
									      foreach($bookings as $item=>$val):?>

                        <tr>
                       			
                        <td class=""><?= $i ?></td>
                                        
                        <td><?= date('d M Y',strtotime($val->check_in_date)) ?></td>    
                    
                        <td><?= date('d M Y',strtotime($val->check_out_date)) ?></td>

                        <td><?= $val->name ?></td>

                        <td><?= $val->first_name ?> <?= $val->last_name ?></td>

                        <td><?= $val->phone_number ?></td>

                        <td><b style="color:red;"><?= $val->total_amount-$val->paid_amount; ?></b></td>

                        
                        </tr>
                                    
					  				    <?php 
                        $i++; 
                        endforeach;
                        ?> 
                                    
                      </tbody> 
                                
                  	</table>

          </div>



          <?php
          }
          ?>





        </section>
                     
                        
                                            </div>
                </div>
         
        </section>

       
      </div><!--content-wrapper -->

      <?php $this->load->view('admin/includes/footer');?>



      <!-- View Bookings Modal Start -->

      <div class="modal fade" id="bookings_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Classes On <strong class="class_date text-bold"></strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          
          <div class="modal-body">

          <table class="table table-bordered">

          <thead>

          <tr> 
              <th>Details</th>
              <th>Time</th>
              <th>Date</th>
              <th>Link</th>
              <th>Actions</th>
          </tr>

          </thead>


          <tbody id="class_wrapper">

          
          </tbody>


        

          </table>                                        

          
          <form id="add_class_form">

          <input type="hidden" name="date" id="class_date" class="form-control class_date_input">


          <label>Time <span class="text-danger">*</span></label>                                        
          <input type="time" name="time" onclick="this.showPicker()" class="form-control">

          <label>Description <span class="text-danger">*</span></label>                                        
          <input type="text" name="title" class="form-control">


          <label>Link <span class="text-danger">*</span></label>                                        
          <input type="text" name="link" class="form-control">

            
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Class</button>
          </div>

          </form>

        </div>
      </div>
    </div>


      <!-- View Bookings Modal End -->




    
 <script src="<?php echo base_url(); ?>assets/admin/js/jquery.simple-calendar.js"></script>


<script>

$(function() {
  var $class_name;
  var $calendar;
  var $result;
  var $event_array=[];
  $(document).ready(function () {

    let container = $("#calender-div").simpleCalendar({
    fixedStartDay: 0, // begin weeks by sunday
    disableEmptyDetails: false,

    events : [
        
        <?php /* foreach($classes as $cls) { ?>
        {
          startDate: new Date("<?php echo $cls->class_date; ?>").toDateString(),
          endDate: new Date("<?php echo $cls->class_date; ?>").toISOString(),
          summary: '<?php echo $cls->class_title; ?>',
        },
        <?php } */ ?>

    ],

    });
    $calendar = container.data('plugin_simpleCalendar')
    });

  


    
    $('body').on('click','.day',function(){

    $('.day').removeClass('today');

    $(this).addClass('today');

    var date_val = $(this).data('date');

    $('.room-available').html('-');

    $.ajax({

      url : '<?= base_url() ?>admin/Home/RoomAvailableByDate',
      type : 'POST',
      data : {date:date_val},
      success:function(response)
      {
      
      var response = JSON.parse(response);

      //console.log(response);

      var rooms = response.rooms;

      rooms.forEach(function(room) {
        $('#' + room.room_slug_name).html(room.available_rooms);
      });

      $('#booking_count').html(response.summary.booked_count);
      $('#checkin_count').html(response.summary.checkin_count);
      $('#checkout_count').html(response.summary.checkout_count);


      }

    });

    /*
    $('#class_wrapper').hide();

    var date = $(this).data('date');

    date_split = date.split('-');
    yr = date_split[0][2] + date_split[0][3]; //special yr format, take last 2 digits
    mnth = date_split[1];
    dy = date_split[2];

    formatted_date = dy+"-"+mnth+"-"+yr;


    $('.class_date_input').val($(this).data('date'));
    $('.class_date').html(formatted_date);
    */

    //Fetch Classes From Date

   

    //$('#bookings_modal').modal('show');

    });
    

});

</script>
    
