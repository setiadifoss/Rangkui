<div class="x_panel">
    <div class="x_title">
        <h2>ETD Index</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li>
                <button onclick="moveTo('<?= base_url('sistem/indeks-biblio/delete'); ?>', 'Are you sure, want to empty index ?')" class="btn btn-sm text-white btn-danger" ">
                    <i class=" fa fa-trash"></i> Empty Index
                </button>
            </li>
            <li>
                <button onclick="moveTo('<?= base_url('sistem/indeks-biblio/add'); ?>')" class="btn btn-sm text-white btn-primary">
                    <i class="fa fa-plus"></i> Re-Index
                </button>
            </li>
            <li>
                <button onclick="moveTo('<?= base_url('sistem/indeks-biblio/reindex'); ?>')" class="btn btn-sm text-white btn-info">
                    <i class="fa fa-refresh"></i> Update Index
                </button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <p>Bibliographic Index will speed up catalog search</p>
        <ul>
            <li>Total data on ETD: <?= $biblio_total; ?> records.</li>
            <li>Total indexed data: <?= $idx_total; ?> records.</li>
            <li>Unidexed data: <?= $unidx_total; ?> records.</li>
        </ul>
    </div>
</div>