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
        $('#item, #contributor_type').select2({})
      } else {
        btnAdvanceFilter
          .text('Advanced filter')
          .removeClass('btn-danger')
          .addClass('btn-primary')
      }
    })
  })

  $('#contributors-table').DataTable({
    language: {
      loadingRecords:
        "<i class='fa fa-spinner fa-pulse'></i> Please wait - loading ...",
      processing: 'Loading'
    }
  })

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
        $('#tbody-data').empty()

        const data = response.data
        // Populate table with new data
        if (data.length > 0) {
          $.each(data, function (index, item) {
            const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.title}</td>
                            <td>${item.item_type}</td>
                            <td>${item.subject}</td>
                            <td>${item.contributor}</td>
                            <td>${item.publish_year}</td>
                        </tr>`

            $('#tbody-data').append(row)
          })
        } else {
          $('#tbody-data').append('<tr><td colspan="6">No data found</td></tr>')
        }
      },
      error: function (xhr, status, error) {
        console.error('Something went wrong. Please try again.')
      }
    })
  })
})
