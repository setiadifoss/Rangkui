const showModal = (e = null) => {
  $('#myModalLabel').text('New Supervisor')
  $('#superName').val('')
  $('#supervisorNumber').val('')
  $('#supervisorYear').val('')
  $('#supervisorType').val('')
  $('#supervisorList').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Supervisor')
    $('#superName').val(e.supervisor_name)
    $('#supervisorNumber').val(e.supervisor_number)
    $('#supervisorYear').val(e.supervisor_year)
    $('#supervisorType').val(e.supervisor_type)
    $('#supervisorList').val(e.supervisor_list)
    $('.hidden').html(
      `<input type="hidden" value="${e.supervisor_id}" name="supervisorId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/supervisor/delete`,
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
