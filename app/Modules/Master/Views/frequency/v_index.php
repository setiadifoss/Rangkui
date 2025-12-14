<div class="x_panel">
    <div class="x_title">
        <h2>List of Frequencies</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> Add New Frequency</button></li>
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
                            <th>Frequency</th>
                            <th>Language</th>
                            <th>Interval</th>
                            <th>Time Unit</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $key => $value) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->frequency ?></td>
                                <td><?= $value->language_prefix ?></td>
                                <td><?= $value->time_increment ?></td>
                                <td><?= $value->time_unit ?></td>
                                <td><?= $value->last_update ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $value->frequency_id ?>)"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title" id="myModalLabel">New Frequency</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('master/frequency/save') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="frequency">Frequency*</label>
                        <input type="text" class="form-control" name="frequency" id="frequency" value="" maxlength="25" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="language_prefix">Language</label>
                        <select name="language_prefix" id="language_prefix" class="form-control" required>
                            <option value="id">Indonesia</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time_increment">Interval*</label>
                        <input type="number" class="form-control" name="time_increment" id="time_increment" value="" min="0" max="999999" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="time_unit">Time Unit</label>
                        <select name="time_unit" id="time_unit" class="form-control" required>
                            <option value="day">Hari</option>
                            <option value="week">Minggu</option>
                            <option value="month">Bulan</option>
                            <option value="year">Tahun</option>
                        </select>
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