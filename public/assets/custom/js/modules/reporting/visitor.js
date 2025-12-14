$('#reportTable').DataTable({
  responsive: true
})
const withFilter = () => {
  let type = $('#filter-type').find(':selected').val()
  let start = $('#filter-start-date').val()
  let end = $('#filter-end-date').val()
  console.log('start', start);
  console.log('end', end);
  $.ajax({
    url: `${baseUrl}report/visitor/filter`,
    method: 'post',
    data: {
      filter: type,
      start: start,
      end: end
    },
    success: function (resp) {
      const respData = resp.data

      // Hancurkan DataTable jika sudah ada
      if ($.fn.DataTable.isDataTable('#reportTable')) {
        $('#reportTable').DataTable().clear().destroy()
      }

      // Buat DataTable baru
      const table = $('#reportTable').DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
          {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            titleAttr: 'Daftar Pengunjung ' + formatDate(new Date()),
          },
        ],
        data: respData,
        responsive: true
      })
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error('AJAX error:', textStatus, errorThrown)
    }
  })
}
