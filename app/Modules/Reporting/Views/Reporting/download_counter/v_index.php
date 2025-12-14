<div class="x_panel">
    <div class="x_title">
        <h2>Count Number of Downloads</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><button onclick="moveTo('<?= base_url('export/download-counter') ?>')" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Excel</button></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-button table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Title</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $key => $value) :
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $value->title ?></td>
                                <td>
                                    <table cellspacing="0" width="100%">
                                        <thead style="background-color: #2A3F54;color: #fff;">
                                            <tr>
                                                <th style="padding: .3px;" class="text-center">File Name</th>
                                                <th style="padding: .3px;" class="text-center">Downloads</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($value->attachment as $attachment): ?>
                                                <tr>
                                                    <td style="padding: .3px;"><?= $attachment->file_name  ?> </td>
                                                    <td style="padding: .3px;" class="text-right text-<?= $attachment->count > 0 ? "success" : "danger" ?>"><?= $attachment->count  ?> downloaded</td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>