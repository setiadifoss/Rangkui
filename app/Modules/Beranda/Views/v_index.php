<div class="header_home">

    <div class="swiper">
        <div class="swiper-wrapper">
            <?php
            $directory = 'uploads/images/sliders';
            $sliders = array_diff(scandir($directory), array('..', '.')); // Menghapus . dan .. dari hasil
            // Filter hanya file gambar (misalnya .jpg, .png, .gif)
            $sliders = array_filter($sliders, function ($file) {
                return preg_match('/\.(jpg|jpeg|png)$/i', $file);
            });
            foreach ($sliders as $key => $val) : ?>
                <div class="swiper-slide">
                    <img src="<?= $directory . '/' . $val; ?>" alt="Sliders <?= $key ?>" loading="lazy"  style="width: 100%;">
                    <div class="swiper-lazy-preloader"></div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <form action="<?= base_url('beranda/search') ?>" method="get">
        <input type="search" id="search-query" name="s" class="form-control searching" placeholder="Start it by typing one or more keywords for title, author or subject..." autocomplete="off" required>
    </form>
</div>
<div class="container mt-5">
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h3 class="section-title">New Collections</h3>
        </div>
        <div class="col-lg-12 mb-5 mb-lg-0">
            <div class="row">
                <?php foreach ($data as $key => $value) : ?>
                    <div class="col-sm-12 col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <ul class="post-meta">
                                                <li> <a href="<?= base_url('beranda/detail/' . slim_encrypt($value->biblio_id)) ?>"><?= $value->gmd ?></a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="post-date text-right">
                                                <span class="text-uppercase"><?= datetimeIdn($value->input_date) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 pb-0 pl-0 pr-0">
                                        <h2 class="h2-title"><a class="post-title" href="<?= base_url('beranda/detail/' . slim_encrypt($value->biblio_id)) ?>"><?= character_limiter($value->title, 30) ?></a></h2>
                                        <p class="card-text title-abstract text-justify"><?= character_limiter($value->notes, 130) ?></p>
                                        <div class="content text-right"><a class="read-more-btn" href="<?= base_url('beranda/detail/' . slim_encrypt($value->biblio_id)) ?>">See Detail</a></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>