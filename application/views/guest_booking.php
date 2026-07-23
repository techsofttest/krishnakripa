<?php $this->load->view('header'); ?>

<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url()?>assets/img/c-banner.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Guest Registration</h1>
        </div>
    </div>
</div>

<div class="contact-inner-sec">
    <div class="container">

        <div class="title-area mb-25 text-center">
            <h2 class="border-title h3">
                <?= !empty($hotel['hotel_name']) ? html_escape($hotel['hotel_name']) : 'Hotel Registration'; ?>
            </h2>

            <?php if (!empty($hotel['hotel_address'])) { ?>
                <p><?= nl2br(html_escape($hotel['hotel_address'])); ?></p>
            <?php } ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>

                <?= form_open_multipart(base_url('user-booking/save'), [
                    'class' => 'contact-form style3'
                ]); ?>

                <input type="hidden"
                       name="hotel_slug"
                       value="<?= html_escape($hotel['hotel_slug']); ?>">
                <input type="hidden"
                       name="hotel_id"
                       value="<?= !empty($hotel['hotel_id']) ? (int) $hotel['hotel_id'] : 0; ?>">

                <div class="row">

                   <div class="form-group col-md-6">
    <label>First Name <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control"
           name="first_name"
           value="<?= set_value('first_name'); ?>"
           required>
</div>

<div class="form-group col-md-6">
    <label>Last Name</label>
    <input type="text"
           class="form-control"
           name="last_name"
           value="<?= set_value('last_name'); ?>">
</div>

<div class="form-group col-md-6">
    <label>Mobile Number <span class="text-danger">*</span></label>

    <input type="text"
           class="form-control mobile-number"
           name="mobile"
           value="<?= set_value('mobile'); ?>"
           maxlength="10"
           required>
        
</div>

<div class="form-group col-md-6">
    <label>Alternate Mobile Number</label>
    <input type="tel"
           class="form-control mobile-number"
           name="alt_mobile"
           value="<?= set_value('alt_mobile'); ?>">
</div>

<div class="form-group col-md-6">
    <label>Email Address <span class="text-danger">*</span></label>
    <input type="email"
           class="form-control"
           name="email"
           value="<?= set_value('email'); ?>"
           required>
</div>

<div class="form-group col-md-6">
    <label>ID Proof</label>
    <input type="file"
           class="form-control"
           name="id_proof"
           accept=".jpg,.jpeg,.png,.pdf">
<small class="text-muted">
    Upload any valid government-issued ID.
</small>
</div>

<div class="form-group col-12">
    <label>Address <span class="text-danger">*</span></label>
    <textarea style="min-height:70px;" name="address"
              rows="3"
              class="form-control style3"
              required><?= set_value('address'); ?></textarea>
</div>

<div class="form-group col-md-6">
    <label>Vehicle Number</label>
    <input type="text"
           class="form-control"
           name="vehicle_number"
           value="<?= set_value('vehicle_number'); ?>">
</div>

<div class="form-group col-md-3">
    <label>No of Guests <span class="text-danger">*</span></label>
    <input type="number"
           class="form-control"
           name="no_of_guests"
           value="<?= set_value('no_of_guests'); ?>"
           min="1" required>
</div>

<div class="form-group col-md-3">
    <label>No of Nights <span class="text-danger">*</span></label>
    <input type="number"
           class="form-control"
           name="no_of_nights"
           value="<?= set_value('no_of_nights'); ?>"
           min="1" required>
</div>

<div class="form-group col-md-12">
    <label>Remarks / Special Requests</label>
    <textarea style="min-height:70px;" name="remarks"
              rows="3"
              class="form-control style3"><?= set_value('remarks'); ?></textarea>
</div>
                    <div class="contact-btn col-12 text-center">
                        <button class="as-btn shadow-none" type="submit">
                            Submit Registration
                        </button>
                    </div>

                </div>

                <?= form_close(); ?>

            </div>
        </div>

    </div>
</div>


<script>

$(document).on('input', '.mobile-number', function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 10);
});

</script>

<?php $this->load->view('footer'); ?>
