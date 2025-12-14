const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}sistem/konten/delete`,
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
