// Inisialisasi Select2 pada dropdown
$('#iconSelect').select2({
  templateResult: formatIcon, // Template untuk menampilkan ikon di dropdown
  templateSelection: formatIcon // Template untuk menampilkan ikon yang dipilih
})

// Function untuk menampilkan ikon di select2 dropdown
function formatIcon (option) {
  if (!option.id) {
    return option.text // Tampilkan teks biasa jika tidak ada id (misalnya opsi placeholder)
  }

  // Tambahkan ikon dan teks bersamaan
  var $option = $(
    '<span><i class="fa ' +
      option.element.value +
      '"></i> ' +
      option.text +
      '</span>'
  )

  return $option // Kembalikan opsi dengan ikon dan teks
}

// Update preview ketika ikon dipilih
$('#iconSelect').on('change', function () {
  var iconClass = 'fa ' + $(this).val()
  $('#iconPreview').empty()
  $('#iconPreview').attr('class', 'icon-preview ' + iconClass)
})

const showConfirm = id => {
  let x = confirm('Are you sure you want to delete this data?')
  if (x) {
    $.ajax({
      url: `${baseUrl}sistem/modul/delete`,
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
