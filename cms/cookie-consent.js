$(document).ready(function() {
    $('#acceptCookiesBtn').click(function() {
        document.cookie = "cookie_consent=yes; path=/; max-age=" + (60 * 60 * 24 * 365);

        $('#cookiePopup').hide();
    });
});
