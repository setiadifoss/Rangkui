<div class="x-panel">
    <div class="x_title">
        <h2>Daftar Keanggotaan</h2>
        <ul class="nav navbar-right panel_toolbox">
            <div class="btn-group">
                <li><a href="<?= base_url('membership/add') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Tambah Anggotan Baru</a></li>
                <li> <a href="<?= base_url('membership/xmember') ?>" class="btn btn-sm btn-danger "><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Lihat Anggota yang Kedaluwarsa</a></li>
            </div>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="table-responsive">
            <table class="table responsive table-striped table-bordered dt-responsive">
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
                            <td align="center"> <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div id="modal_action" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('membership/updateExp') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exp_date">Expired Date*</label>
                        <input type="date" class="form-control" name="exp_date" id="exp_date" value="" required>
                    </div>
                    <span class="hidden"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>