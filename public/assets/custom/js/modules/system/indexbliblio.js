$('#index_type').on('change', function () {
  let type = $(this).val()

  $.ajax({
    url: `${baseUrl}sistem/indeks-biblio/check`,
    method: 'post',
    data: { type },
    success: function (data) {
      let m = data.message

      $('#message').html(m)

      if (data.status == 'success') {
        $('#btn-add').prop('disabled', '')
      } else {
        $('#btn-add').prop('disabled', 'disabled')
      }
    }
  })
})
