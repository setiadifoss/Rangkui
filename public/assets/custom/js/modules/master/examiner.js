const showModal = (e = null) => {
  $('#myModalLabel').text('New Examiner')
  $('#examinerName').val('')
  $('#examinerNumber').val('')
  $('#examinerType').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Examiner')
    $('#examinerName').val(e.examiner_name)
    $('#examinerNumber').val(e.examiner_number)
    $('#examinerType').val(e.examiner_type)
    $('.hidden').html(
      `<input type="hidden" value="${e.examiner_id}" name="examinerId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/examiner/delete`,
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
