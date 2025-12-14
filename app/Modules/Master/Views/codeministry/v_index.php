<div class="x_panel">
    <div class="x_title">
        <h2>List of Ministry Code</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> Add New Ministry Code</button></li>
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
                            <th>Ministry Code</th>
                            <th>Prodi Name</th>
                            <th>Level</th>
                            <th>University</th>
                            <th>Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $key => $value) :
                            if ($value->degree == "1") {
                                $degree = "D1";
                            } elseif ($value->degree == "2") {
                                $degree = "D2";
                            } elseif ($value->degree == "3") {
                                $degree = "D3";
                            } elseif ($value->degree == "4") {
                                $degree = "D4";
                            } elseif ($value->degree == "5") {
                                $degree = "S1";
                            } elseif ($value->degree == "6") {
                                $degree = "S2";
                            } elseif ($value->degree == "7") {
                                $degree = "S3";
                            } elseif ($value->degree == "8") {
                                $degree = "Non Formal";
                            } elseif ($value->degree == "9") {
                                $degree = "Informal";
                            } elseif ($value->degree == "10") {
                                $degree = "Lainnya";
                            } elseif ($value->degree == "11") {
                                $degree = "Sp-1";
                            } elseif ($value->degree == "12") {
                                $degree = "Sp-2";
                            } elseif ($value->degree == "13") {
                                $degree = "Profesi";
                            } elseif ($value->degree == "14") {
                                $degree = "S2 Terapan";
                            } elseif ($value->degree == "15") {
                                $degree = "S3 Terapan";
                            } else {
                                $degree = '-';
                            }
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->code_ministry ?></td>
                                <td><?= $value->name_prodi ?></td>
                                <td><?= $degree ?></td>
                                <td><?= $value->university ?></td>
                                <td><?= $value->last_update ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm('<?= $value->code_ministry ?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title" id="myModalLabel">New Ministry Code</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('master/codeministry/save') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code_ministry">Ministry Code*</label>
                        <input type="text" class="form-control" name="code_ministry" id="code_ministry" value="" maxlength="20" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="name_prodi">Prodi Name*</label>
                        <input type="text" class="form-control" name="name_prodi" id="name_prodi" value="" maxlength="100" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree*</label>
                        <select name="degree" id="degree" class="form-control" required>
                            <option value="1">D1</option>
                            <option value="2">D2</option>
                            <option value="3">D3</option>
                            <option value="4">D4</option>
                            <option value="5">S1</option>
                            <option value="6">S2</option>
                            <option value="7">S3</option>
                            <option value="8">Non Formal</option>
                            <option value="9">Informal</option>
                            <option value="10">Lainnya</option>
                            <option value="11">Sp-1</option>
                            <option value="12">Sp-2</option>
                            <option value="13">Profesi</option>
                            <option value="14">S2 Terapan</option>
                            <option value="15">S3 Terapan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="university">University*</label>
                        <input type="text" class="form-control" name="university" id="university" value="" maxlength="100" tabindex="1" required>
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