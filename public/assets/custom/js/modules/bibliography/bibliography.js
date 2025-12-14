$(document).ready(function () {
  $("#wizardus").smartWizard({
    theme: "dots",
    transitionEffect: "fade",
    transitionSpeed: "400",
    labelNext: "Next",
    labelPrevious: "Previous",
    labelFinish: "Save",
    hideButtonsOnDisabled: true,
    onLeaveStep: (e, anchorObject, stepNumber, stepDirection, stepPosition) => {
      if (anchorObject.toStep == 3) {
        if ($("#title").val() == null || $("#title").val() == "") {
          $("#title").focus();
          $(".validasi").text("Required");
          return false;
        }
      }
      $(".validasi").text("");
      return true;
    },
    onFinish: () => {
      $("#form-bibliography").submit();
    },
  });

  $(".buttonNext").addClass("btn btn-success");
  $(".buttonPrevious").addClass("btn btn-secondary");
  $(".buttonPrevious").addClass("pull-left");
  $(".buttonFinish").addClass("btn btn-success");

  $(".stepContainer").hide();

  initializeSelect2(".select2add", {
    placeholder: "Select or add item",
  });
  $(".select2add").each(function () {
    var select2Element = $(this);
    select2Element.css("width", "100%");
  });
  selectedS2("#selectauthor", "#author");
  selectedS2("#selectsupervisor", "#supervisor");
  selectedS2("#selectexaminer", "#examiner");
  selectedS2("#selectcontributor", "#contributor");
  selectedS2("#selectcopyright", "#copyright");
  selectedS2("#selectlicense", "#license");
  selectedS2("#selectpublisher", "#publisher");
  selectedS2("#selectplace", "#place");
  selectedS2("#selectlanguage", "#language");
  selectedS2("#selectedition", "#edition");
  selectedS2("#selectgmd", "#gmd");
  selectedS2("#selectitem_type_id", "#item_type");
  selectedS2("#selecttopic", "#topic");

  // tambah option to db
  $(".select2add").on("select2:select", function (e) {
    var data = e.params.data;
    var type = $(this).data("type");
    var select2Element = $(this);
    var selectedValues = select2Element.val() || [];

    if (data.newOption) {
      var postData = {
        name: data.text,
        tbl: type,
      };
      if (type === "language") {
        let str = data.text;
        let result = str.trim().replace(/ /g, "_");
        postData.idnya = result;
      }

      var $loadingSpinner = $('<span class="loading-spinner"></span>');
      select2Element.parent().append($loadingSpinner);

      $.ajax({
        url: `${baseUrl}bibliography/addopti`,
        method: "POST",
        data: postData,
        success: function (response) {
          var select2Element = $("select.select2add[data-type='" + type + "']");
          if (response.status === "success") {
            var newOptionId = response.data.id;
            var newOptionText = response.data.val;
            var newOption = new Option(newOptionText, newOptionId, false, true);

            select2Element.append(newOption);
            var isMultiple = select2Element.prop("multiple");

            if (isMultiple) {
              selectedValues.push(newOptionId);
            } else {
              selectedValues = newOptionId;
            }

            select2Element.val(selectedValues).trigger("change");
            initializeSelect2(".select2add", {
              placeholder: "Pilih atau tambah item type",
            });

            sNotif(response.title, response.message, response.status);
          } else {
            sNotif(response.title, response.message, response.status);
          }
          select2Element.find("option[value='" + data.text + "']").remove();
        },
        error: function () {
          sNotif("Terjadi Kesalahan.", "Gagal Menambahkan opsi baru.", "error");
        },
        complete: function () {
          $loadingSpinner.remove();
        },
      });
    }
  });
});

function initializeSelect2(selector, options = {}) {
  $(selector).select2({
    placeholder: options.placeholder || "Select or add item",
    allowClear: options.allowClear !== undefined ? options.allowClear : true,
    tags: options.tags !== undefined ? options.tags : true,
    createTag: function (params) {
      var term = $.trim(params.term);
      if (term.length < 2) {
        return null;
      }
      return {
        id: term,
        text: term,
        newOption: true,
      };
    },
    templateResult: function (data) {
      var $result = $("<span></span>");
      $result.text(data.text);
      if (data.newOption) {
        $result.append(" <em>(Create New Item)</em>");
      }
      return $result;
    },
  });
}

function selectedS2(source, target) {
  if ($(source).length > 0) {
    let selectS2 = $(source).val();
    selectS2 = JSON.parse(selectS2);
    selectS2 = JSON.parse(selectS2);
    if (Array.isArray(selectS2)) {
      $(target).val(selectS2).change();
      $(`${target} option`).each(function () {
        const value = $(this).val();
        if (selectS2.includes(value)) {
          $(this).prop("selected", true);
        }
      });
    }
  }
}

