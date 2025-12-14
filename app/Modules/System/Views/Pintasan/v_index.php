<div class="x_panel">
    <div class="x_title">
        <h2>Pintasan Modul </h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">

        <form action="" class="inline-form">
            <div class="form-group">
                <label for="default_lang">Modul</label>
                <select name="modul" id="modul" class="form-control select2" data-placeholder="-Pilih Modul-">
                    <option></option>
                    <?php foreach ($menu as $key => $val): ?>
                        <option value="<?= $val->id; ?>"><?= formatString($val->title); ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </form>

        <div id="append-here"></div>
    </div>
</div>

<?php if (trim($sc->setting_value) !== ""): ?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Pintasan Terpasang </h2>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="alert alert-info alert-dismissible text-white" role="alert">
                Daftar Pemintas Terpasang (Untuk menghapus pemintas, hilangkan centang lalu klik tombol 'Hapus pemintas terpilih')
            </div>
            <form action="<?= base_url('sistem/pintasan/delete'); ?>" class="inline-form" method="post" onsubmit="return confirm('Apakah anda yakin ingin menghapus pintasan ini?')">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                            $list_sc = unserialize($sc->setting_value);
                            foreach ($list_sc as $k => $v): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="sub_list[]" value="<?= $v->id; ?>" checked> <?= $v->title; ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-danger">Hapus Pintasan</button>
                </div>
            </form>
        </div>
    </div>
<?php endif ?>