<div class="x_panel">
    <div class="x_title">
        <h2>Filter Report</h2>
        <ul class="nav navbar-right panel_toolbox" style="min-width: 0;">
            <li>
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <form action="<?= site_url('report/titles/filter'); ?>" method="post" id="frm-filter">
        <div class="x_content">
            <div class="form-group row ">
                <label class="control-label col-md-4 col-sm-4 ">Title </label>
                <div class="col-md-8 col-sm-8 ">
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            <div id="show-more" style="display: none;">
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Author</label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" class="form-control" name="author">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Classification</label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" class="form-control" name="classification">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">GMD</label>
                    <div class="col-md-8 col-sm-8 ">
                        <select name="gmd[]" id="gmd" class="form-control select2" data-placeholder="--GMD Type--" multiple="multiple">
                            <option></option>
                            <?php foreach ($list_gmd as $key => $val) : ?>
                                <option value="<?= $val['gmd_id']; ?>"><?= $val['gmd_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Collection Type</label>
                    <div class="col-md-8 col-sm-8 ">
                        <select name="coll_type[]" id="coll_type" class="form-control select2" data-placeholder="--Collection Type--" multiple="multiple">
                            <option></option>
                            <?php foreach ($list_coll as $key => $val) : ?>
                                <option value="<?= $val['coll_type_id']; ?>"><?= $val['coll_type_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Languages</label>
                    <div class="col-md-8 col-sm-8 ">
                        <select name="lang" id="lang" class="form-control select2" data-placeholder="--Languages--">
                            <option></option>
                            <?php foreach ($list_lang as $key => $val) : ?>
                                <option value="<?= $val['language_id']; ?>"><?= $val['language_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Location</label>
                    <div class="col-md-8 col-sm-8 ">
                        <select name="loc" id="loc" class="form-control select2" data-placeholder="--Locations--">
                            <option></option>
                            <?php foreach ($list_loc as $key => $val) : ?>
                                <option value="<?= $val['location_id']; ?>"><?= $val['location_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-sm-8  offset-md-4">
                    <button type="button" class="btn btn-sm btn-primary" id="adv-filter">Advanced filter</button>
                    <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="x_panel">
    <div class="x_title"></div>
    <div class="x_content">
        <div class="table-responsive">
            <table class="table table-bordered " id="titles-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>GMD</th>
                        <th>Title</th>
                        <th>Publication Place</th>
                        <th>Publisher</th>
                        <th>Endorsment Date</th>
                        <th>Call Number</th>
                    </tr>
                </thead>
                <tbody id="titles-data">
                    <?php $i = 1;
                    foreach ($title_report as $val): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->gmd_name; ?></td>
                            <td>
                                <?= $val->title; ?>
                                <p><i><?= $val->authors; ?></i></p>
                            </td>
                            <td><?= $val->place_name; ?></td>
                            <td><?= $val->publisher_name; ?></td>
                            <td>
                                <?php if (!empty($val->isbn_issn)): ?>
                                    <?= date("Y-m-d", strtotime($val->isbn_issn)); ?>
                                <?php endif ?>
                            </td>
                            <td><?= $val->call_number; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>