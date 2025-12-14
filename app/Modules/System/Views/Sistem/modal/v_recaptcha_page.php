<div id="keyCaptcha" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Recaptcha V2</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <form class="form-horizontal form-label-left" action="sistem/pengaturan-sistem/update-key" id="frm-captcha" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <!-- Publickey Field -->
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="publickey">Public Key</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="publickey" name="publickey" class="form-control" value="<?= $publicKey; ?>" autofocus>
                        </div>
                    </div>

                    <!-- Privatekey Field -->
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="privatekey">Private Key</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" id="privatekey" name="privatekey" class="form-control" value="<?= $privateKey; ?>">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="save" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>