<!-- Form Title -->
<div class="x_panel">
    <div class="x_title">
        <h2>Add Content Form</h2>
        <div class="clearfix"></div>
    </div>

    <form class="form-horizontal form-label-left" method="post" action="<?= site_url('sistem/konten/save'); ?>">
        <?= csrf_field(); ?>
        <!-- Form Body -->
        <div class="x_content">
            <div class="form-group row ">
                <label class="control-label col-md-3 col-sm-3 ">Content Title<span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <input type="text" class="form-control" required name="content_title">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 ">Path <i>(Must Unique)</i> <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <input type="text" class="form-control" required name="content_path">
                </div>
            </div>

            <div class="form-group-row">
                <label class="control-label col-md-3 col-sm-3 ">content Description <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <textarea name="content_desc" id="editor" class="form-control editor-wrapper" required></textarea>
                </div>
            </div>



        </div>
        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>