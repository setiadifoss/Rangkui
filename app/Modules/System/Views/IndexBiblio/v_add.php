<div class="x_panel">
    <div class="x_title">
        <h2>Add New Index</h2>
        <div class="clearfix"></div>
    </div>
    <form action="<?= base_url('sistem/indeks-biblio/save'); ?>" method="post" class="form-horizontal form-label-left">
        <div class="x_content">
            <?= csrf_field(); ?>

            <div class="form-group row ">
                <label class="control-label col-md-3 col-sm-3 ">Index Type <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <select name="index_type" id="index_type" class="form-control select2" data-placeholder="--Choose index type--">
                        <option></option>
                        <option value="mysql">MySQL</option>
                        <option value="nosql">MongoDB</option>
                    </select>
                    <span id="message"></span>
                </div>
            </div>
        </div>
        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-add" disabled>Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>