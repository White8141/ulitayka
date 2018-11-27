// переключение количества путешественников
function printToolbar(message) {
    if (message != "") {
        document.querySelector('#toastMessage p').innerHTML = message;
        $('#toastMessage').show(500);
        setTimeout(function () {
            $('#toastMessage').slideUp(500);
        }, 2000);
    }
}
