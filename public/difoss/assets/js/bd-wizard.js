//Wizard Init

let form = $('#wizard')

form.steps({
  headerTag: 'h3',
  bodyTag: 'section',
  transitionEffect: 'none',
  stepsOrientation: 'vertical',
  titleTemplate: '<span class="number">#index#</span>',
  onStepChanging: function (event, currentIndex, newIndex) {
    // Jika akan menuju langkah kedua (index 2)
    if (newIndex === 2) {
      let installationType = $("input[name='purpose']:checked").val()
      var selectedOption = installationType

      // Cek pilihan dari langkah pertama
      $('#wizard-p-2').html('Loading ...')
      if (selectedOption === 'fresh') {
        $('#wizard-p-2').load('/install/fresh', () => {
          togglePassword()
        })
      } else if (selectedOption === 'upgrade') {
        $('#wizard-p-2').load('/install/upgrade', () => {
          togglePassword()
        })
      }
    }

    if (newIndex == 3) {
      $.get('/install/type-installation', function (data) {
        let tipe = data.type

        tipe = tipe.toLowerCase().replace(/\b[a-z]/g, function (letter) {
          return letter.toUpperCase()
        })

        var cnf = {}
        let htmlList
        $('#install-type').empty()

        $('input[data-config="db"]').each(function () {
          var name = $(this).attr('name') // Ambil nama input
          var value = $(this).val() // Ambil nilai input

          // Masukkan ke dalam objek dengan name sebagai indeks
          cnf[name] = value
        })

        if (tipe == 'Fresh') {
          $.post('/install/fresh', cnf, data => {
            cnf = data

            htmlList = '<ul>'
            for (let key in cnf) {
              htmlList += `<li>${key}: ${cnf[key]}</li>`
            }
            // htmlList += `<li>Connection: ${cnf}</li>`
            htmlList += '</ul>'

            $('#install-type').append(htmlList)
          })
        } else {
          $.post('/install/upgrade', cnf, data => {
            cnf = data

            htmlList = '<ul>'
            for (let key in cnf) {
              htmlList += `<li>${key}: ${cnf[key]}</li>`
            }
            htmlList += '</ul>'

            $('#install-type').append(htmlList)
          })
        }

        $('#install-type').text(tipe)
      })
    }

    return true // Izinkan langkah berubah
  },
  onFinishing: function (event, currentIndex) {
    return true // Izinkan form disubmit
  },
  onFinished: function (event, currentIndex) {
    let html =
      'Processing installation <i class="fa-solid fa-circle-notch fa-spin"></i>'
    $('a[href="#finish"]').html(html)

    const ul = document.createElement('ul')

    // Ambil data dari elemen #install-type
    let installType = $('#install-type').text()

    // Ambil nilai konfigurasi yang mungkin ada di dalam form atau di #install-type
    let config = {}
    $('#install-type li').each(function () {
      let text = $(this).text().split(':')
      if (text.length === 2) {
        let key = text[0].trim()
        let value = text[1].trim()
        config[key] = value
      }
    })

    // // Kirim data ke server
    $.ajax({
      url: '/install/process', // Sesuaikan dengan URL tujuan Anda
      type: 'POST',
      data: {
        installType: installType,
        config: config
      },
      success: function (response) {
        const resp = response

        if (resp.status == 'success') {
          $('a[href="#finish"]').text('Installation Complete')

          window.location.reload(true)
        } else {
          const li = document.createElement('li')
          li.textContent = resp.message
          ul.appendChild(li)

          const progress = document.getElementById('progress-install')

          progress.append(ul)
        }
      },
      error: function (error) {
        console.log('Installation failed. Please try again.')
      }
    })
  },
  saveState: true
})

function maskPassword (password) {
  const minLength = 5 // panjang minimal password untuk masking
  const visibleCount = 2 // jumlah karakter di awal dan akhir yang tetap terlihat

  if (password.length <= minLength) {
    // Jika password terlalu pendek, tidak perlu masking
    return password
  }

  const firstPart = password.slice(0, visibleCount) // bagian pertama yang terlihat
  const lastPart = password.slice(-visibleCount) // bagian terakhir yang terlihat
  const maskedPart = '*'.repeat(password.length - visibleCount * 2) // bagian tengah yang diganti dengan asterisk

  return firstPart + maskedPart + lastPart
}

function togglePassword () {
  if (document.getElementById('show-password')) {
    document
      .getElementById('show-password')
      .addEventListener('click', function (e) {
        if (document.getElementById('password').type == 'password') {
          document.getElementById('password').type = 'text'
          document.getElementById(
            'show'
          ).innerHTML = `<i class="fa fa-eye-slash"></i>`
        } else {
          document.getElementById('password').type = 'password'
          document.getElementById(
            'show'
          ).innerHTML = `<i class="fa fa-eye"></i>`
        }
      })
  }
}
