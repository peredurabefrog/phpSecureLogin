//checks that user has logged in session at page load
$(document).ready(function () {
    getLoginSessionData();
});

//continue processing if session is active
function activeLoginSession() {}

//validate session that user has logged in
function validateSession(data) {
    if (
        (data.idUser >= 0) &&
        (data.idUser != null)
    ) {

    } else {
        navigateTo("index.html");
    }
}
