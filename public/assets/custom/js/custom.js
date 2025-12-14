$(".responsive").DataTable({
  responsive: true,
  language: {
    emptyTable: "Tidak ada data yang dapat ditampilkan",
    loadingRecords:
      "<i class='fa fa-spinner fa-pulse'></i> Harap menunggu - Sedang memuat ...",
    processing: "Memuat",
  },
});

$(".table-button").DataTable({
  responsive: true,
  language: {
    loadingRecords:
      "<i class='fa fa-spinner fa-pulse'></i> Please wait - loading ...",
    processing: "Loading",
  },
  dom:
    "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
  buttons: [
    {
      extend: "excelHtml5",
      text: '<i class="fa fa-file-excel-o"></i> Excel',
      titleAttr: "Report " + formatDate(new Date()),
    },
    {
      extend: "pdf",
      text: '<i class="fa fa-file-pdf-o"></i> PDF',
      titleAttr: "Report " + formatDate(new Date()),
    },
  ],
});

$(".select2").select2();

// untuk yang mau pakai button tapi punya fitur tag a
// bisa pakai konfirmasi
const moveTo = (url, messageConfirm = null) => {
  if (messageConfirm !== null) {
    let x = confirm(messageConfirm);
    if (x) {
      window.location.href = url;
    }
  } else {
    window.location.href = url;
  }
};

function formatDate(date) {
  const day = String(date.getDate()).padStart(2, "0");
  const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are zero-based
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

function sNotif(msg, text, status) {
  new PNotify({
    title: msg,
    text: text,
    type: status, // "success", "error", "info", "warning"
    styling: "bootstrap3",
  });
}
