//get host start for the url of the request
function getHostStart() {
    var protocol = $(location).attr('protocol');
    var hostname = $(location).attr('hostname');
    var path = $(location).attr('pathname');
    path = path.split("/")
    path.splice(path.length - 1, 1);
    path = path.join("/");

    var fullPath = protocol + "//" + hostname + path;
    return fullPath;
}

//Load data from database
function dataLoad(url, request, dataProcessingFunction) {
    var posting = $.post(url, request, null, "json");
    posting.done(function (data) {
        dataProcessingFunction(data);
    });
    posting.fail(function () {
        alert("Sorry, there are some network issues. Please try again...");
    });
}

//check whether the user has an active session
function getLoginSessionData() {
    var url = getHostStart() + "/php/ProcessGetSession.php";
    var requestMessage = {
        messageName: "getSession"
    };

    dataLoad(url, JSON.stringify(requestMessage), validateSession);
}


//check whether the user has an active session
function processLogout() {
    var url = getHostStart() + "/php/ProcessLogout.php";
    var requestMessage = {
        messageName: "processLogout"
    };

    dataLoad(url, JSON.stringify(requestMessage), logoutSession);
}

//validate session that user has logged in
function logoutSession(data) {
    if (
        (data.status == -1)
    ) {
        alert('succesful logout');
        navigateTo("index.html");
    } else {
        alert('server error please try agian');
    }
}

//navigate to next page
function navigateTo(page) {
    window.location.href = page;
}
