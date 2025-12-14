const showModal = (e = null) => {
  $('#myModalLabel').text('New Place')
  $('#place_name').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Place')
    $('#place_name').val(e.place_name)
    $('.hidden').html(
      `<input type="hidden" value="${e.place_id}" name="place_id">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/place/delete`,
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
