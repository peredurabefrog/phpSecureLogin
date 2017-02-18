var mainObject = {
    url: getHostStart() + "/php/userProcesses.php"
}

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
    console.log(request);
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
    var requestMessage = {
        messageName: "getSession"
    };

    dataLoad(mainObject.url, JSON.stringify(requestMessage), validateSession);
}


//check whether the user has an active session
function processLogout() {
    var requestMessage = {
        messageName: "processLogout"
    };

    dataLoad(mainObject.url, JSON.stringify(requestMessage), logoutSession);
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

function navigateTo(page) {
    window.location.href = page;
}
