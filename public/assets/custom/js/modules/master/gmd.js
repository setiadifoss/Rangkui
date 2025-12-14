const showModal = (e = null) => {
  $('#myModalLabel').text('New GMD')
  $('#gmdCode').val('')
  $('#gmdName').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit GMD')
    $('#gmdCode').val(e.gmd_code)
    $('#gmdName').val(e.gmd_name)
    $('.hidden').html(`<input type="hidden" value="${e.gmd_id}" name="gmdId">`)
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/gmd/delete`,
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
