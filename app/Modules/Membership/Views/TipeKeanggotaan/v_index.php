<div class="x_panel" style="margin-top: 40px;">
    <div class="x_title">
        <h2>Membership Type</h2>
        <ul class="nav navbar-right panel_toolbox">
            <div class="btn-group">
                <li><button onclick="moveTo('<?= base_url('membership/addtype') ?>')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Add New Membership</button></li>
            </div>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div id="x_content">
        <div class="x_content">
            <table class="table responsive table-striped table-bordered dt-responsive">
                <thead>
                    <tr>
                        <th>Membership Type</th>
                        <th>Loan Amount</th>
                        <th>Membership Duration (In Days)</th>
                        <th>Number of Renewals</th>
                        <th>Last Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $value): ?>
                        <tr>
                            <td><?= $value->member_type_name ?></td>
                            <td><?= $value->loan_limit ?></td>
                            <td><?= $value->member_periode ?></td>
                            <td><?= $value->reborrow_limit ?></td>
                            <td><?= $value->last_update ?></td>
                            <td align="center"><a class="btn btn-sm btn-info" href="<?= base_url("membership/edittype/?mt={$value->member_type_id}") ?>" title="Edit"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>