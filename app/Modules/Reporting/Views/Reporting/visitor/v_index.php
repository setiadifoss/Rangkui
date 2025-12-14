<div class="x_panel">
    <div class="x_title">
        <h2>Daftar Pengunjung</h2>
        <div class="clearfix"></div>
    </div>

    <?php
    $list_option = [
        (object)[
            'name' => 'all',
            'text'  => 'Semua',
        ],
        (object)[
            'name' => 'member',
            'text'  => 'Standard',
        ],
        (object)[
            'name' => 'nonmember',
            'text'  => 'Pengunjung bukan anggota',
        ]
    ];

    ?>

    <div class="x_content">
        <div class="row">
            <div class="col-md-12">
                <h3>Filter</h3>
                <form action="">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" style="font-size: 1.2em;">Tipe Keanggotaan</label>
                        </div>
                        <div class="col-md-7">
                            <select name="filter" id="filter-type" onchange="withFilter(this)" class="form-control select2" data-placeholder="-- Pilih Tipe Keanggotaan -- ">
                                <option value=""></option>
                                <?php foreach ($list_option as $val) : ?>
                                    <option value="<?= $val->name; ?>"><?= $val->text ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="" style="font-size: 1.2em;">Tanggal Kunjungan</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="filter-start-date" onchange="withFilter(this)" name="start_date">
                        </div>
                        <div class="col-md-1">
                            <div class="text-center">Hingga</div>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="filter-end-date" onchange="withFilter(this)" name="end_date">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered responsive-0" id="reportTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Anggota</th>
                            <th>Nama Pengunjung</th>
                            <th>Tipe Keanggotaan</th>
                            <th>Institusi</th>
                            <th>Tanggal Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>