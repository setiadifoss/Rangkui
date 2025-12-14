const showModal = (e = null) => {
  $('#myModalLabel').text('New Author')
  $('#authorName').val('')
  $('#authorYear').val('')
  $('#authorityType').val('')
  $('#authList').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Author')
    $('#authorName').val(e.author_name)
    $('#authorYear').val(e.author_year)
    $('#authorityType').val(e.authority_type)
    $('#authList').val(e.auth_list)
    $('.hidden').html(
      `<input type="hidden" value="${e.author_id}" name="pengarangId">`
    )
  }
  $('#modal_action').modal('show')
}
const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}master/pengarang/delete`,
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
