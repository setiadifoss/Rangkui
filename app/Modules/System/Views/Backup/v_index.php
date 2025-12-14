<div class="x_panel">
    <div class="x_title">
        <h2>Backup Data</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <button class="btn btn-sm btn-primary" onclick="moveTo('<?= base_url('sistem/backups/add') ?>')">
                    <img src="<?= base_url('assets/custom/images/backup-solid.svg'); ?>" alt=""> Add New Backup
                </button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <table class="table responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Backup Executor</th>
                        <th>Backup Time</th>
                        <th>Backup File Location</th>
                        <th>File Size</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($list_backup as $key => $val):
                        $file_size = 0;
                        $file_path = $val->backup_file;

                        if (file_exists($file_path)) {
                            $file_size = filesize($file_path);
                        }
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->realname; ?></td>
                            <td><?= $val->backup_time; ?></td>
                            <td><?= $val->backup_file; ?></td>
                            <td>
                                <a href="<?= base_url("sistem/backups/download/{$val->backup_log_id}") ?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-database" aria-hidden="true"></i> <?= formatSizeUnits($file_size); ?>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>