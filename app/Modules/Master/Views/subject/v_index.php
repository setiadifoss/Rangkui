<div class="x_panel">
    <div class="x_title">
        <h2>Daftar Subyek</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> Subyek Baru</button></li>
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
                            <th>Nama Subyek</th>
                            <th>Kode Klasifikasi</th>
                            <th>Tipe Subyek</th>
                            <th>Daftar Terkendali</th>
                            <th>Perubahan Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $key => $value) :
                            if ($value->topic_type == 't') {
                                $type = 'Topik';
                            } elseif ($value->topic_type == 'g') {
                                $type = 'Geografis';
                            } elseif ($value->topic_type == 'n') {
                                $type = 'Nama';
                            } elseif ($value->topic_type == 'tm') {
                                $type = 'Masa';
                            } elseif ($value->topic_type == 'gr') {
                                $type = 'Aliran';
                            } elseif ($value->topic_type == 'oc') {
                                $type = 'Pekerjaan';
                            } else {
                                $type = '-';
                            }

                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->topic ?></td>
                                <td><?= $value->classification ?></td>
                                <td><?= $type ?></td>
                                <td><?= $value->auth_list ?></td>
                                <td><?= $value->last_update ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $value->topic_id ?>)"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title" id="myModalLabel">Subyek Baru</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('master/subject/save') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="topic">Nama Subyek*</label>
                        <input type="text" class="form-control" name="topic" id="topic" value="" maxlength="50" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="classification">Kode Klasifikasi*</label>
                        <input type="text" class="form-control" name="classification" id="classification" value="" maxlength="50" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="topic_type">Tipe Subyek*</label>
                        <select name="topic_type" id="topic_type" class="form-control" required>
                            <option value="t">Topik</option>
                            <option value="g">Geografis</option>
                            <option value="n">Nama</option>
                            <option value="tm">Masa</option>
                            <option value="gr">Aliran</option>
                            <option value="oc">Pekerjaan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="auth_list">Daftar Terkendali</label>
                        <input type="text" class="form-control" name="auth_list" id="auth_list" value="" maxlength="20" tabindex="1">
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