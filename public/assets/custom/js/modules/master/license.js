const showModal = (e = null) => {
  $('#myModalLabel').text('New License')
  $('#license_name').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit License')
    $('#license_name').val(e.license_name)
    $('.hidden').html(
      `<input type="hidden" value="${e.license_id}" name="license_id">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/license/delete`,
      type: 'POST',
      data: {
        id: id
      },
      dataType: 'JSON',
      success: function (data) {
        window.location.reload()
      }
    })
  }
}
