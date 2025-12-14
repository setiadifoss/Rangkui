<div class="x_panel">
    <div class="x_title">
        <h2>Content</h2>
        <div class="text-right">
            <a href="<?= base_url('sistem/konten/add'); ?>" class="btn btn-sm text-white btn-primary"><i class="fa fa-plus"></i> Add New Data</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-md-12">
                <table class="table responsive table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Content Title</th>
                            <th>Path</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($list_konten as $key => $val) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $val->content_title; ?></td>
                                <td><?= $val->content_path; ?></td>
                                <td><?= $val->last_update; ?></td>
                                <td>
                                    <a href="<?= base_url('sistem/konten/edit/' . $val->content_id); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $val->content_id ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>