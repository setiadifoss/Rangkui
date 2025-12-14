const showModal = (e = null) => {
  $('#myModalLabel').text('New Document Language')
  $('#language_id').val('')
  $('#language_id').prop('readonly', false)
  $('#language_name').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Document Language')
    $('#language_id').val(e.language_id)
    $('#language_id').prop('readonly', true)
    $('#language_name').val(e.language_name)
    $('.hidden').html(
      `<input type="hidden" value="${e.language_id}" name="languageId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/language/delete`,
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
