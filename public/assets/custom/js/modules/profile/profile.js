const showModal = (e) => {
    let social_media = e.social_media
    console.log(social_media);
    $('#myModalLabel').text('Edit Profile')
    $('#username').val(e.username)
    $('#username').prop('readonly', true);
    $('#realname').val(e.realname)
    $('#user_type').val(e.user_type)
    $('#email').val(e.email)
    $('#inputFacebook').val(social_media.fb)
    $('#inputTwitter').val(social_media.tw)
    $('#inputLinkedIn').val(social_media.li)
    $('#inputReddit').val(social_media.rd)
    $('#inputPinterest').val(social_media.pn)
    $('#inputGooglePlus').val(social_media.gp)
    $('#inputYouTube').val(social_media.yt)
    $('#inputBlog').val(social_media.bl)
    $('#inputYahooMessenger').val(social_media.ym)
    $('.hidden').html(`<input type="hidden" value="${e.user_id}" name="user_id">`)
    $('#modal_action').modal('show');
}
const confirm_pass = () => {

    const save_btn = document.getElementById('save_button')
    const pass = $('#passwd1').val()
    const cnf = $('#passwd2').val()
    if (pass.length > 0 || cnf.length > 0) {
        save_btn.disabled = true
        if (pass.length < 6) {
            $('#validation_pass').text('Password length must be at least 6 characters')
        } else {
            $('#validation_pass').text('')
        }
        if (pass !== cnf) {
            $('#validation_confirm_pass').text('Password are not matching')
        } else {
            $('#validation_confirm_pass').text('')
        }
        if ((pass === cnf) && (pass.length >= 6)) {
            save_btn.disabled = false
        }
    } else {
        save_btn.disabled = false
    }

}