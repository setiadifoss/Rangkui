const showModal = (e = null) => {
  $('#myModalLabel').text('New Location')
  $('#location_id').val('')
  $('#location_id').prop('readonly', false)
  $('#location_name').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Location')
    $('#location_id').val(e.location_id)
    $('#location_id').prop('readonly', true)
    $('#location_name').val(e.location_name)
    $('.hidden').html(
      `<input type="hidden" value="${e.location_id}" name="LocationId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/location/delete`,
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
