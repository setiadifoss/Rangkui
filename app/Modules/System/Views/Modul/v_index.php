<div class="x_panel">
    <div class="x_title">
        <h2>Modul</h2>
        <div class="text-right">
            <a href="<?= base_url('sistem/modul/add'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambahkan Modul Baru</a>
        </div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap responsive" id="dataList">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Modul</th>
                        <th>Deskripsi Modul</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($menu as $key => $val): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->title; ?></td>
                            <td><?= $val->desc; ?></td>
                            <td>
                                <a href="<?= base_url('sistem/modul/edit/' . $val->id); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $val->id ?>)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
</div>