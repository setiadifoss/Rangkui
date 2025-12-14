$(document).ready(function () {
  let btnAdvanceFilter = $('#adv-filter')

  btnAdvanceFilter.on('click', e => {
    let showMore = $('#show-more')

    showMore.slideToggle(400, function () {
      if (showMore.is(':visible')) {
        btnAdvanceFilter
          .text('Show less')
          .removeClass('btn-primary')
          .addClass('btn-danger')

        $('#gmd, #coll_type, #lang, #loc').select2({})
      } else {
        btnAdvanceFilter
          .text('Advanced filter')
          .removeClass('btn-danger')
          .addClass('btn-primary')
      }
    })
  })

  $('#titles-table').DataTable({})

  /**
   * Filtering
   */
  $('#frm-filter').on('submit', function (e) {
    e.preventDefault() // Prevent normal form submission

    // Collect form data
    var formData = $(this).serialize()

    // Send Ajax request
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      dataType: 'json',
      success: function (response) {
        // Clear the table body
        $('#titles-data').empty()

        const data = response.data
        // Populate table with new data
        if (data.length > 0) {
          $.each(data, function (index, item) {
            const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.title}</td>
                            <td>${item.place_name}</td>
                            <td>${item.publisher_name}</td>
                            <td>${
                              item.isbn_issn
                                ? new Date(item.isbn_issn)
                                    .toISOString()
                                    .split('T')[0]
                                : ''
                            }</td>
                            <td>${item.call_number}</td>
                        </tr>`

            $('#titles-data').append(row)
          })
        } else {
          $('#titles-data').append(
            '<tr><td colspan="6">No data found</td></tr>'
          )
        }
      },
      error: function (xhr, status, error) {
        alert('Something went wrong. Please try again.')
      }
    })
  })
})
