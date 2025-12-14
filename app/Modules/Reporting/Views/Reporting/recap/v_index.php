<div class="x_panel">
    <div class="x_title">
        <h2>Recapitulation Report</h2>
        <div class="clearfix"></div>
    </div>

    <?php
    $list_option = [
        [
            'name' => 'gmd',
            'text'  => 'GMD',
        ],
        [
            'name' => 'coll_type',
            'text'  => 'Collection Type',
        ],
        [
            'name' => 'lang',
            'text' => 'Language'
        ]
    ];

    ?>

    <div class="x_content">
        <div class="row">
            <form action="">
                <div class="form-group">
                    <label for=""></label>
                    <select name="filter" id="filter-type" class="form-control select2" data-placeholder="-- Choose Clasification -- ">
                        <option></option>
                        <?php foreach ($list_option as $val) : ?>
                            <option value="<?= $val['name']; ?>"><?= $val['text'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered " id="recap-table">
                    <thead>
                        <tr>
                            <th>Clasification</th>
                            <th>Title</th>
                            <th>Exemplar</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>