<!-- Form Title -->
<div class="x_panel">
    <div class="x_title">
        <h2>Form Tambah Modul</h2>
        <div class="clearfix"></div>
    </div>

    <form class="form-horizontal form-label-left" action="<?= base_url('sistem/modul/save'); ?>" method="post" onsubmit="return confirm('Apakah anada yakin ingin menambah modul ini ?')" id="frm-main">
        <?= csrf_field(); ?>
        <!-- Form Body -->
        <div class="x_content">
            <div class="form-group row ">
                <label class="control-label col-md-3 col-sm-3 ">Nama Modul <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 ">Icon Modul <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <select id="iconSelect" name="icon" style="width: 200px;" class="form-control-sm" data-placeholder="--PIlih Icon Modul--">
                        <option></option>
                        <?php foreach ($list_icon as $key => $val): ?>
                            <option value="<?= $val->class_name; ?>"><?= $val->icon_name; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="icon-preview" id="iconPreview"></span>
                </div>
            </div>

            <div class="form-group-row">
                <label class="control-label col-md-3 col-sm-3 ">Deskripsi Modul <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <textarea name="desc" class="form-control" rows="3"></textarea>
                </div>
            </div>

        </div>
        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>