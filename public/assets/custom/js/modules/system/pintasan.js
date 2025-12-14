$('#modul').on('change', function (e) {
  let id = $(this).val()
  $('#append-here').html(
    `<img src="${baseUrl}assets/images/loading2.gif" alt="loading..." style="width:20%;margin-left:40%;" />`
  )

  $('#append-here').load(`${baseUrl}sistem/pintasan/sub-menu`, {
    id
  })
})
