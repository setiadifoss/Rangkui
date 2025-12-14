<div class="x_panel">
    <div class="x_title">
        <h2>Statistic Collection</h2>
        <!-- <ul class="nav navbar-right panel_toolbox">
            <li><button type="button" class="btn btn-sm btn-primary" onclick="showModal()"><i class="fa fa-plus"></i> GMD Baru</button></li>
        </ul> -->
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2" class="bg-dark text-white">Summary Statistic Collection</td>
                </tr>
                <tr>
                    <td>Total Title</td>
                    <td>
                        <?= $biblio_total; ?> (including titles that still don't have items yet)
                    </td>
                </tr>
                <tr>
                    <td>Total Title from Media/GMD</td>
                    <td>
                        <ul>
                            <?php foreach ($stats->getResult() as $key => $val) : ?>
                                <li> <?= $val->gmd_name; ?> : <?= $val->total_titles; ?></li>
                            <?php endforeach ?>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-12 col-md-12 col-sm-12">
            <div id="pie-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</div>