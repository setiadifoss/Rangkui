function showMm(authorId, authorName) {
  // Mencegah default behavior
  event.preventDefault();
  $("#jsmind").empty();
  // Kirim permintaan AJAX
  $.ajax({
    url: "path/to/your/controller", // Ganti dengan URL yang sesuai
    url: `${baseUrl}report/vizd/mindmap`,
    method: "POST",
    data: { author_id: authorId },
    success: function (response) {
      // Tangani respons di sini
      var mind = {
        meta: {
          name: "example",
          author: "Your Name",
          version: "1.0",
        },
        format: "node_tree",
        data: {
          id: authorId,
          topic: authorName,
          children: [],
        },
      };
      if (response.length > 0) {
        const booksData = JSON.parse(response[0].DATA);

        booksData.forEach((book) => {
          const bookNode = {
            id: book.id.toString(),
            topic: book.topic !== null ? book.topic : "-",
            children: Array.isArray(book.children)
              ? book.children.length > 0
                ? book.children.map((child) => ({
                    id: child.id.toString(),
                    topic: child.topic,
                  }))
                : []
              : [],
          };

          mind.data.children.push(bookNode);
        });
      }
      console.log(mind);
      var options = {
        container: "jsmind",
        editable: true,
        theme: "primary",
      };

      var jm = new jsMind(options);
      jm.show(mind);
    },
    error: function (xhr, status, error) {
      console.error("Error: ", error);
    },
  });
}
