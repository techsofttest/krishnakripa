<?php $this->load->view("header")?>


<style>

._failed{ border-bottom: solid 4px red !important; }
._failed i{  color:red !important;  }

._success {
    box-shadow: 0 15px 25px #00000019;
    padding: 45px;
    width: 100%;
    text-align: center;
    margin: 10px auto;
    border-bottom: solid 4px #28a745;
}

._success i {
    font-size: 55px;
    color: #28a745;
}

._success h2 {
    margin-bottom: 12px;
    font-size: 40px;
    font-weight: 500;
    line-height: 1.2;
    margin-top: 10px;
}

._success p {
    margin-bottom: 0px;
    font-size: 18px;
    color: #495057;
    font-weight: 500;
}

</style>



<div class="breadcumb-wrapper " data-bg-src="assets/img/about-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Booking Summary</h1>

        </div>
    </div>
</div>

<div class="About-Desidency">
<div class="container">

    <div class="row align-items-center justify-content-center">

	      <div class="col-lg-8">

        <?php if($booking['payment_status']==2 || 1==1) { ?>

       <div class="message-box _success">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>

                    <h2> Your payment was successful </h2>

                    <table class="table table-striped">

                    <tr>
                    <td>Booking ID</td>
                    <td><?= $booking['uid']; ?></td>
                    </tr>

                    <tr>
                    <td>Check In</td>
                    <td><?= date('d-M-Y',strtotime($booking['check_in_date'])); ?></td>
                    </tr>

                    <tr>
                    <td>Check Out</td>
                    <td><?= date('d-M-Y',strtotime($booking['check_out_date'])); ?></td>
                    </tr>


                    <tr>
                    <td>No Of Rooms</td>
                    <td><?= $booking['no_of_rooms']; ?></td>
                    </tr>

                    <tr>
                    <td>Total Amount</td>
                    <td><?= $booking['total_amount']; ?></td>
                    </tr>

                    </table>

                   <p> Thank you for choosing Krishnakripa</p>
                    <p>Booking details has been sent to <?= $booking['email_address']; ?></p>   

        </div> 

        <?php } ?>
      


    </div>

  </div>
</div>


      
<?php $this->load->view("footer")?>
 