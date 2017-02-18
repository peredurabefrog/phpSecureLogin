//checks that user has logged in session at page load
$(document).ready(function () {
    getLoginSessionData();
});

//enter key can process login
$(document).on('pageinit', function (event) {
    $('input').keyup(function (e) {
        if (e.keyCode == 13) {
            $("#btn-login").click();
        }
    });
});

//validate session that user has logged in
function validateSession(data) {
    if (
        (data.idUser >= 0) &&
        (data.idUser != null)
    ) {
        activeLoginSession();
    }
}

//if active session then jump to secure page
function activeLoginSession() {
    navigateTo("securePage.html");
}

//prepares login information and calls login process
function processLogin() {
    var password = hex_sha512($("#password").val());
    var username = $("#email").val()
    authenticateUser(username, password);
}

//authenticates user
function authenticateUser(nameUser, passwordUser) {
    var requestMessage = {
        messageName: "processLogin",
        txtEmail: nameUser,
        hPassword: passwordUser
    };
    dataLoad(mainObject.url, JSON.stringify(requestMessage), dataLoadNextSteps);
}

//if user has been authenticated jump to secure page
function dataLoadNextSteps(responseMessage) {
    if ((responseMessage.status == 0) && (responseMessage.userId > 0)) {
        navigateTo("securePage.html");
    } else {
        $("#notification").html(responseMessage.msg);
    }
}
