<!-- Form Title -->
<div class="x_panel">
    <div class="x_title">
        <h2>User Group Form</h2>
        <div class="clearfix"></div>
    </div>

    <form name="frm-main" id="frm-main" class="form-horizontal form-label-left" method="post" action="<?= base_url('sistem/user-groups/update'); ?>" onsubmit="return confirm('Apakah anda yakin ingin mengubah kelompok?')">
        <?= csrf_field(); ?>
        <input type="hidden" name="w_id" value="<?= $list_kelompok[0]->group_id; ?>">
        <div class="x_content">
            <!-- Form Fields -->
            <div class="form-group row">
                <label for="userName" class="control-label col-md-3 col-sm-3 col-xs-12">Group Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12" placeholder="Masukkan nama kelompok" value="<?= $list_kelompok[0]->group_name; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="userName" class="control-label col-md-3 col-sm-3 col-xs-12">Privillege</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th class="text-center">Read</th>
                                <th class="text-center">Write</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_menu as $val): ?>
                                <tr>
                                    <td>
                                        <i class="fa <?= $val->icon ?>"></i> <?= $val->title; ?>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="read[]" value="<?= $val->id; ?>"
                                            <?= in_array($val->id, array_column($list_kelompok, 'module_id')) && array_column($list_kelompok, 'r', 'module_id')[$val->id] == 1 ? 'checked' : '' ?>>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="write[]" value="<?= $val->id; ?>"
                                            <?= in_array($val->id, array_column($list_kelompok, 'module_id')) && array_column($list_kelompok, 'w', 'module_id')[$val->id] == 1 ? 'checked' : '' ?>>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>

</div>