<div class="modal fade" id="priceAddModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

<h4 class="modal-title" id="modalLabel">Add Special Price</h4>

</div>

<form method="post">

<input type="hidden" name="room_id" id="room_id_input" value="">  

<div class="modal-body">

<label>From Date</label>
<input type="date" name="date_from" min="<?= date('Y-m-d'); ?>" class="form-control" onclick="this.showPicker();" required>

<label>To Date</label>
<input type="date" name="date_to" min="<?= date('Y-m-d'); ?>" class="form-control" onclick="this.showPicker();" required>


<label>Rate</label>
<input type="number" name="rate" min="1" class="form-control" required>

</div>

<div class="modal-footer">
<button type="submit" class="btn btn-success">Add</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

</form>


</div>
</div>
</div>

<script>

 document.addEventListener("DOMContentLoaded", function(event) { 

      $('.add_rate').click(function(){

      //console.log($(this).data('id'));

      var cat_id = $(this).data('id');

      $('#priceAddModal input').val('');

      $('#room_id_input').val(cat_id);

      $('#priceAddModal').modal('show');

      })

  });

  </script>