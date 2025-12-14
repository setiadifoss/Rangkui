const showModal = (e = null) => {
  $('#myModalLabel').text('New Publisher')
  $('#publisherName').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Publisher')
    $('#publisherName').val(e.publisher_name)
    $('.hidden').html(
      `<input type="hidden" value="${e.publisher_id}" name="penerbitId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/penerbit/delete`,
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
