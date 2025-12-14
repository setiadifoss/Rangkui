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

    <!-- PNotify -->
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.buttons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendors/pnotify/dist/pnotify.nonblock.css') ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets/build/css/custom.min.css') ?>" rel="stylesheet">

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

</head>


<body class="login">
    <div>
        <div class="login_wrapper">
            <?= $content ?>
        </div>
    </div>

    <!-- SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- FastClick -->
    <script src="<?= base_url('assets/vendors/fastclick/lib/fastclick.js') ?>"></script>
    <!-- PNotify -->
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.buttons.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/pnotify/dist/pnotify.nonblock.js') ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('assets/build/js/custom.js') ?>"></script>

    <?php if (count($js) > 0) : ?>
        <?php foreach ($js as $key => $v) : ?>
            <?php if (stripos($v, "assets") !== false) : ?>
                <script src="<?= base_url($v . '.js?ver=' . filemtime(FCPATH . $v . ".js")) ?>"></script>
            <?php else : ?>
                <script src="<?= $v ?>"></script>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>

    <?php $session = session(); ?>
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