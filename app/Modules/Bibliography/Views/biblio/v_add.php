<!-- Container for the main content -->
<div class="x_panel">
    <div class="x_title">
        <h2>Add New Bibliography</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div id="wizardus" class="form_wizard wizard_horizontal">
            <ul class="wizard_steps">
                <li>
                    <a href="#step-1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                            GMD
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                            Bibliography
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#step-3">
                        <span class="step_no">3</span>
                        <span class="step_descr">
                            Approval
                        </span>
                    </a>
                </li>
            </ul>
            <form class="form-horizontal" action="<?= base_url('bibliography/save') ?>" method="POST" enctype="multipart/form-data" id="form-bibliography">
                <div id="step-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="gmd" class="control-label">Gmd Type</label>
                                <select class="form-control select2add" style="width: 100%" data-type="gmd" name="gmd" id="gmd">
                                    <option value="" disabled hidden selected></option>
                                    <?php foreach ($mst_data['mst_gmd'] as $val): ?>
                                        <option value="<?= $val->gmd_id ?>"><?= $val->gmd_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="item_type" class="control-label">Item Type</label>
                            <select class="form-control  select2add" style="width: 100%" data-type="item_type" name="item_type" id="item_type">
                                <option value="" disabled hidden selected></option>
                                <?php foreach ($mst_data['mst_item_type'] as $val): ?>
                                    <option value="<?= $val->item_type_id ?>"><?= $val->item_type_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label">Title <span class="required">*</span></label>
                            <textarea name="title" class="form-control" id="title" required></textarea>
                            <span class="validasi text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author" class="control-label">Author</label>
                            <select class="form-control select2add" style="width: 100%" data-type="author" name="author[]" id="author" multiple>
                                <?php foreach ($mst_data['mst_authors'] as $val): ?>
                                    <option value="<?= $val->author_id ?>"><?= $val->author_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_id" class="control-label">Student Id</label>
                            <input class="form-control" type="text" name="student_id" id="student_id" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cp_email" class="control-label">Contact Email</label>
                            <input class="form-control" type="email" name="cp_email" id="cp_email" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="supervisor" class="control-label">Supervisor</label>
                        <div class="form-group">
                            <select class="form-control select2add" style="width: 100%" data-type="supervisor" name="supervisor[]" id="supervisor" multiple>
                                <?php foreach ($mst_data['mst_supervisor'] as $val): ?>
                                    <option value="<?= $val->supervisor_id ?>"><?= $val->supervisor_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="examiner" class="control-label">Examiner</label>
                        <div class="form-group">
                            <select class="form-control select2add" style="width: 100%" data-type="examiner" name="examiner[]" id="examiner" multiple>
                                <?php foreach ($mst_data['mst_examiner'] as $val): ?>
                                    <option value="<?= $val->examiner_id ?>"><?= $val->examiner_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contributor" class="control-label">Contributor</label>
                            <select class="form-control select2add" style="width: 100%" data-type="contributor" name="contributor[]" id="contributor" multiple>
                                <?php foreach ($mst_data['mst_contributor'] as $val): ?>
                                    <option value="<?= $val->contributor_id ?>"><?= $val->contributor_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ministry" class="control-label">Code Ministry Pddikti</label>
                            <select class="form-control select2" name="ministry" id="ministry">
                                <?php foreach ($mst_data['mst_ministry'] as $val): ?>
                                    <option value="<?= $val->code_ministry ?>"><?= $val->name_prodi ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="place" class="control-label">Publishing Place</label>
                            <select class="form-control select2add" style="width: 100%" data-type="place" name=" place" id="place">
                                <option value="" disabled hidden selected></option>
                                <?php foreach ($mst_data['mst_place'] as $val): ?>
                                    <option value="<?= $val->place_id ?>"><?= $val->place_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="edition" class="control-label">Date Type</label>
                            <select class="form-control" name="edition" id="edition">
                                <option value="0">Pilih</option>
                                <option value="Published">Published</option>
                                <option value="In Press">In Press</option>
                                <option value="Submitted">Submitted</option>
                                <option value="Unpublished">Unpublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="collation" class="control-label">Collation</label>
                            <input class="form-control" type="text" name="collation" id="collation" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="specDetailInfo" class="control-label">Specific Detail Info</label>
                            <input class="form-control" type="text" name="specDetailInfo" id="specDetailInfo" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="language" class="control-label">Language</label>
                            <select class="form-control select2add" style="width: 100%" data-type="language" name="language" id="language">
                                <option value="" disabled hidden selected></option>
                                <?php foreach ($mst_data['mst_language'] as $val): ?>
                                    <option value="<?= $val->language_id ?>"><?= $val->language_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="departement" class="control-label">Department</label>
                            <input class="form-control" type="text" name="departement" id="departement" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="copyright" class="control-label">Copyright</label>
                            <select class="form-control select2add" style="width: 100%" data-type="copyright" name="copyright" id="copyright">
                                <option value="" disabled hidden selected></option>
                                <?php foreach ($mst_data['mst_copyright'] as $val): ?>
                                    <option value="<?= $val->copyright_id ?>"><?= $val->copyright_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publisher" cslass="control-label">Publisher</label>
                            <select class="form-control select2add" style="width: 100%" data-type="publisher" name="publisher" id="publisher">
                                <option value="" disabled hidden selected></option>
                                <?php foreach ($mst_data['mst_publisher'] as $val): ?>
                                    <option value="<?= $val->publisher_id ?>"><?= $val->publisher_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="license" class="control-label">License</label>
                            <select class="form-control select2add" style="width: 100%" data-type="license" name="license" id="license">
                                <option value="" disabled hidden selected></option>
                                <?php foreach ($mst_data['mst_license'] as $val): ?>
                                    <option value="<?= $val->license_id ?>"><?= $val->license_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="year" class="control-label">Publish Year</label>
                            <input class="form-control" type="text" name="year" id="year" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image" class="control-label">Upload Image</label>
                            <input type="file" class="form-control" name="image" id="image" value="">
                            <small class="form-text text-danger">Maximum 500 KB</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Attachment</label>
                            <span id="tambahin">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="text" name="title_file[]" placeholder="File Title" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" name="url_file[]" placeholder="File URL" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="desk_file[]" placeholder="File Description" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <select id="acc_type" class="form-control" name="akses_file[]">
                                            <option value="private">private</option>
                                            <option value="public">public</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="acc_member" class="form-control" name="akses_member[]">
                                            <option value="0" selected>Limit Member</option>
                                            <option value="1">All Member</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="file" name="attc_file[]" placeholder="File" class="form-control" onchange="return validExt(this,2097152,['pdf'])" accept="application/pdf">
                                        <small class="form-text text-danger">Max PDF size 50 MB</small>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-success btn-block" id="addRow"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="topic" class="control-label">Subject</label>
                            <select class="form-control select2" name="topic[]" id="topic" multiple>
                                <?php foreach ($mst_data['mst_topic'] as $val): ?>
                                    <option value="<?= $val->topic_id ?>"><?= $val->topic ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="notes" class="control-label">Abstract</label>
                            <textarea class="form-control" name="notes" id="notes"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="class" class="control-label">Classification</label>
                            <input class="form-control" type="text" name="class" id="class" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="callNumber" class="control-label">Call Num.</label>
                            <input class="form-control" type="text" name="callNumber" id="callNumber" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="urlcrossref" class="control-label">Url Crossref</label>
                            <input class="form-control" type="text" name="urlcrossref" id="urlcrossref" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sendMail" class="control-label">Send Email Approved</label>
                            <select class="form-control" name="sendMail" id="sendMail">
                                <option value="0">Pilih</option>
                                <option value="Send">Send</option>
                                <option value="Not Send">Not Send</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="step-3">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="form-group" id="approvalSection">
                                <i class="glyphicon glyphicon-ok-sign" style="font-size: 50pt; color: #28a745;"></i>
                                <h1>Congratulations</h1>
                                <p>The data is complete, you can now press the save button to save the data.</p>
                                <!-- <button name="saveData" class="btn btn-success btn-block">Submit</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
