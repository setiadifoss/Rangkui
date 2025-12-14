<div class="x_panel">
    <div class="x_title">
        <h2>Catatan Sistem</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="text-right">
            <button class="btn btn-sm btn-danger" onclick="moveTo('<?= base_url('sistem/logs/delete') ?>', 'Are you sure, want to empty system log ?' )">
                <i class="fa fa-trash"></i> Hapus Catatan
            </button>
            <button class="btn btn-sm btn-primary" onclick="moveTo('<?= base_url('sistem/logs/save') ?>')">
                <i class="fa fa-download"></i> Simpan Catatan ke Dalam Berkas
            </button>
        </div>
        <div class="table-responsive">
            <table class="table responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="15%">Lokasi</th>
                        <th width="10%">Waktu</th>
                        <th>Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($list_logs as $key => $val): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->log_location; ?></td>
                            <td><?= date("Y-m-d H:i:s", strtotime($val->log_date)); ?></td>
                            <td><?= $val->log_msg; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>