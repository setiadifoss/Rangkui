<div class="x_panel">
    <div class="x_title">
        <h2>List of Locations</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> Add New Location</button></li>
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
                            <th>Location Code</th>
                            <th>Location Name</th>
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
                                <td><?= $value->location_id ?></td>
                                <td><?= $value->location_name ?></td>
                                <td><?= $value->last_update ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm('<?= $value->location_id ?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title" id="myModalLabel">New Location</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('master/location/save') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="location_id">Location Code*</label>
                        <input type="text" class="form-control" name="location_id" id="location_id" value="" maxlength="3" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="location_name">Location Name*</label>
                        <input type="text" class="form-control" name="location_name" id="location_name" value="" maxlength="100" tabindex="1" required>
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