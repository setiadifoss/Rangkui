<?php $session = session(); ?>
<div class="container">
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h2 class="section-title">Record Details</h2>
            <hr>
        </div>
        <div class="col-lg-12 mb-5 mb-lg-0">
            <?php if (empty($data->image) || is_null($data->image)) : ?>
                <img class="no_image" src="<?= base_url('assets/images/no_image.jpg'); ?>" alt="no_image">
            <?php else : ?>
                <img src="<?= base_url('uploads/images/docs/' . $data->image) ?>" class="thumbnail_cover" alt="book cover">
            <?php endif ?>
            <h3><?= $data->gmd ?></h3>
            <h4 class="text-justify"><?= $data->title ?></h4>

            <a target="_blank" href="?p=show_detail&amp;inXML=true&amp;id=82" class="btn btn-sm btn-danger">XML</a>
            <a href="https://www.mendeley.com/import/?url=<?= rawurlencode(current_url()) ?>" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Mendeley_Logo_Vertical.png/600px-Mendeley_Logo_Vertical.png" class="button-detail" alt="img-mendeley">
            </a>
            <div itemprop="author" property="author" itemscope="" itemtype="http://schema.org/Person">
                <?php foreach ($data->author as $key => $value) : ?>
                    <small class="author-detail"><a href="<?= base_url('beranda/search?author=' . rawurlencode($value->author_name)) ?>" title="Click to view others documents with this author"><?= $value->author_name ?></a> - <?= authority_type($value->authority_type) ?></small>
                <?php endforeach ?>
            </div>

            <ul class="list-inline">
                <span>Share : </span>
                <li class="list-inline-item">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= rawurlencode(current_url()) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Facebook" target="_blank">
                        <img src="<?= base_url('uploads/images/default/fb.gif') ?>" alt="Facebook">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="http://twitter.com/share?url=<?= rawurlencode(current_url()) ?>&amp;text=Test" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Twitter" target="_blank">
                        <img src="<?= base_url('uploads/images/default/tw.gif') ?>" alt="Twitter">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://plus.google.com/share?url=<?= rawurlencode(current_url()) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Google Plus" target="_blank">
                        <img src="<?= base_url('uploads/images/default/gplus.gif') ?>" alt="Google">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="http://www.digg.com/submit?url=<?= rawurlencode(current_url()) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Digg It" target="_blank">
                        <img src="<?= base_url('uploads/images/default/digg.gif') ?>" alt="Digg">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="http://reddit.com/submit?url=<?= rawurlencode(current_url()) ?>&amp;title=Test" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Reddit" target="_blank">
                        <img src="<?= base_url('uploads/images/default/rdit.gif') ?>" alt="Reddit">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?= rawurlencode(current_url()) ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to LinkedIn" target="_blank">
                        <img src="<?= base_url('uploads/images/default/lin.gif') ?>" alt="LinkedIn">
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="http://www.stumbleupon.com/submit?url=<?= rawurlencode(current_url()) ?>&amp;title=Test" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="share to Stumbleupon" target="_blank">
                        <img src="<?= base_url('uploads/images/default/su.gif') ?>" alt="StumbleUpon">
                    </a>
                </li>
            </ul>
            <hr>
            <p class="text-justify"><?= $data->notes ?></p>
        </div>

        <div class="col-12">
            <h2 class="section-title">Detail Information</h2>
        </div>
        <div class="col-12">
            <table class="table table-information-detail" width="100%">
                <tbody>
                    <tr>
                        <th width="20%">Item Type</th>
                        <td>
                            <div itemprop="alternativeHeadline" property="alternativeHeadline"><?= $data->item_type ?></div>
                        </td>
                    </tr>

                    <tr>
                        <th>Penulis</th>
                        <td>
                            <?php foreach ($data->author as $key => $value) : ?>
                                <div>
                                    <a href="<?= base_url('beranda/search?author=' . rawurlencode($value->author_name)) ?>" title="Klik disini untuk mencari dokumen lain dari pengarang ini"><?= $value->author_name ?></a>
                                    - <?= authority_type($value->authority_type) ?>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Student ID</th>
                        <td>
                            <div itemprop="numberOfPages" property="numberOfPages"><?= $data->student_id ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Dosen Pembimbing</th>
                        <td>
                            <?php foreach ($data->supervisor as $key => $value) : ?>
                                <div>
                                    <a href="<?= base_url('beranda/search?supervisor=' . rawurlencode($value->supervisor_name)) ?>" title="Klik disini untuk mencari dokumen lain dari pembimbing ini"><?= $value->supervisor_name ?></a> - <?= $value->supervisor_number ?> - Dosen Pembimbing <?= $value->level ?>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Penguji</th>
                        <td>
                            <?php foreach ($data->examiner as $key => $value) : ?>
                                <div>
                                    <a href="<?= base_url('beranda/search?examiner=' . rawurlencode($value->examiner_name)) ?>" title="Klik disini untuk mencari dokumen lain dari penguji ini"><?= $value->examiner_name ?></a> - <?= $value->examiner_number ?> - Ketua Penguji <?= $value->level ?>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>


                    <tr>
                        <th>Kode Prodi PDDIKTI</th>
                        <td>
                            <div><?= $data->code_ministry ?></div>
                        </td>
                    </tr>

                    <tr>
                        <th>Edisi</th>
                        <td>
                            <div><?= $data->edition ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Departement</th>
                        <td>
                            <div><?= $data->departement ?></div>
                        </td>
                    </tr>

                    <tr>
                        <th>Kontributor</th>
                        <td>
                            <?php foreach ($data->contributor as $key => $value) : ?>
                                <div>
                                    <a href="<?= base_url('beranda/search?contributor=' . rawurlencode($value->contributor_name)) ?>" title="Click to view others documents with this contributor"><?= $value->contributor_name ?></a> - Kontributor <?= $value->level ?>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Bahasa</th>
                        <td>
                            <div>
                                <meta itemprop="inLanguage" property="inLanguage" content=""><?= $data->language ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>
                            <span itemprop="publisher" property="publisher" itemtype="http://schema.org/Organization" itemscope=""><?= $data->publisher ?></span> :
                            <span itemprop="publisher" property="publisher"><?= $data->publisher_place ?></span>.,
                            <span itemprop="datePublished" property="datePublished"><?= $data->publish_year ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Edisi</th>
                        <td>
                            <div itemprop="bookEdition" property="bookEdition"><?= $data->edition ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Subyek</th>
                        <td>
                            <?php foreach ($data->topic as $key => $value) : ?>
                                <div class="s-subject" itemprop="keywords" property="keywords">
                                    <a href="<?= base_url('beranda/search?topic=' . rawurlencode($value->topic)) ?>" title="Click to view others documents with this subject"> <?= $value->topic ?></a>
                                </div>
                            <?php endforeach ?>
                        </td>
                    </tr>
                    <tr>
                        <th>No Panggil</th>
                        <td>
                            <div><?= $data->call_number ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Copyright</th>
                        <td>
                            <div><?= $data->copyright ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Doi</th>
                        <td>
                            <div><a href="<?= $data->url_crossref ?>" target="_blank"><?= $data->url_crossref ?></a></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <h2 class="section-title">Lampiran Berkas</h2>
        </div>
        <div class="col-12">
            <div itemprop="associatedMedia">
                <div class="s-download">
                    <div style="padding:30px;">
                        <div id="attachListLoad">
                            <ul class="attachList">
                                <?php foreach ($data->attachment as $key => $value) :
                                    if ($value->access_type == 'public'):
                                ?>
                                        <li class="list-attachment">
                                            <strong>
                                                <?php if (is_null($value->access_limit) || empty($value->access_limit)):
                                                    $enc = base64_encode($data->biblio_id . '|' . $value->file_id . '|' . $value->file_name);
                                                ?>
                                                    <!-- <a class="openPopUp download_file" title="<?= $value->file_title ?>" href="<?= base_url('uploads/repository/' . $value->file_name) ?>" target="_BLANK"><?= $value->file_title ?></a> -->
                                                    <a class="openPopUp download_file" data-file="<?= $enc ?>" title="<?= $value->file_title ?>" href="javascript:void(0)"><?= $value->file_title ?></a>
                                                <?php else: ?>
                                                    <?php if ($session->has('user_id')) : ?>
                                                        <?php $limit_access = unserialize($value->access_limit);
                                                        if (in_array(1, $limit_access)): ?>
                                                            <i class="fa fa-unlock"></i> <a class="openPopUp" title="<?= $value->file_title ?>" href="<?= base_url('uploads/repository/' . $value->file_name) ?>" target="_BLANK"><?= $value->file_title ?></a>
                                                        <?php else: ?>
                                                            <i class="fa fa-lock"></i> <span>You have no authorization to access this attachment</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <i class="fa fa-lock"></i><a class="openPopUp" href="<?= base_url('login') ?>">Please login to access this attachment</a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </strong>
                                        </li>
                                <?php endif;
                                endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>