var no = 1;
$("#addRow").click(function () {
  $("#tambahin").append(`<div id="row${no}" class="row">
                <div class="col-md-2"><input type="text" name="title_file[]" placeholder="File Title" class="form-control"></div>
                <div class="col-md-1"><input type="text" name="url_file[]" placeholder="File URL" class="form-control"></div>
                <div class="col-md-2"><input type="text" name="desk_file[]" placeholder="Deskripsi File" class="form-control"></div>
                <div class="col-md-2"><select id="acc_type" class="form-control" name="akses_file[]">
                        <option value="Access to file" disabled selected hidden></option>
                        <option value="public" selected >private</option>
                        <option value="public">public</option>
                    </select></div>
                <div class="col-md-2"><select id="acc_member" class="form-control" name="akses_member[]">
                         <option value="0" selected>Batasi Akses</option>
                         <option value="1">Semua Anggota</option>
                    </select></div>
                <div class="col-md-2"><input type="file" name="attc_file[]" placeholder="File" class="form-control" onchange="return validExt(this,2097152,['pdf'])" accept="application/pdf"><small>Max PDF size 50 MB</small></div>
                <div class="col-sm-1"><button type="button" id="${no}" class="btn btn-danger btn-remove btn-block btn-sm"><i class="fa fa-minus"></i></button></div>
							</div>`);
  no++;
});

$(document).on("click", ".btn-remove", function () {
  var button_id = $(this).attr("id");
  $(`#row${button_id}`).remove();
});

function hapusAttahcment(b_id, f_id) {
  console.log(b_id);
  console.log(f_id);
  let x = confirm("Are you sure you want to delete this data?");
  if (x) {
    $.ajax({
      url: `${baseUrl}bibliography/attDelete`,
      type: "POST",
      data: {
        b_id: b_id,
        f_id: f_id,
      },
      dataType: "JSON",
      success: function (data) {
        window.location.reload();
      },
    });
  }
  const showModal = (e = null) => {
    $("#myModalLabel").text("Perbaharui Member ");
    $("#exp_date").val("");
    $(".hidden").html("");
    if (e !== null) {
      $("#myModalLabel").text("Ubah Lisensi");
      $("#exp_date").val(e.frequency);
      $(".hidden").html(
        `<input type="hidden" value="${e.frequency_id}" name="member_id">`
      );
    }
    $("#modal_action").modal("show");
  };
}

function openFileInNewTab(url) {
  window.open(baseUrl + "uploads/repository/" + url, "_blank");
}

const showConfirm = (id) => {
  let x = confirm("Yakin menghapus data?");
  if (x) {
    $.ajax({
      url: `${baseUrl}bibliography/docDelete`,
      type: "POST",
      data: {
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        window.location.reload();
      },
    });
  }
};

var activeSelect = null;
$(".select2ad").on("select2:select", function (e) {
  var selectedValue = e.params.data.id;

  if (selectedValue === "create_new") {
    activeSelect = $(this);
    var type = activeSelect.data("type");
    var type = $(this).data("type");
    var label = "Code ministry Pddikti";

    $("#modal-add-option .modal-title").text("Tambah " + label);
    $("#modal-label").text("Nama " + label + " Baru:");

    $("#modal-add-option").modal("show");
    $("#form-add-option").data("type", type);
  }
});

$("#form-add-option").on("submit", function (e) {
  e.preventDefault();
  var type = $(this).data("type");
  var postData;

  postData = {
    codenya: $("#codenya").val(),
    nama_prodi: $("#nama_prodi").val(),
    degree: $("#degree").val(),
    university: $("#university").val(),
    tbl: type,
  };

  $.ajax({
    url: `${baseUrl}bibliography/addmstry`,
    method: "POST",
    data: postData,
    success: function (response) {
      if (response.status === "success") {
        var newOptionId = response.data.id;
        var newOptionText = response.data.val;
        var newOption = new Option(newOptionText, newOptionId, false, true);
        var select2Element = $("select.select2ad[data-type='" + type + "']");

        select2Element.append(newOption);
        select2Element.select2();
        select2Element.val(newOptionId).trigger("change");

        $("#modal-add-option").modal("hide");
        $("#form-add-option")[0].reset();

        select2Element
          .find("option[value='create_new']")
          .prop("selected", false);
        select2Element.trigger("change");
        select2Element.trigger("change.select2");
        sNotif(response.title, response.message, response.status);
      } else {
        sNotif(response.title, response.message, response.status);
      }
    },
    error: function () {
      sNotif("Terjadi Kesalahan.", "Gagal Menambahkan opsi baru.", "error");
    },
  });
});
