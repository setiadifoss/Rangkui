const showModal = (e = null) => {
  $('#myModalLabel').text('New Subject')
  $('#topic').val('')
  $('#classification').val('')
  $('#topic_type').val('')
  $('#auth_list').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Subject')
    $('#topic').val(e.topic)
    $('#classification').val(e.classification)
    $('#topic_type').val(e.topic_type)
    $('#auth_list').val(e.auth_list)
    $('.hidden').html(
      `<input type="hidden" value="${e.topic_id}" name="topic_id">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/subject/delete`,
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
