<div class="x_panel">
    <div class="x_title">
        <h2>Bibliography</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <button onclick="moveTo('<?= base_url('bibliography/add') ?>')" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>&nbsp;Add New Bibliography</button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table class="table table-button table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Published Year</th>
                    <th>Last Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data as $val) :
                ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $val->title ?></td>
                        <td><?= $val->publish_year; ?></td>
                        <td><?= $val->last_update ?></td>
                        <td class="btn-group">
                            <a class="btn btn-sm btn-primary" href="<?= base_url("bibliography/edit/?bbi=" . slim_encrypt($val->biblio_id)) ?>">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $val->biblio_id ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
