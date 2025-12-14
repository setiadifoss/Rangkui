const showModal = (e = null) => {
  $('#myModalLabel').text('New Collection Type')
  $('#coll_type_name').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Collection Type')
    $('#coll_type_name').val(e.coll_type_name)
    $('.hidden').html(
      `<input type="hidden" value="${e.coll_type_id}" name="coll_type_id">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/collection/delete`,
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
