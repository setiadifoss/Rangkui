<div class="x_panel">
    <div class="x_title">
        <h2>List of Supervisors</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> Add New Supervisor</button></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-md-12">
                <table class="table responsive table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Supervisor Name</th>
                            <th>Supervisor Code</th>
                            <th>Type of Supervisor</th>
                            <th>Supervisor File</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $key => $value) :
                            if ($value->supervisor_type == 'p') {
                                $type = 'Nama Orang';
                            } elseif ($value->supervisor_type == 'o') {
                                $type = 'Badan Organisasi';
                            } elseif ($value->supervisor_type == 'c') {
                                $type = 'Konferensi';
                            } else {
                                $type = '-';
                            }

                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->supervisor_name ?></td>
                                <td><?= $value->supervisor_number ?></td>
                                <td><?= $type ?></td>
                                <td><?= $value->supervisor_list ?></td>
                                <td><?= $value->last_update ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $value->supervisor_id ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modal_action" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">New Supervisor</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('master/supervisor/save') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="superName">Supervisor Name*</label>
                        <input type="text" class="form-control" name="superName" id="superName" value="" maxlength="100" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="supervisorNumber">Supervisor Code*</label>
                        <input type="number" class="form-control" name="supervisorNumber" id="supervisorNumber" value="" maxlength="100" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="supervisorYear">Year of Birth</label>
                        <input type="number" class="form-control" name="supervisorYear" id="supervisorYear" value="" min="1900" max="<?= date('Y') ?>" tabindex="1">
                    </div>
                    <div class="form-group">
                        <label for="supervisorType">Supervisor Type</label>
                        <select name="supervisorType" id="supervisorType" class="form-control">
                            <option value="p">Nama Orang</option>
                            <option value="o">Badan Organisasi</option>
                            <option value="c">Konferensi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supervisorList">File Supervisor</label>
                        <input type="text" class="form-control" name="supervisorList" id="supervisorList" value="" maxlength="20" tabindex="1">
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