<!-- Form Title -->
<div class="x_panel">
    <div class="x_title">
        <h2>Update user form</h2>
        <div class="clearfix"></div>
    </div>

    <form name="frm-main" id="frm-main" class="form-horizontal form-label-left" method="post" action="<?= base_url('sistem/pustakawan/update'); ?>" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to modify this data?')">
        <div class="x_content">
            <?= csrf_field(); ?>
            <input type="hidden" name="w_id" value="<?= $list_pustakawan->user_id; ?>">
            <!-- Form Fields -->
            <div class="form-group row">
                <label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pengguna<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="username" name="username" required="required" class="form-control col-md-7 col-xs-12" value="<?= $list_pustakawan->username ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="realName" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Asli<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="realName" name="realName" required="required" class="form-control col-md-7 col-xs-12" value="<?= $list_pustakawan->realname ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="userType" class="control-label col-md-3 col-sm-3 col-xs-12">Tipe Keanggotaan<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="userType" name="userType" class="form-control select2 col-md-7 col-xs-12" data-placeholder="--Pilih Tipe Anggota--" required>
                        <option></option>
                        <option value="1" <?= ($list_pustakawan->user_type == 1) ? "selected" : ""; ?>>Pustakawan</option>
                        <option value="2" <?= ($list_pustakawan->user_type == 2) ? "selected" : ""; ?>>Pustakawan</option>
                        <option value="3" <?= ($list_pustakawan->user_type == 3) ? "selected" : ""; ?>>Staf Perpustakaan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="eMail" class="control-label col-md-3 col-sm-3 col-xs-12">E-mail</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email" id="eMail" name="eMail" class="form-control col-md-7 col-xs-12" value="<?= $list_pustakawan->email ?>">
                </div>
            </div>


            <?php
            $social = unserialize($list_pustakawan->social_media);
            ?>
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Media Sosial</label>
                <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                <!-- <input type="text" name="social[fb]" class="form-control mb-2" placeholder="Facebook"> -->
                <div class="row col-md-9">
                    <div class="col-md-3 col-sm-6  form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputFacebook" name="social[fb]" placeholder="Facebook" value="<?= $social['fb']; ?>">
                        <span class="fa fa-facebook form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputTwitter" name="social[tw]" placeholder="Twitter" value="<?= $social['tw']; ?>">
                        <span class="fa fa-twitter form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputLinkedIn" name="social[li]" placeholder="LinkedIn" value="<?= $social['li']; ?>">
                        <span class="fa fa-linkedin form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputReddit" name="social[rd]" placeholder="Reddit" value="<?= $social['rd']; ?>">
                        <span class="fa fa-reddit form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputPinterest" name="social[pn]" placeholder="Pinterest" value="<?= $social['pn']; ?>">
                        <span class="fa fa-pinterest form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputGooglePlus" name="social[gp]" placeholder="Google Plus+" value="<?= $social['gp']; ?>">
                        <span class="fa fa-google-plus form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputYouTube" name="social[yt]" placeholder="YouTube" value="<?= $social['yt']; ?>">
                        <span class="fa fa-youtube form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputBlog" name="social[bl]" placeholder="Blog" value="<?= $social['bl']; ?>">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-3 col-sm-6 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputYahooMessenger" name="social[ym]" placeholder="Yahoo! Messenger" value="<?= $social['ym']; ?>">
                        <span class="fa fa-yahoo form-control-feedback left" aria-hidden="true"></span>
                    </div>

                </div>

            </div>

            <div class="form-group row">
                <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Foto Pengguna</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="image" name="image" class="form-control-file border rounded">
                    <small class="text-muted">Maksimum 500 KB</small>
                </div>
            </div>

            <?php
            $groups = unserialize($list_pustakawan->groups)
            ?>
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelompok</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="checkbox">
                        <label><input type="checkbox" name="groups[]" value="2" <?= (in_array('2', $groups)) ? "checked" : ""; ?> required> admin</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="groups[]" value="3" <?= (in_array('3', $groups)) ? "checked" : ""; ?>> Operator</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="groups[]" value="4" <?= (in_array('4', $groups)) ? "checked" : ""; ?>> User</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="passwd1" class="control-label col-md-3 col-sm-3 col-xs-12">Kata Sandi Baru<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="passwd1" name="passwd1" class="form-control" value="<?= set_value('passwd1'); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="passwd2" class="control-label col-md-3 col-sm-3 col-xs-12">Konfirmasi Kata Sandi Baru<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="passwd2" name="passwd2" class="form-control">
                    <?php if (session()->get('validation')): ?>
                        <small class="text-danger"><?= session()->get('validation')->getError('passwd2'); ?></small>
                    <?php endif; ?>
                </div>
            </div>


        </div>
        <div class="x_footer">
            <div class="form-group">
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>