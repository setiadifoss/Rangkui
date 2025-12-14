<div class="x_panel">
    <div class="x_title">
        <h2>User Profile</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 col-sm-3  profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar" class="text-center">
                                <img class="img-responsive avatar-view img-cover" src="<?= base_url('uploads/images/persons/' . $data->user_image) ?>" alt="Avatar" title="Change the avatar">
                            </div>
                        </div>
                        <h3><?= $data->realname ?></h3>
                        <ul class="list-unstyled user_data">
                            <li><b>Username</b> : <?= $data->username ?></li>
                            <li><b>Email</b> : <?= $data->email ?></li>
                            <li><b>Tipe Keanggotaan</b> : <?= getTypeUser($data->user_type) ?></li>
                            <li class="text-center">
                                <a class="mx-1" href="https://facebook.com/<?= $data->social_media['fb'] ?? "" ?>"><i class="fa fa-2x fa-facebook-square"></i></a>
                                <a class="mx-1" href="https://x.com/<?= $data->social_media['tw'] ?? "" ?>"><i class="fa fa-2x fa-twitter-square"></i></a>
                                <a class="mx-1" href="https://linkedin.com/<?= $data->social_media['li'] ?? "" ?>"><i class="fa fa-2x fa-linkedin-square"></i></a>
                                <a class="mx-1" href="https://reddit.com/user/<?= $data->social_media['rd'] ?? "" ?>"><i class="fa fa-2x fa-reddit-square"></i></a>
                                <a class="mx-1" href="https://pintestest.com/<?= $data->social_media['pn'] ?? "" ?>"><i class="fa fa-2x fa-pinterest-square"></i></a>
                                <a class="mx-1" href="https://plus.google.com/<?= $data->social_media['gp'] ?? "" ?>"><i class="fa fa-2x fa-google-plus-square"></i></a>
                                <a class="mx-1" href="https://youtube.com/<?= $data->social_media['pn'] ?? "" ?>"><i class="fa fa-2x fa-youtube-play"></i></a>
                                <a class="mx-1" href="<?= $data->social_media['bl'] ?? "" ?>"><i class="fa fa-2x fa-pencil-square"></i></a>
                                <a class="mx-1" href="https://yahoo.com/<?= $data->social_media['ym'] ?? "" ?>"><i class="fa fa-2x fa-yahoo"></i></a>
                            </li>
                        </ul>

                        <button class="btn btn-info btn-flat btn-sm btn-block" onclick='showModal(<?= json_encode($data) ?>)'><i class="fa fa-edit m-right-xs"></i> Edit Profile</button>
                        <hr />

                        <h4>Informasi</h4>
                        <ul class="list-unstyled user_data">
                            <li><b>Registered</b> : <?= $data->input_date ?></li>
                            <li><b>last Update</b> : <?= $data->last_update ?></li>
                            <li><b>last Login</b> : <?= $data->last_login ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal_action" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <form action="<?= base_url('profile/save') ?>" method="post">
                <div class="modal-body">
                    <div class="alert alert-warning text-white" role="alert">Leave the password field and the password confirmation field empty if you do not want to change the password</div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="" maxlength="50" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="realname">Full Name*</label>
                        <input type="text" class="form-control" name="realname" id="realname" value="" maxlength="100" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" name="email" id="email" value="" maxlength="200" tabindex="1" required>
                    </div>
                    <div class="form-group">
                        <label for="user_type">Tipe Keanggotaan*</label>
                        <select name="user_type" id="user_type" class="form-control" required>
                            <option value="1">Pustakawan</option>
                            <option value="2">Pustakawan</option>
                            <option value="3">Staff Perpustakaan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Media Sosial</label>
                        <div class="row">
                            <div class="col-sm-6  form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputFacebook" name="social[fb]" placeholder="Facebook" value="">
                                <span class="fa fa-facebook form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputTwitter" name="social[tw]" placeholder="Twitter" value="">
                                <span class="fa fa-twitter form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputLinkedIn" name="social[li]" placeholder="LinkedIn" value="">
                                <span class="fa fa-linkedin form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputReddit" name="social[rd]" placeholder="Reddit" value="">
                                <span class="fa fa-reddit form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputPinterest" name="social[pn]" placeholder="Pinterest" value="">
                                <span class="fa fa-pinterest form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputGooglePlus" name="social[gp]" placeholder="Google Plus+" value="">
                                <span class="fa fa-google-plus form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputYouTube" name="social[yt]" placeholder="YouTube" value="">
                                <span class="fa fa-youtube form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputBlog" name="social[bl]" placeholder="Blog" value="">
                                <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-sm-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputYahooMessenger" name="social[ym]" placeholder="Yahoo! Messenger" value="">
                                <span class="fa fa-yahoo form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passwd1" class="control-label">New Password</label>
                        <input type="password" id="passwd1" name="passwd1" onkeyup="confirm_pass()" class="form-control" value="">
                        <small id="validation_pass" class="text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="passwd2" class="control-label">Confirm New Password</label>
                        <input type="password" id="passwd2" name="passwd2" onkeyup="confirm_pass()" class="form-control">
                        <small id="validation_confirm_pass" class="text-danger"></small>
                    </div>
                    <span class="hidden"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" id="save_button" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>