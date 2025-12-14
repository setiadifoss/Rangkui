<div class="x_panel">
    <div class="x_title">
        <h2>Member Report</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2" class="bg-dark text-white">Statistic Member</td>
                </tr>
                <tr>
                    <td>Member Registered</td>
                    <td>
                        <?= $total_member; ?>
                    </td>
                </tr>
                <tr>
                    <td>Member Active</td>
                    <td>
                        <?= $active_member; ?>
                    </td>
                </tr>
                <tr>
                    <td>Member Expired</td>
                    <td>
                        <?= $expired_member; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-12 col-md-12 col-sm-12">
            <div id="pie-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
</div>