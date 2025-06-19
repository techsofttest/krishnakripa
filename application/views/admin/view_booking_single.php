<?php $this->load->view('admin/includes/header');?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
       <?php $this->load->view('admin/includes/sidebar');?>
      </aside>
      
    


      <style>

       
        .booking-main-details p {
            font-size: 20px;
            font-weight: 600;
        }

        .date-box
        {
          display:flex;
          height: 100%;
          width: 100%;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          background: #42a5d65c;
          padding: 15px;
          border-radius: 10px;
        }

        .date-box p
        {
            font-size: 15px;
        }


        .date-box .date
        {
          font-size: 25px;
        }

        .room-box img
        {
          width:50%;
          height:150px;
          object-fit: contain;
        }

        .info-box {
        background: #6c6c6c;
        color:white;
        }

        .content-header>h1 {
        font-size: 40px;
        font-weight: 600;
        }

        address
        {
            font-size: 20px;
        }

        .detail-table tbody {
        font-size: 17px;
        }

      </style>

        
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header text-center">
          <h1>
          <?= $booking['uid'] ?>
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
            
               
             <div class="box">             
            
                		<div class="box-body">

                         
                            <div class="container-fluid">


                            <div class="row">

                                <div class="col-lg-3 col-xs-6">
                                 <div class="info-box">
                                    <span class="info-box-icon bg-black"><i class="fa fa-bed"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Room</span>
                                      <span class="info-box-number"><?= $booking['name'] ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                </div>


                                 <div class="col-lg-3 col-xs-6">
                                 <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-sign-in"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Check In</span>
                                      <span class="info-box-number"><?= date('d M Y',strtotime($booking['check_in_date'])) ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                </div>



                                <div class="col-lg-3 col-xs-6">
                                 <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-sign-out"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Check Out</span>
                                      <span class="info-box-number"><?= date('d M Y',strtotime($booking['check_out_date'])) ?></span>
                                    </div>
                                   
                                  </div>
                                </div>



                                <div class="col-lg-3 col-xs-6">
                                 <div class="info-box">
                                    <span class="info-box-icon bg-orange"><i class="fa fa-bell"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Status</span>
                                      <span class="info-box-number"><?= $booking['booking_status']; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                </div>


                            </div>

                          
     

      <div class="row">


       <!-- this row will not appear when printing -->
      
        <div class="col-xs-12">
          <a href="<?= base_url(); ?>admin/Bookings/Invoice/<?= $booking['booking_id']; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Invoice</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>Add Payment
          </button>
          <a href="<?= base_url(); ?>admin/Bookings/Invoice/<?= $booking['booking_id']; ?>" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Invoice
          </a>
        </div>
     


        <!-- Customer Details Start -->
        <div class="col-xs-6 text-center">

        <h3>Customer Details</h3>
        <table class="table table-striped table-bordered detail-table">


                  <tr>

                    <td class="-right">Name : </td>

                    <th class=""><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></th>

                  </tr>


                  <tr>

                    <td class="-right">Address : </td>

                    <th class=""><?= nl2br($booking['address']); ?></th>

                  </tr>

                  <tr>

                    <td class="-right">Phone : </td>

                    <th class=""><?= $booking['phone_number']; ?></th>

                  </tr>


                  <tr>

                    <td class="-right">Email : </td>

                    <th class=""><?= $booking['email_address']; ?></th>

                  </tr>


        </table>

        </div>

        <!-- Customer Details End -->


        <!-- Room Details Start -->

         <div class="col-xs-6 table-responsive text-center">
          <h3>Booking Details</h3>
          <table class="table table-bordered table-striped detail-table">
          
            <tbody>
           
              <tr>
              <td>Room Type</td>
              <th><?= $booking['name']; ?></th>
              </tr>

              <tr>
              <td>No Of Rooms</td>
              <th><?= $booking['no_of_rooms']; ?></th>
              </tr>

              <tr>
              <td>Adults/Children</td>
              <th><?= $booking['adults']; ?>/<?= $booking['children']; ?></th>
              </tr>

              <tr>
              <td>Subtotal</td>
              <th><?= $booking['total_amount']; ?></th>
              </tr>

              <tr>
                  <td class="-right">Notes : </td>
                  <th class=""><?= $booking['booking_notes']; ?></th>
              </tr>
           
            </tbody>
          </table>
        </div>


        <!-- Room Details End -->



      </div>



      <?php if(!empty($payments)) { ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 text-center">
          <h3>Payment Details</h3>
        </div>
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped detail-table">
            <thead>
            <tr>
              <th>Sl No</th>
              <th>Date</th>
              <th>Payment Method</th>
              <th>Notes</th>
              <th>Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php 
            $p=0;
            foreach($payments as $pay){ ?>
            <tr>
              <td><?= ++$p ?></td>
              <td><?= date('d M Y',strtotime($pay->bp_paid_on)) ?>  <?php // date('h:i a',strtotime($pay->bp_paid_on)) ?></td>
              <td><?= $pay->bp_pay_method ?></td>
              <td><?= $pay->bp_notes ?></td>
              <td class="text-success"><?= $pay->bp_amount ?></td>
            </tr>

            <?php } ?>
           
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <?php } ?>




      <?php if(!empty($refunds)) { ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 text-center">
          <h3>Refund Details</h3>
        </div>
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped detail-table">
            <thead>
            <tr>
              <th>Sl No</th>
              <th>Date</th>
              <th>Payment Method</th>
              <th>Notes</th>
              <th>Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php 
            $p=0;
            foreach($refunds as $pay){ ?>
            <tr>
              <td><?= ++$p ?></td>
              <td><?= date('d M Y',strtotime($pay->bp_paid_on)) ?>  <?php // date('h:i a',strtotime($pay->bp_paid_on)) ?></td>
              <td><?= $pay->bp_pay_method ?></td>
              <td><?= $pay->bp_notes ?></td>
              <td class="text-danger"><?= $pay->bp_amount ?></td>
            </tr>

            <?php } ?>
           
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
       <?php } ?>






       <style>

          .payment-summary-table td
          {

          text-align:right;

          }

          .payment-summary-table
          {
            font-size:20px;
          }


       </style>



      <div class="row">
        <!-- accepted payments column -->
        <!-- /.col -->
        <div class="col-xs-12">

          <h3 class="text-center">Payment Summary</h3>
          
          <div class="table-responsive">
            <table class="table payment-summary-table">
              <tbody>
             
              <tr>
                <th>Total:</th>
                <td><?= $booking['total_amount']; ?></td>
              </tr>

              <tr>
                <th>Paid:</th>
                <td style="color:green;"><?= $booking['paid_amount']; ?></td>
              </tr>

              <?php if($booking['booking_status']=="cancelled"){ ?>
               <tr>
                <th>Refunded:</th>
                <td style="color:red;"><?= format_currency($total_refunds); ?></td>
              </tr>
              <?php } else { ?>
              <tr>
                <th>Pending:</th>
                <td style="color:red;"><?= format_currency($booking['total_amount']-$booking['paid_amount']); ?></td>
              </tr>
              <?php } ?>

            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>




                              </div>





                            </div>
                            
                         
                			
                		</div><!-- /.box-body -->
              		</div> 
              
              
              
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section>
        
        
        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?php $this->load->view('admin/includes/footer');?>

   