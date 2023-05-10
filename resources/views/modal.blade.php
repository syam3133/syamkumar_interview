



<script type="text/javascript">
	
	function showAjaxModal(url) {
	
		// SHOWING AJAX PRELOADER IMAGE
		jQuery( '#modal_ajax .modal-body' ).html('<label>loading.....<label>'); 
		// LOADING THE AJAX MODAL
		jQuery( '#modal_ajax' ).modal( 'show', {
			backdrop: 'true'
		} );
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax( {
			url: url,
			success: function ( response ) {
				$('.modal-body').html(response);
			}
		} );
	}

</script>


<div class="modal fade" id="modal_ajax" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Title</h5>
										<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span> -->
										</button>
									</div>
									<div class="modal-body">
										
									</div>
									<!-- <div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-light">Save changes</button>
									</div> -->
								</div>
							</div>
						</div>





<div class="modal" tabindex="-1" role="dialog" id="delete_modals">
<div class="modal-dialog modal-dialog-centered"  role="document">
  <div class="modal-content">
	<div class="modal-header" style="background: #d2322d;text-align:center;">
	 <h5 class="modal-title" style="color: #ffffff"><b>Delete</b></h5>
	</div>
	<div class="modal-body" style="background: #000000">
			<div class="modal-wrapper">
			<div class="modal-icon" style="color:#d2322d ">
			<i class="fas fa-times-circle" style="color:#d2322d "></i>
			</div>
			<div class="modal-text" style="color: #000">
			<h4>Are you sure want to delete?</h4>
			<p style="color: #fff!important;">If you go with DELETE,the data will permanently erase from database </p>
			</div>
			</div>
			</div>
	<div class="modal-footer">
		<a href="javascript:;" class="btn btn-primary conf_true" id="conf_true">Delete </a>
		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	</div>
  </div>
</div>
</div>