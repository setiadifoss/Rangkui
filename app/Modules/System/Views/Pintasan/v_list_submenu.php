<form action="<?= site_url('sistem/pintasan/add'); ?>" method="post" id="frm-main" onsubmit="return confirm('Apakah anda ingin menyimpan pintasan?')">
    <?= csrf_field(); ?>
    <div class=" accordion" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        foreach ($tree as $key => $val) :
            $slug = str_replace(" ", "-", strtolower($val["title"]));
        ?>
            <div class="panel">
                <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#<?= $slug ?>" aria-expanded="true" aria-controls="<?= $slug; ?>">
                    <h4 class="panel-title"><?= formatString($val["title"]); ?></h4>
                </a>
                <div id="<?= $slug; ?>" class="panel-collapse in collapse show" role="tabpanel" aria-labelledby="headingOne" style="">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tbody>
                                <?php foreach ($val["children"] as $k => $v): ?>
                                    <tr>
                                        <td>
                                            <input
                                                type="checkbox"
                                                name="sub_list[]"
                                                value="<?= $v["id"]; ?>"
                                                <?= in_array($v["title"], $list_sc)     ? "checked" : "" ?>> <?= $v["title"]; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-sm" type="submit">
            Simpan
        </button>
    </div>
</form>