const showModal = (e = null) => {
  $('#myModalLabel').text('Update Member ')
  $('#exp_date').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Update Expired Dates')
    $('#exp_date').val(e.expire_date)
    $('.hidden').html(
      `<input type="hidden" value="${e.member_id}" name="member_id">` +
        `<input type="hidden" value="${e.member_name}" name="member_name">`
    )
  }
  $('#modal_action').modal('show')
}

const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/codeministry/delete`,
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
