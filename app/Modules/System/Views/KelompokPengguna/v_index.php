<div class="x_panel">
    <div class="x_title">
        <h2></h2>
        <div class="text-right">
            <a href="<?= base_url('sistem/user-groups/add'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New Group</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <table class="table responsive table-stripped table-hover" align="center" id="dataList">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Group Name</th>
                        <th>Last Modified</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($list_group as $key => $val): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->group_name; ?></td>
                            <td><?= date("Y-m-d H:i:s", strtotime($val->last_update)); ?></td>
                            <td>
                                <a href="<?= base_url('sistem/user-groups/edit/' . $val->group_id); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $val->group_id ?>)"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</div>