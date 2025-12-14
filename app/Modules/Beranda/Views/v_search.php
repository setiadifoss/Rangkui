<div class="container">
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h2 class="section-title">Search Result</h2>
        </div>
        <div class="col-lg-12 mb-5 mb-lg-0">
            <div class="row">
                <?php if (count($data) > 0): ?>
                    <?php foreach ($data as $key => $value) : ?>
                        <div class="col-sm-12 col-md-12 mb-4">
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
                                            <h2 class="h2-title"><a class="post-title" href="<?= base_url('beranda/detail/' . slim_encrypt($value->biblio_id)) ?>"><?= character_limiter($value->title, 160) ?></a></h2>
                                            <p class="card-text title-abstract text-justify"><?= character_limiter($value->notes, 330) ?></p>
                                            <div class="row">
                                                <div class="col">
                                                    <ul class="list-inline">
                                                        <span>Share : </span>
                                                        <li class="list-inline-item">
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Facebook" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/fb.gif') ?>" alt="Facebook">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="http://twitter.com/share?url=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>&amp;text=Test" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Twitter" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/tw.gif') ?>" alt="Twitter">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="https://plus.google.com/share?url=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Google Plus" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/gplus.gif') ?>" alt="Google">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="http://www.digg.com/submit?url=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Digg It" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/digg.gif') ?>" alt="Digg">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="http://reddit.com/submit?url=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>&amp;title=Test" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Reddit" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/rdit.gif') ?>" alt="Reddit">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to LinkedIn" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/lin.gif') ?>" alt="LinkedIn">
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="http://www.stumbleupon.com/submit?url=<?= rawurlencode(base_url('beranda/detail/' . slim_encrypt($value->biblio_id))) ?>&amp;title=Test" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Stumbleupon" target="_blank">
                                                                <img src="<?= base_url('uploads/images/default/su.gif') ?>" alt="StumbleUpon">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <div class="content text-right"><a class="read-more-btn" href="<?= base_url('beranda/detail/' . slim_encrypt($value->biblio_id)) ?>">See Detail</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-sm-12 col-md-12 mb-4">
                        <h3>No Result</h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>