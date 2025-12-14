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

    <form action="<?= site_url('report/staff-activity/filter'); ?>" method="post" id="frm-filter">
        <div class="x_content">
            <div class="form-group row">
                <label class="control-label col-md-4 col-sm-4 ">Activity From</label>
                <div class="col-md-8 col-sm-8 ">
                    <input type="date" class="form-control" name="act_from" value="2000-01-01">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-4 col-sm-4 ">Activity To</label>
                <div class="col-md-8 col-sm-8 ">
                    <input type="date" class="form-control" name="act_to" value="<?= date("Y-m-d"); ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-sm-8  offset-md-4">
                    <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="x_panel">
    <div class="x_title">
        <h2>Staff Activity</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="table-responsive">
            <table class="table table-bordered table-button">
                <thead>
                    <tr>
                        <th>Real Name</th>
                        <th>User Login</th>
                        <th>Bibliograph Entry</th>
                        <th>Exemplar/ Copy Entry</th>
                        <th>Member Entry</th>
                        <th>Circulation Task</th>
                    </tr>
                </thead>
                <tbody id="tbody-data">
                    <?php foreach ($list_report->getResult() as $val):  ?>
                        <tr>
                            <td><?= $val->realname; ?></td>
                            <td><?= $val->username; ?></td>
                            <td><?= $val->biblio_total; ?></td>
                            <td><?= $val->item_total; ?></td>
                            <td><?= $val->member_total; ?></td>
                            <td><?= $val->circulation_total; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="col-12 col-md-12 col-sm-12">
            <div id="pie-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</div>