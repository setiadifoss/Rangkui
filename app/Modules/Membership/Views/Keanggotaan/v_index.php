<div class="x-panel">
    <div class="x_title">
        <h2>List Membership</h2>
        <ul class="nav navbar-right panel_toolbox">
            <div class="btn-group">
                <li><a href="<?= base_url('membership/add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Add New Member</a></li>
                <li> <a href="<?= base_url('membership/xmember') ?>" class="btn btn-sm btn-danger "><i class="glyphicon glyphicon-list-alt"></i>&nbsp;View Expired Members</a></li>
            </div>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="table-responsive">
            <table class="table table-button table-striped table-bordered dt-responsive">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Membership Type</th>
                        <th>Email</th>
                        <th>Last Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $value): ?>
                        <tr>
                            <td><?= $value->member_id ?></td>
                            <td><?= $value->member_name ?></td>
                            <td><?= $value->member_type_name ?></td>
                            <td><?= $value->member_email ?></td>
                            <td><?= $value->last_update ?></td>
                            <td align="center">
                                <a href="<?= base_url("membership/edit/?mi={$value->member_id}") ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                <form action="<?= base_url("membership/delete") ?>" method="post" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="mi" value="<?= $value->member_id ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this member?')"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
