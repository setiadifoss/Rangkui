<div class="x-panel">
    <div class="x_title">
        <h2>Perbaharui Keanggotaan</h2>

        <div class="clearfix"></div>
    </div>

    <div class="x_content" style="margin-top: 40px;">
        <div id="mainContent" style="display: block;">
            <form name="mainForm" id="mainForm" class="form-horizontal" method="post" action="<?= base_url('membership/update') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="form_name" value="mainForm">
                <input type="hidden" name="original_member_id" value="<?= $data->member_id ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberId" class="control-label col-md-3">Member ID*</label>
                            <input type="text" name="member_id" id="memberId" class="form-control" maxlength="50" required value="<?= $data->member_id ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberName" class="control-label col-md-3">Member Name*</label>
                            <input type="text" name="member_name" id="memberName" class="form-control" maxlength="100" required value="<?= $data->member_name ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="birthDate" class="control-label col-md-3">Date of Birth</label>
                            <input class="form-control" type="date" name="birth_date" id="birthDate" value="<?= $data->birth_date ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instName" class="control-label col-md-3">Institution</label>
                            <input type="text" name="inst_name" id="instName" class="form-control" maxlength="256" value="<?= $data->inst_name ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sinceDate" class="control-label col-md-3">Member Since</label>
                            <input class="form-control" type="date" name="member_since_date" id="sinceDate" value="<?= $data->member_since_date ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberTypeID" class="control-label col-md-3">Membership Type*</label>
                            <select name="member_type_id" id="memberTypeID" class="form-control" required>
                                <?php foreach ($mst_data as $value): ?>
                                    <option value="<?= $value->member_type_id ?>" <?= $value->member_type_id == $data->member_type_id ? 'selected' : '' ?>><?= $value->member_type_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="regDate" class="control-label col-md-3">Registration Date</label>
                            <input class="form-control" type="date" name="register_date" id="regDate" value="<?= $data->register_date ?>">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberPIN" class="control-label col-md-3">Identification Number</label>
                            <input type="text" name="pin" id="memberPIN" class="form-control" maxlength="256" required value="<?= $data->pin ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Valid Until</label>
                            <input class="form-control" type="date" name="expire_date" id="expDate" value="<?= $data->expire_date ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberPostal" class="control-label col-md-3">Postal Code</label>
                            <input type="text" name="postal_code" id="memberPostal" class="form-control" maxlength="256" value="<?= $data->postal_code ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Gender</label>
                            <div class="radio">
                                <label><input type="radio" name="gender" value="1" <?= $data->gender == 1 ? 'checked' : '' ?>> Male</label>
                                <label><input type="radio" name="gender" value="0" <?= $data->gender == 0 ? 'checked' : '' ?>> Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberAddress" class="control-label col-md-3">Address</label>
                            <textarea name="member_address" id="memberAddress" class="form-control" rows="2" maxlength="30720"><?= $data->member_address ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberMailAddress" class="control-label col-md-3">Address Mail</label>
                            <textarea name="member_mail_address" id="memberMailAddress" class="form-control" rows="2" maxlength="30720"><?= $data->member_mail_address ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberPhone" class="control-label col-md-3">Phone Number</label>
                            <input type="text" name="member_phone" id="memberPhone" class="form-control" maxlength="256" value="<?= $data->member_phone ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberFax" class="control-label col-md-3">Fax Number</label>
                            <input type="text" name="member_fax" id="memberFax" class="form-control" maxlength="256" value="<?= $data->member_fax ?>">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberNotes" class="control-label col-md-3">Notes</label>
                            <textarea name="member_notes" id="memberNotes" class="form-control" rows="2" maxlength="30720"><?= $data->member_notes ?></textarea>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="image" class="control-label col-md-3">Foto</label>
                                <input type="file" name="member_image" id="image" class="form-control" value="<?= $data->member_image ?>">
                                <small>Maximum 500 KB</small>
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="left profile_img">
                                    <div id="crop-avatar">
                                        <img class="img-responsive avatar-view" src="<?= base_url("uploads/membership/var/") . $data->member_image ?>"
                                            alt="Avatar"
                                            title="Change the avatar"
                                            style="width: 200px !important; height: 200px !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberPasswd" class="control-label col-md-3">New Password</label>
                            <input type="password" name="mPasswd" id="memberPasswd" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberEmail" class="control-label col-md-3">E-mail</label>
                            <input type="text" name="member_email" id="memberEmail" class="form-control" maxlength="256" required value="<?= $data->member_email ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberPasswd2" class="control-label col-md-3">Confirmation New Password</label>
                            <input type="password" name="memberPasswd2" id="memberPasswd2" class="form-control" onkeyup="validatePassword()">
                            <small id="passwordFeedback" style="color: red;"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-3">Suspend Membership</label>
                            <div class="checkbox">
                                <label><input type="checkbox" name="is_pending[]" value="1" <?= $data->is_pending == 1 ? 'checked' : '' ?>> Yes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" form-group text-right">
                    <div class="col-md-offset-3 ">
                        <input type="submit" class="btn btn-success text-right" value="Update" onclick="return validateForm()">
                    </div>
                </div>
            </form>
            <script>
                function validatePassword() {
                    var password = document.getElementById("memberPasswd").value;
                    var confirmPassword = document.getElementById("memberPasswd2").value;
                    var feedback = document.getElementById("passwordFeedback");
                    if (password || confirmPassword) { // Only validate if at least one field is filled
                        if (password !== confirmPassword) {
                            feedback.textContent = "Passwords do not match!";
                            return false;
                        }
                    }
                    feedback.textContent = "";
                    return true;
                }

                function validateForm() {
                    return validatePassword();
                }
            </script>
        </div>
    </div>
</div>
