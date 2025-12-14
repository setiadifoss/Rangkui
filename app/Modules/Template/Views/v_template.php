<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/ico" />


    <!-- Bootstrap -->
    <link href="<?= base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url('assets/vendors/iCheck/skins/flat/green.css') ?>" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?= base_url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?= base_url('assets/vendors/jqvmap/dist/jqvmap.min.css') ?>" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?= base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') ?>" rel="stylesheet">

    <!-- Select2 -->
    <link href="<?= base_url('assets/vendors/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />

    <!-- Datatables -->
    <link href="<?= base_url('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') ?>" rel="stylesheet">

    <!-- PNotify -->
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.buttons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.nonblock.css') ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets/build/css/custom.min.css') ?>" rel="stylesheet">

    <!-- SummerNote -->
    <link href="<?= base_url('assets/vendors/summernote/summernote.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/summernote/summernote-bs4.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/vendors/popperjs/popper.min') ?>"></script>

    <!-- Custom -->
    <link href="<?= base_url('assets/custom/css/custom.css') ?>" rel="stylesheet">

    <?php if (count($css) > 0) : ?>
        <?php foreach ($css as $key => $cs) :  ?>
            <?php if (stripos($cs, "assets") !== false) : ?>
                <link rel="stylesheet" href="<?= base_url($cs . '.css?ver=' . filemtime(FCPATH . $cs . ".css")) ?>" type="text/css">
            <?php else: ?>
                <link rel="stylesheet" href="<?= $cs ?>" type="text/css">
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
    <script>
        var baseUrl = '<?= base_url() ?>'
    </script>

    <?php $session = session(); ?>
</head>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0">
                        <a href="<?= base_url('/home') ?>" class="site_title">
                            <img src="<?= base_url('assets/images/logo.png') ?>" alt="logo ETD" style="width: 1.5em;margin-left: 8px;"> <span>ETD System</span>
                        </a>
                    </div>
                    <div class="ml-lg-3" id="version">
                        <div>
                            <code>Version : 4.1.0</code>
                        </div>
                        <div>
                            <code>Code name : Rangkui</code>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <br />

                    <!-- sidebar menu -->
                    <div
                        id="sidebar-menu"
                        class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li>
                                    <a href="<?= base_url() ?>"><i class="fa fa-globe"></i> Website </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('home') ?>"><i class="fa fa-bar-chart-o"></i> Dashboard </a>
                                </li>
                                <?php foreach ($menus as $key => $menu):
                                    $menu = (object) $menu;
                                ?>
                                    <?php if (array_key_exists('children', (array) $menu)) : ?>
                                        <li>
                                            <a><i class="fa <?= $menu->icon; ?>"></i> <?= $menu->title; ?>
                                                <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <?php foreach ($menu->children as $key => $sub) :
                                                    $sub = (object) $sub;
                                                ?>
                                                    <?php if ((int) $sub->level == 3): ?>
                                                        <li><a href="<?= base_url() . $sub->url ?>"><?= $sub->title; ?></a></li>
                                                    <?php else: ?>
                                                        <li><a><?= $sub->title; ?><span class="fa fa-chevron-down"></span></a>
                                                            <ul class="nav sub_menu">
                                                                <?php foreach ($sub->children as $subsub):
                                                                    $subsub = (object) $subsub ?>
                                                                    <li><a href="<?= base_url() . $subsub->url ?>"><?= $subsub->title; ?></a></li>
                                                                <?php endforeach ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        <li><a href="<?= base_url() . $menu->url ?>"><i class="fa <?= $menu->icon; ?>"></i><?= $menu->title; ?></a></li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">

                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span
                                class="glyphicon glyphicon-fullscreen"
                                aria-hidden="true"></span>
                        </a>
                        <a
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Logout"
                            href="<?= base_url('logout'); ?>">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class="navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px">
                                <a
                                    href="javascript:;"
                                    class="user-profile dropdown-toggle"
                                    aria-haspopup="true"
                                    id="navbarDropdown"
                                    data-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="<?= base_url('assets/images/img.jpg') ?>" alt="" /><?= $session->name ?>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?= base_url('profile') ?>"> Profile</a>
                                    <a href="<?= base_url('login/logout') ?>" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $title ?> </h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <?= $content ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
            <footer>
                <div class="pull-right">
                    Open Source - ETD System
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>
    <!-- SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/vendors/select2/dist/js/select2.min.js') ?>"></script>

    <!-- FastClick -->
    <script src="<?= base_url('assets/vendors/fastclick/lib/fastclick.js') ?>"></script>
    <!-- NProgress -->
    <script src="<?= base_url('assets/vendors/nprogress/nprogress.js') ?>"></script>
    <!-- Chart.js -->
    <script src="<?= base_url('assets/vendors/Chart.js/dist/Chart.min.js') ?>"></script>
    <!-- gauge.js -->
    <script src="<?= base_url('assets/vendors/gauge.js/dist/gauge.min.js') ?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?= base_url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>"></script>
    <!-- iCheck -->
    <script src="<?= base_url('assets/vendors/iCheck/icheck.min.js') ?>"></script>
    <!-- Skycons -->
    <script src="<?= base_url('assets/vendors/skycons/skycons.js') ?>"></script>
    <!-- Flot -->
    <script src="<?= base_url('assets/vendors/Flot/jquery.flot.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/Flot/jquery.flot.pie.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/Flot/jquery.flot.time.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/Flot/jquery.flot.stack.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/Flot/jquery.flot.resize.js') ?>"></script>
    <!-- Flot plugins -->
    <script src="<?= base_url('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/flot.curvedlines/curvedLines.js') ?>"></script>
    <!-- DateJS -->
    <script src="<?= base_url('assets/vendors/DateJS/build/date.js') ?>"></script>
    <!-- JQVMap -->
    <script src="<?= base_url('assets/vendors/jqvmap/dist/jquery.vmap.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') ?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= base_url('assets/vendors/moment/min/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

    <!-- Datatables -->
    <script src="<?= base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jszip/dist/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/pdfmake/build/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/pdfmake/build/vfs_fonts.js') ?>"></script>

    <!-- SummerNote -->
    <script src="<?= base_url('assets/vendors/summernote/summernote.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/summernote/summernote-bs4.min.js') ?>"></script>
    <!-- PNotify -->
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.buttons.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.nonblock.js') ?>"></script>
    <!-- jQuery Smart Wizard -->
    <script src="<?= base_url('assets/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets/build/js/custom.js') ?>"></script>
    <!-- Custom -->
    <script src="<?= base_url('assets/custom/js/custom.js') ?>"></script>



    <?php if (count($js) > 0) : ?>
        <?php foreach ($js as $key => $v) : ?>
            <?php if (stripos($v, "assets") !== false) : ?>
                <?php $jsPath = FCPATH . $v . ".js"; ?>
                <script src="<?= base_url($v . '.js?ver=' . (file_exists($jsPath) ? filemtime($jsPath) : time())) ?>"></script>
            <?php else : ?>
                <script src="<?= $v ?>"></script>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>

    <?php if (!is_null($session->getFlashdata('alert'))): ?>
        <script>
            new PNotify({
                title: '<?= $session->getFlashdata('alert')['msg'] ?>',
                text: '<?= $session->getFlashdata('alert')['text'] ?>',
                type: '<?= $session->getFlashdata('alert')['status'] ?>',
                styling: 'bootstrap3'
            });
        </script>
    <?php endif ?>


</body>

</html>