$(document).ready(function () {
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
                    <td>${item.realname}</td>
                    <td>${item.username}</td>
                    <td>${item.biblio_total}</td>
                    <td>${item.item_total}</td>
                    <td>${item.member_total}</td>
                    <td>${item.circulation_total}</td>
                </tr>`

            $('#tbody-data').append(row)
          })
        } else {
          $('#tbody-data').append('<tr><td colspan="6">No data found</td></tr>')
        }
      },
      error: function (xhr, status, error) {
        console.log('Something went wrong. Please try again.')
      }
    })
  })
})
