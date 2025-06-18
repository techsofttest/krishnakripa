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
        font-size: 25px;
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


                            <section class="invoice">
     
      <!-- info row -->
      <div class="row invoice-info">

        <div class="col-sm-6 invoice-col">
          Customer
          <address>
            <strong><?= $booking['first_name'] ?> <?= $booking['last_name'] ?></strong><br>
            <strong><?= nl2br($booking['address']); ?></strong><br>
           
          </address>
        </div>
        

        <div class="col-sm-4 invoice-col">
          Contact Details & ID Proof
          <address>
            <b><?= $booking['phone_number']; ?></b><br>
            <b><?= $booking['email_address']; ?></b>
          </address>
        </div>
        <!-- /.col -->


        <div class="col-sm-2 invoice-col">
          Booking Notes
          <address>
            <b><?= $booking['booking_notes']; ?></b><br>
          </address>
        </div>
        <!-- /.col -->



      </div>
      <!-- /.row -->


      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 text-center">
          <h3>Room Details</h3>
        </div>
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped detail-table">
            <thead>
            <tr>
              
              <th>Room Type</th>
              <th>No Of Rooms</th>
              <th>Adults/Children</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
             
              <td><?= $booking['name']; ?></td>
              <td><?= $booking['no_of_rooms']; ?></td>
              <td><?= $booking['adults']; ?>/<?= $booking['children']; ?></td>
              <td><?= $booking['total_amount']; ?></td>
            </tr>
           
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->




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
              <td><?= date('d M Y',strtotime($pay->bp_paid_on)) ?> - <?= date('h:i a',strtotime($pay->bp_paid_on)) ?></td>
              <td><?= $pay->bp_pay_method ?></td>
              <td><?= $pay->bp_pay_method ?></td>
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
              <td><?= date('d M Y',strtotime($pay->bp_paid_on)) ?> - <?= date('h:i a',strtotime($pay->bp_paid_on)) ?></td>
              <td><?= $pay->bp_pay_method ?></td>
              <td><?= $pay->bp_pay_method ?></td>
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

              <tr>
                <th>Pending:</th>
                <td style="color:red;"><?= format_currency($booking['total_amount']-$booking['paid_amount']); ?></td>
              </tr>

            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <a href="<?= base_url(); ?>admin/Bookings/Invoice/<?= $booking['booking_id']; ?>" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Invoice
          </a>
        </div>
      </div>
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

   