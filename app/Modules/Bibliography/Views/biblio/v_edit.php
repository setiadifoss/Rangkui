<!-- Container for the main content -->
<div class="x_panel">
    <div class="x_title">
        <h2>Edit Bibliography</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="loader">
            Anda akan mengubah data biblio : <br>
            Terakhir diubah <strong>Admin</strong>
        </div>
        <hr>
        <form class="form-horizontal" action="<?= base_url('bibliography/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gmd" class="control-label">Gmd Type</label>
                        <input type="hidden" name="biblio_id" value='<?= $data[0]->biblio_id ?>'>
                        <input type="hidden" id="selectgmd" value='<?= json_encode($data[0]->gmd_id) ?>'>
                        <select class="form-control select2add" data-type="gmd" name="gmd" id="gmd">
                            <?php foreach ($mst_data['mst_gmd'] as $val): ?>
                                <option value="<?= $val->gmd_id ?>"><?= $val->gmd_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="item_type" class="control-label">Item Type</label>
                        <input type="hidden" id="selectitem_type_id" value='<?= json_encode($data[0]->item_type_id) ?>'>
                        <select class="form-control select2add" data-type="item_type" name="item_type" id="item_type">
                            <option value="" disabled hidden selected></option>
                            <?php foreach ($mst_data['mst_item_type'] as $val): ?>
                                <option value="<?= $val->item_type_id ?>"><?= $val->item_type_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <textarea name="title" class="form-control" id="title"><?= $data[0]->title ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="author" class="control-label">Author</label>
                        <input type="hidden" id="selectauthor" value='<?= json_encode($data[0]->uthors) ?>'>
                        <select class="form-control select2add" data-type="author" name="author[]" id="author" multiple>
                            <?php foreach ($mst_data['mst_authors'] as $val): ?>
                                <option value="<?= $val->author_id ?>"><?= $val->author_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="student_id" class="control-label">Student Id</label>
                        <input class="form-control" type="text" name="student_id" id="student_id" value="<?= $data[0]->student_id ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cp_email" class="control-label">Contact Email</label>
                        <input class="form-control" type="text" name="cp_email" id="cp_email" value="<?= $data[0]->cp_email ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="supervisor" class="control-label">Supervisor</label>
                        <input type="hidden" id="selectsupervisor" value='<?= json_encode($data[0]->supervisor) ?>'>
                        <select class="form-control select2add" data-type="supervisor" name="supervisor[]" id="supervisor" multiple>
                            <?php foreach ($mst_data['mst_supervisor'] as $val): ?>
                                <option value="<?= $val->supervisor_id ?>"><?= $val->supervisor_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="examiner" class="control-label">Examiner</label>
                        <input type="hidden" id="selectexaminer" value='<?= json_encode($data[0]->examiner) ?>'>
                        <select class="form-control select2add" data-type="examiner" name="examiner[]" id="examiner" multiple>
                            <?php foreach ($mst_data['mst_examiner'] as $val): ?>
                                <option value="<?= $val->examiner_id ?>"><?= $val->examiner_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contributor" class="control-label">Contributor</label>
                        <input type="hidden" id="selectcontributor" value='<?= json_encode($data[0]->contributor) ?>'>
                        <select class="form-control select2add" data-type="contributor" name="contributor[]" id="contributor" multiple>
                            <?php foreach ($mst_data['mst_contributor'] as $val): ?>
                                <option value="<?= $val->contributor_id ?>"><?= $val->contributor_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ministry" class="control-label">Code Ministry Pddikti</label>
                        <input type="hidden" id="selectministry" value='<?= json_encode($data[0]->code_ministry) ?>'>
                        <select class="form-control select2 select2ad" data-type='ministry' name="ministry" id="ministry">
                            <option value="" selected hidden disabled></option>
                            <option value="create_new">Tambah Code Ministry Pddikti</option>
                            <?php foreach ($mst_data['mst_ministry'] as $val): ?>
                                <option value="<?= $val->code_ministry ?>"><?= $val->name_prodi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="place" class="control-label">Publishing Place</label>
                        <input type="hidden" id="selectplace" value='<?= json_encode($data[0]->publish_place_id) ?>'>
                        <select class="form-control select2add" data-type="place" name="place" id="place">
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
                        <input type="hidden" id="selectedition" value='<?= json_encode($data[0]->edition) ?>'>
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
                        <input class="form-control" type="text" name="collation" id="collation" value="<?= $data[0]->collation ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="specDetailInfo" class="control-label">Specific Detail Info</label>
                        <input class="form-control" type="text" name="specDetailInfo" id="specDetailInfo" value="<?= $data[0]->spec_detail_info ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="language" class="control-label">Language</label>
                        <input type="hidden" id="selectlanguage" value='<?= json_encode($data[0]->language_id) ?>'>
                        <select class="form-control select2add" data-type="language" name="language" id="language">
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
                        <input class="form-control" type="text" name="departement" id="departement" value="<?= $data[0]->departement ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="copyright" class="control-label">Copyright</label>
                        <input type="hidden" id="selectcopyright" value='<?= json_encode($data[0]->copyright) ?>'>
                        <select class="form-control select2add" data-type="copyright" name="copyright" id="copyright">
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
                        <input type="hidden" id="selectpublisher" value='"[<?= $data[0]->publisher_id ?>]"'>
                        <select class="form-control select2add" data-type="publisher" name="publisher" id="publisher">
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
                        <input type="hidden" id="selectlicense" value='<?= json_encode($data[0]->license) ?>'>
                        <select class="form-control select2add" data-type="license" name="license" id="license">
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
                        <input class="form-control" type="text" name="year" id="year" value="<?= $data[0]->publish_year ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="image" class="control-label">Upload Image</label>
                                <input type="file" class="form-control" name="image" id="image" value="">
                                <small class="form-text text-danger">Maximum 500 KB</small>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $image = empty($data[0]->image) ? base_url("assets/images/user.png") : base_url("uploads/images/docs/" . $data[0]->image);
                                ?>
                                <img class="img-responsive avatar-view" src="<?= $image  ?>" alt="Avatar" title="Change the avatar" style="width: 100%; height: 200px;object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Attahcment </label>
                        <span id="tambahin">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" name="title_file[]" placeholder="Title File" class="form-control">
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
                                        <option value="0" selected>Batasi Akses</option>
                                        <option value="1">Semua Anggota</option>
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
                        <?php $x = 1;
                        foreach (json_decode($data[0]->attachment) as $att) : ?>
                            <span class="attachment-row" data-index="<?= $x ?>">
                                <div class="col-sm-2">
                                    <input type="hidden" name="edit_file_id[<?= $x ?>]" value="<?= $att->file_id ?>">
                                    <input type="text" name="edit_title_file[<?= $x ?>]" value="<?= $att->file_title ?>" class="form-control editable-field" readonly>
                                </div>
                                <div class="col-sm-1">
                                    <input type="text" name="edit_url_file[<?= $x ?>]" value="<?= $att->file_url ?? '-' ?>" class="form-control editable-field" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="edit_desk_file[<?= $x ?>]" value="<?= $att->file_desc ?? '-' ?>" class="form-control editable-field" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <select name="edit_akses_file[<?= $x ?>]" class="form-control editable-field" readonly>
                                        <option value="private" <?= $att->access_type == 'private' ? 'selected' : '' ?>>Private</option>
                                        <option value="public" <?= $att->access_type == 'public' ? 'selected' : '' ?>>Public</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select name="edit_akses_member[<?= $x ?>]" class="form-control editable-field" readonly>
                                        <option value="0" <?= $att->access_limit == 0 ? 'selected' : '' ?>>Batasi Akses</option>
                                        <option value="1" <?= $att->access_limit == 1 ? 'selected' : '' ?>>Semua Anggota</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="file" name="edit_attc_file[<?= $x ?>]" class="form-control" accept="application/pdf">
                                    <small class="form-text text-danger">Max PDF size 50 MB</small>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-primary btn-edit" onclick="toggleEditAttachment(<?= $x ?>)"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-success btn-save" onclick="saveAttachment(<?= $x ?>)" style="display: none;"><i class="fa fa-save"></i></button>
                                    <button type="button" class="btn btn-danger btn-remove" onclick="hapusAttahcment(<?= $att->biblio_id ?>, <?= $att->file_id ?>)"><i class="fa fa-minus"></i></button>
                                </div>
                            </span>
                        <?php $x++;
                        endforeach; ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="topic" class="control-label">Subyek</label>
                        <input type="hidden" id="selecttopic" value='<?= json_encode($data[0]->topic) ?>'>
                        <select class="form-control select2" name="topic[]" id="topic" multiple>
                            <?php foreach ($mst_data['mst_topic'] as $val): ?>
                                <option value="<?= $val->topic_id ?>"><?= $val->topic ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes" class="control-label">Abstrak</label>
                        <textarea class="form-control" name="notes" id="notes"> <?= $data[0]->notes ?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="class" class="control-label">Klasifikasi</label>
                        <input class="form-control" type="text" name="class" id="class" maxlength="40" value="<?= $data[0]->classification ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="callNumber" class="control-label">No. panggil</label>
                        <input class="form-control" type="text" name="callNumber" id="callNumber" value="<?= $data[0]->call_number ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="urlcrossref" class="control-label">Url Crossref</label>
                        <input class="form-control" type="text" name="urlcrossref" id="urlcrossref" value="<?= $data[0]->url_crossref ?>">
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
                <div class="w-100">
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="approvalSection">
                        <button name="saveData" class="btn btn-success btn-block">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="modal-add-option" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Opsi Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-add-option">
                    <div class="form-group">
                        <label id="label-id" for="codenya">Code Ministry*</label>
                        <input type="text" id="codenya" name="codenya" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_prodi">Nama Prodi*</label>
                        <input type="text" id="nama_prodi" name="nama_prodi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree*</label>
                        <select name="degree" id="degree" class="form-control" required>
                            <option value="" selected disabled hidden></option>
                            <option value="1">D1</option>
                            <option value="2">D2</option>
                            <option value="3">D3</option>
                            <option value="4">D4</option>
                            <option value="5">S1</option>
                            <option value="6">S2</option>
                            <option value="7">S3</option>
                            <option value="8">Non Formal</option>
                            <option value="9">Informal</option>
                            <option value="10">Lainnya</option>
                            <option value="11">Sp-1</option>
                            <option value="12">Sp-2</option>
                            <option value="13">Profesi</option>
                            <option value="14">S2 Terapan</option>
                            <option value="15">S3 Terapan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="university">University*</label>
                        <input type="text" class="form-control" name="university" id="university" value="" maxlength="100" tabindex="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary text-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle edit mode for attachment fields
    window.toggleEditAttachment = function(index) {
        var fields = document.querySelectorAll(`.attachment-row[data-index="${index}"] .editable-field`);
        var editButton = document.querySelector(`.attachment-row[data-index="${index}"] .btn-edit`);
        var saveButton = document.querySelector(`.attachment-row[data-index="${index}"] .btn-save`);
        
        fields.forEach(field => {
            field.removeAttribute('readonly');
            if (field.tagName === 'SELECT') {
                field.removeAttribute('disabled');
            }
            field.classList.add('editable-active');
        });
        editButton.style.display = 'none';
        saveButton.style.display = 'inline-block';
    };

    // Function to save edited attachment data (placeholder for now)
    window.saveAttachment = function(index) {
        // This would normally send data to the server, but for now, we'll just toggle back to readonly
        var fields = document.querySelectorAll(`.attachment-row[data-index="${index}"] .editable-field`);
        var editButton = document.querySelector(`.attachment-row[data-index="${index}"] .btn-edit`);
        var saveButton = document.querySelector(`.attachment-row[data-index="${index}"] .btn-save`);
        
        fields.forEach(field => {
            field.setAttribute('readonly', 'readonly');
            if (field.tagName === 'SELECT') {
                field.setAttribute('disabled', 'disabled');
            }
            field.classList.remove('editable-active');
        });
        editButton.style.display = 'inline-block';
        saveButton.style.display = 'none';
        
        alert('Changes saved for this attachment. Click the main "Update" button to apply all changes.');
        // Note: Actual saving logic is handled via form submission with the main update button
    };
});
</script>
