<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-notify modal-danger" role="document">
            <!--Content-->
            <form method="POST" id="form-delete">
                @csrf
                <div class="modal-content">
                    <!--Body-->
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="far fa-times-circle fa-8x text-danger mb-3"></i>
                            <h4>Are you sure you want to remove this data?</h4>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <input type="hidden" id="delete-id" value="">
                        <input type="hidden" id="delete-action" name="delete-action">
                        <button type="submit" id="ok-button" class="btn btn-danger">Remove</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
            <!--/.Content-->
        </div>
    </div>

    <div id="success" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="far fa-check-circle fa-8x text-success mb-3"></i>
                        <h4 class="modal-title">Awesome!</h4>
                    </div>
                    <p class="text-center" id="success_content">Your booking has been confirmed. Check your email for
                        detials.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>