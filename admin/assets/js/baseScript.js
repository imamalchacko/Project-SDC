apiUrl = "http://localhost/Workspace/Project-SDC/api/";

function authCheckLogin() {
    if (localStorage.getItem("authToken") == null) {
        // window.location.assign("index.html");
    } else {
        window.location.assign("index.html");
    }
}

function authCheckAdmin() {
    if (localStorage.getItem("authToken") == null) {
        window.location.assign("pages-login.html");
    }
}

function logout() {
    localStorage.removeItem("authToken");
    window.location.assign("pages-login.html");
}