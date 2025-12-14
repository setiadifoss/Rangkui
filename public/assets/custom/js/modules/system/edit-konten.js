$('#editor').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['Misc', ['undo', 'redo']],
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['fontname', ['fontname']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph', 'hr']],
    ['height', ['height']],
    ['picture', ['picture', 'link', 'video']]
  ]
})

$('#frm-konten').on('submit', function (e) {
  e.preventDefault()

  let r = confirm('Are you sure you want to modify this data?')

  if (r) {
    this.submit()
  }
})
