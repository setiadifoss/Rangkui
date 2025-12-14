const showModal = (e = null) => {
  $('#myModalLabel').text('New Frequency')
  $('#frequency').val('')
  $('#language_prefix').val('')
  $('#time_increment').val('')
  $('#time_unit').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Frequency')
    $('#frequency').val(e.frequency)
    $('#language_prefix').val(e.language_prefix)
    $('#time_increment').val(e.time_increment)
    $('#time_unit').val(e.time_unit)
    $('.hidden').html(
      `<input type="hidden" value="${e.frequency_id}" name="frequency_id">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/frequency/delete`,
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
