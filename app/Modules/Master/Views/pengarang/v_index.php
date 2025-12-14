<div class="x_panel">
    <div class="x_title">
        <h2>List of Authors</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> Add New Author</button></li>
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
                            <th>Author Name</th>
                            <th>Year of Birth</th>
                            <th>Type of Authorship</th>
                            <th>Controlled List</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $key => $value) :
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->author_name ?></td>
                                <td><?= $value->author_year ?></td>
                                <td><?= authority_type($value->authority_type) ?></td>
                                <td><?= $value->auth_list ?></td>
                                <td><?= $value->last_update ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick='showModal(<?= json_encode($value) ?>)'><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $value->author_id ?>)"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title" id="myModalLabel">New Author</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('master/pengarang/save') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="authorName">Author Name*</label>
                        <input type="text" class="form-control" name="authorName" id="authorName" value="" maxlength="100" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="authorYear">Year of Birth</label>
                        <input type="number" class="form-control" name="authorYear" id="authorYear" value="" min="1900" max="<?= date('Y') ?>" tabindex="1">
                    </div>
                    <div class="form-group">
                        <label for="authorityType">Type of Authorship</label>
                        <select name="authorityType" id="authorityType" class="form-control">
                            <option value="p">Personal Name</option>
                            <option value="o">Organization Body</option>
                            <option value="c">Conference</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="authList">Controlled List</label>
                        <input type="text" class="form-control" name="authList" id="authList" value="" maxlength="20" tabindex="1">
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