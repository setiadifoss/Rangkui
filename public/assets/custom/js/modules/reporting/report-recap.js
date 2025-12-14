$(document).ready(function () {
  $('#recap-table').DataTable({
    responsive: true
  })
  $('#filter-type').on('change', function (e) {
    let type = $(e.target).find(':selected').val()

    $.ajax({
      url: `${baseUrl}report/recap/filter`,
      method: 'post',
      data: {
        filter: type
      },
      success: function (resp) {
        const respData = resp.data

        // Hancurkan DataTable jika sudah ada
        if ($.fn.DataTable.isDataTable('#recap-table')) {
          $('#recap-table').DataTable().clear().destroy()
        }

        // Buat DataTable baru
        const table = $('#recap-table').DataTable({
          dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          buttons: [
            {
              extend: 'excelHtml5',
              text: '<i class="fa fa-file-excel-o"></i> Excel',
              titleAttr: 'Recapitulation Report ' + formatDate(new Date())
            }
          ],
          data: respData
        })
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error('AJAX error:', textStatus, errorThrown)
      }
    })
  })
})
