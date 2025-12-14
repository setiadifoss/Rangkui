<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">

    <!-- theme meta -->
    <meta name="theme-name" content="reporter" />

    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/reporter/plugins/bootstrap/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="<?= base_url('assets/reporter/css/style.css') ?>">
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

<body>

    <header class="navigation">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <a class="navbar-brand order-1 py-0" href="<?= base_url() ?>">
                    <img loading="prelaod" decoding="async" class="img-fluid" src="<?= base_url('assets/images/Difoss-Header.png') ?>" alt="<?= $title ?>" style="height: 50px;">
                </a>
                <div class="navbar-actions order-3 ml-0 ml-md-4">
                    <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
                        data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <form action="#!" class="search order-lg-3 order-md-2 order-3 ml-auto">
                    <?php if (!$session->has('user_id')) : ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-light btn-sm">Masuk</a>
                    <?php else: ?>
                        <a href="<?= base_url('login/logout') ?>" class="btn btn-light btn-sm">Keluar</a>
                    <?php endif ?>
                </form>
                <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                    <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('information') ?>">Informasi Perpustakaan</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Link
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" target="blank" href="https://setiadifoss.org">DIFOSS</a>
                                <a class="dropdown-item" target="blank" href="https://github.com/slimsetd">Github</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                E-Resources
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" target="blank" href="http://onesearch.id/">One Search</a>
                                <a class="dropdown-item" target="blank" href="http://e-resources.perpusnas.go.id/">E-Resources PNRI</a>
                                <a class="dropdown-item" target="blank" href="http://roar.eprints.org/">Registry of Open Access Repositories</a>
                                <a class="dropdown-item" target="blank" href="https://v2.sherpa.ac.uk/opendoar/">OPEN DOAR</a>
                                <a class="dropdown-item" target="blank" href="https://scholar.google.co.id/">Google Scholar</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                E-Book
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" target="blank" href="http://ipusnas.id/">iPusnas</a>
                                <a class="dropdown-item" target="blank" href="http://e-resources.perpusnas.go.id/">E-Resoruces PNRI</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Video
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" target="blank" href="https://www.ted.com/">Tedx</a>
                                <a class="dropdown-item" target="blank" href="http://99u.com/">99U</a>
                                <a class="dropdown-item" target="blank" href="https://themoth.org/">The Moth</a>
                                <a class="dropdown-item" target="blank" href="http://www.ignitetalks.io/">Ignite</a>
                                <a class="dropdown-item" target="blank" href="https://creativegood.com/">Creative Good</a>
                                <a class="dropdown-item" target="blank" href="http://www.pechakucha.org/">Pecha Kucha</a>
                                <a class="dropdown-item" target="blank" href="http://www.veritas.org/">Veritas</a>
                                <a class="dropdown-item" target="blank" href="http://www.ideacity.ca/">Ideacity</a>
                                <a class="dropdown-item" target="blank" href="https://poptech.org/">Pop Tech</a>
                                <a class="dropdown-item" target="blank" href="https://talksat.withgoogle.com/">Talks at Google</a>
                                <a class="dropdown-item" target="blank" href="http://bigthink.com/">Big Think</a>
                                <a class="dropdown-item" target="blank" href="https://www.feastongood.com/">Feast on Good</a>
                                <a class="dropdown-item" target="blank" href="http://oprah.com/">Oprah</a>
                                <a class="dropdown-item" target="blank" href="https://www.thersa.org/">RSA</a>
                                <a class="dropdown-item" target="blank" href="http://www.thedolectures.com/">Dolec Tures</a>
                                <a class="dropdown-item" target="blank" href="http://captureyourflag.com/">Capture Your Flag</a>
                                <a class="dropdown-item" target="blank" href="http://chicagoideas.com/">Chicago Ideas</a>
                            </div>
                        </li>
                        <?php if ($session->has('user_id')) : ?>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('home') ?>">Dashboard</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="section">
            <?= $content ?>
        </section>
    </main>

    <footer class="bg-dark mt-5">
        <div class="container section">
            <div class="row text-white">
                <div class="col-lg-4 mx-auto">
                    <img src="<?= base_url('assets/images/Difoss-Header.png') ?>" alt="DIFOSS" width="50%">
                    <div class="text-justify">
                        Friendly Open Source Software
                        <div><a class="afooter" href="<?= base_url('oai?verb=ListRecords&metadataPrefix=oai_dc') ?>">OAI PMH</a></div>
                        <div>Designed &amp; Developed By <a class="afooter" href="https://setiadifoss.org">DIFOSS</a></div>
                        <code>Version : 4.1.0</code> | <code>Code name : Rangkui</code>
                    </div>
                </div>
                <div class="col-lg-4 mx-auto">
                    <h3 class=" text-white">Email :</h3>
                    <div class="text-justify">halo@setiadifoss.org</div>
                    <h3 class=" text-white">Alamat</h3>
                    <div class="text-justify">
                        Difoss Creative Hub
                        Jl Kav Polri RT.02 RW.03 No 83B
                        Kecamatan Pd. Aren, Kota Tangerang Selatan, Banten 15228
                    </div>
                </div>
                <div class="col-lg-4 mx-auto">
                    <div class="text-center">
                        Didukung oleh FossStudio & Difoss Creative Hub
                    </div>
                    <div class="text-center mt-3">
                        <a href="https://www.youtube.com/@difoss" target="_BLANK"><img src="<?= base_url('assets/reporter/images/youtube.webp') ?>" class="icon-media-social" alt="youtube"></a>
                        <a href="https://github.com/setiadifoss" target="_BLANK"><img src="<?= base_url('assets/reporter/images/github.svg') ?>" class="icon-media-social" alt="github"></a>
                        <a href="https://t.me/grupsetiadi" target="_BLANK"><img src="<?= base_url('assets/reporter/images/telegram.svg') ?>" class="icon-media-social" alt="telegram"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="copyright bg-dark content">
        </div> -->
    </footer>


    <!-- # JS Plugins -->
    <script src="<?= base_url('assets/reporter/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/reporter/plugins/bootstrap/bootstrap.min.js') ?>"></script>

    <!-- Main Script -->
    <script src="<?= base_url('assets/reporter/js/script.js') ?>"></script>

    <?php if (count($js) > 0) : ?>
        <?php foreach ($js as $key => $v) : ?>
            <?php if (stripos($v, "assets") !== false) : ?>
                <script src="<?= base_url($v . '.js?ver=' . filemtime(FCPATH . $v . ".js")) ?>"></script>
            <?php else : ?>
                <script src="<?= $v ?>"></script>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
</body>

</html>