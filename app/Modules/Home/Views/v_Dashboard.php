<div class="alert alert-success alert-dismissible " role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <strong>Welcome back </strong> <?= $user; ?>.
</div>
<div class="row">
    <div class="x_panel">
        <div class="x_title">
            <h2>Dashboard</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">

                <div class="animated flipInY col-md-4 col-sm-6  ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-users"></i>
                        </div>
                        <div class="count"><?= $penguji ?> <small class="h6">Persons</small></div>

                        <h3>Examiner</h3>
                    </div>
                </div>
                <div class="animated flipInY col-md-4 col-sm-4  ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-users"></i>
                        </div>
                        <div class="count"><?= $dosen ?> <small class="h6">Persons</small></div>

                        <h3>Lecturer</h3>
                    </div>
                </div>
                <div class="animated flipInY col-md-4 col-sm-6  ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-user"></i>
                        </div>
                        <div class="count"><?= $penulis ?> <small class="h6">Persons</small></div>

                        <h3>Writer</h3>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="animated flipInY col-md-6 col-sm-6  ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-book"></i>
                        </div>
                        <div class="count"><?= $judul ?> <small class="h6">Title</small></div>

                        <h3>ETD </h3>
                    </div>
                </div>
                <div class="animated flipInY col-md-6 col-sm-6  ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-list-alt"></i>
                        </div>
                        <div class="count"><?= $gmd ?><small class="h6"> Classification</small></div>

                        <h3>GMD</h3>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="col-12 col-md-12 col-sm-12">
    <div id="pie-chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>