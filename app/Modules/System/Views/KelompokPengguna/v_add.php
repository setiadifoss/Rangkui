<!-- Form Title -->
<div class="x_panel">
    <div class="x_title">
        <h2>User Group Form</h2>
        <div class="clearfix"></div>
    </div>

    <form name="frm-main" id="frm-main" class="form-horizontal form-label-left" method="post" action="<?= base_url('sistem/user-groups/save'); ?>" onsubmit="return confirm('Are you sure you want to add a new group?')">
        <?= csrf_field(); ?>
        <div class="x_content">
            <!-- Form Fields -->
            <div class="form-group row">
                <label for="userName" class="control-label col-md-3 col-sm-3 col-xs-12">Group Name<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12" placeholder="Masukkan nama kelompok">
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
                            <?php foreach ($list_menu as $key => $val): ?>
                                <tr>
                                    <td>
                                        <i class="fa <?= $val->icon ?>"></i> <?= $val->title; ?>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="read[]" value="<?= $val->id; ?>">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" name="write[]" value="<?= $val->id; ?>">
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>

</div>