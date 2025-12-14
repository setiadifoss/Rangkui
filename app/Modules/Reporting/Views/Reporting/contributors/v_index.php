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

    <form action="<?= site_url('report/contributors/filter'); ?>" method="post" id="frm-filter">
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
                    <label class="control-label col-md-4 col-sm-4 ">Contributor Name</label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" class="form-control" name="contributor_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Contributor Type</label>
                    <div class="col-md-8 col-sm-8 ">
                        <select name="contributor_type[]" id="contributor_type" class="form-control select2" data-placeholder="--Contributor Type--" multiple="multiple">
                            <option></option>
                            <option value="1">Contributor</option>
                            <option value="3">Editor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Item Type</label>
                    <div class="col-md-8 col-sm-8 ">
                        <select name="item[]" id="item" class="form-control select2" data-placeholder="--item Type--" multiple="multiple">
                            <option></option>
                            <?php foreach ($list_item as $val): ?>
                                <option value="<?= $val->item_type_id; ?>"><?= $val->item_type_name; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-4 col-sm-4 ">Subject</label>
                    <div class="col-md-8 col-sm-8 ">
                        <input type="text" class="form-control" name="subject">
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
            <table class="table table-bordered " id="contributors-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Item Type</th>
                        <th>Subject</th>
                        <th>Contributor</th>
                        <th>Years</th>
                    </tr>
                </thead>
                <tbody id="tbody-data">
                    <?php
                    $i = 1;
                    foreach ($contributor_report as $val): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $val->title; ?></td>
                            <td><?= $val->item_type_name; ?></td>
                            <td><?= $val->topic; ?></td>
                            <td><?= $val->contributor_name; ?></td>
                            <td><?= $val->publish_year; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>