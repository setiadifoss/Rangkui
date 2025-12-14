$('#mainForm').on('submit', function (e) {
  e.preventDefault()

  let r = confirm('Are you sure you want to save the configuration changes?')

  if (r) {
    this.submit()
  } else {
    return false
  }
})

// update key
$('#frm-captcha').on('submit', function (e) {
  e.preventDefault() // Mencegah form untuk submit secara default

  // Mendapatkan nilai target, URI, dan method
  let target = $(this).attr('action') // Action dari form
  let targetURI = `${baseUrl}${target}` // Base URL + Action
  let method = $(this).attr('method') // Method dari form

  // Mengambil semua input form sebagai data
  let formData = $(this).serialize() // Serialisasi semua input form

  // Melakukan AJAX request
  $.ajax({
    url: targetURI, // URL tujuan dari variabel
    method: method, // Metode pengiriman (GET/POST, dll)
    data: formData, // Data dari input form
    success: function (response) {
      // Tindakan yang dilakukan jika berhasil
      if (response.status == 200) {
        new PNotify({
          title: 'Update Key',
          text: 'Update Key Sucesss',
          type: 'success',
          styling: 'bootstrap3'
        })
      } else {
        new PNotify({
          title: 'Update Key',
          text: 'Update Key Failed',
          type: 'error',
          styling: 'bootstrap3'
        })
      }
      // Anda bisa melakukan sesuatu dengan response ini, misalnya:
      // $("#result").html(response);
    },
    error: function (xhr, status, error) {
      // Tindakan jika terjadi error
      new PNotify({
        title: 'Update Key',
        text: error,
        type: 'error',
        styling: 'bootstrap3'
      })
    }
  })
})
