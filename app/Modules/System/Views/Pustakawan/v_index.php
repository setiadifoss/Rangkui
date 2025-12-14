<!-- Form dan tabel data -->
<div class="x_panel">
    <div class="x_title">
        <h2>Konten</h2>
        <div class="text-right">
            <a href="<?= base_url('sistem/pustakawan/add'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambahkan Pengguna Baru</a>
        </div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <table class="table responsive table-striped table-bordered table-hover dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Asli</th>
                        <th>Nama Masuk Pengguna</th>
                        <th>Tipe Keanggotaan</th>
                        <th>Terakhir Kali Masuk</th>
                        <th>Perubahan Terakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($user as $key => $val):
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->realname; ?></td>
                            <td><?= $val->username; ?></td>
                            <td><?= getTypeUser($val->user_type); ?></td>
                            <td><?= $val->last_login; ?></td>
                            <td><?= $val->last_update; ?></td>
                            <td>
                                <a href="<?= base_url('sistem/pustakawan/edit/' . $val->user_id); ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="showConfirm(<?= $val->user_id ?>)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>
</div>