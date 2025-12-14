const showModal = (e = null) => {
  $('#myModalLabel').text('New Ministry Code')
  $('#code_ministry').val('')
  $('#code_ministry').prop('readonly', false)
  $('#name_prodi').val('')
  $('#degree').val('')
  $('#university').val('')
  $('.hidden').html('')
  if (e !== null) {
    $('#myModalLabel').text('Edit Ministry Code')
    $('#code_ministry').val(e.code_ministry)
    $('#code_ministry').prop('readonly', true)
    $('#name_prodi').val(e.name_prodi)
    $('#degree').val(e.degree)
    $('#university').val(e.university)
    $('.hidden').html(
      `<input type="hidden" value="${e.code_ministry}" name="codeMinistryId">`
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
