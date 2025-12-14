<!-- Form Title -->
<div class="x_panel">
    <div class="x_title">
        <h2>Form Tambah Modul</h2>
        <div class="clearfix"></div>
    </div>

    <form class="form-horizontal form-label-left" action="<?= base_url('sistem/modul/update'); ?>" method="post" onsubmit="return confirm('Apakah anada yakin ingin mengubah modul ini ?')" id="frm-main">
        <?= csrf_field(); ?>
        <input type="hidden" name="w_id" value="<?= $list_menu->id; ?>">
        <!-- Form Body -->
        <div class="x_content">
            <div class="form-group row ">
                <label class="control-label col-md-3 col-sm-3 ">Nama Modul <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <input type="text" class="form-control" name="title" value="<?= $list_menu->title; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 ">Icon Modul <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <select id="iconSelect" name="icon" style="width: 200px;" class="form-control-sm" data-placeholder="--PIlih Icon Modul--">
                        <option></option>
                        <?php foreach ($list_icon as $key => $val): ?>
                            <option value="<?= $val->class_name; ?>" <?= ($list_menu->icon == $val->class_name) ? "selected" : ""; ?>><?= $val->icon_name; ?></option>
                        <?php endforeach ?>
                    </select>
                    <span class="icon-preview" id="iconPreview"><i class="<?= $list_menu->icon; ?>"></i></span>
                </div>
            </div>

            <div class="form-group-row">
                <label class="control-label col-md-3 col-sm-3 ">Deskripsi Modul <span class="text-danger">*</span></label>
                <div class="col-md-9 col-sm-9 ">
                    <textarea name="desc" class="form-control" rows="3"><?= $list_menu->desc; ?></textarea>
                </div>
            </div>

        </div>
        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                </div>
            </div>
        </div>
    </form>
</div>