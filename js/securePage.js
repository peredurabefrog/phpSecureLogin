//checks that user has logged in session at page load
$(document).ready(function () {
    getLoginSessionData();
});

//continue processing if session is active
function activeLoginSession() {
    var url = getHostStart() + "/php/ProcessUserAction.php";
    var requestMessage = {
        messageName: "otherAPIRequest",
        currentTime: new Date()
    };
    dataLoad(url, JSON.stringify(requestMessage), visualizeResponse);
}

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

function visualizeResponse(data) {
    $('#secureResponse').html(JSON.stringify(data));
}
