const showModal = (e = null) => {
  $('#myModalLabel').text('New Item Status')
  $('#item_status_id').val('')
  $('#item_status_id').prop('readonly', false)
  $('#item_status_name').val('')
  $('#rules1').prop('checked', false)
  $('#rules2').prop('checked', false)
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Item Status')
    $('#item_status_id').val(e.item_status_id)
    $('#item_status_id').prop('readonly', true)
    $('#item_status_name').val(e.item_status_name)
    if (e.no_loan == 1) {
      $('#rules1').prop('checked', true)
    }
    if (e.skip_stock_take == 1) {
      $('#rules2').prop('checked', true)
    }
    $('.hidden').html(
      `<input type="hidden" value="${e.item_status_id}" name="itemStatusId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/statusitem/delete`,
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
