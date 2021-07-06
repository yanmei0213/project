function validateLoginForm() {
    var username = document.forms["loginForm"]["idusername"].value;
    var password = document.forms["loginForm"]["idpassword"].value;
    if ((username === "") || (password === "")) {
        alert("Please fill out your username/password");
        return false;
    }
}

function validateRegisterForm() {
    var username = document.forms["registerForm"]["idusername"].value;
    var password = document.forms["registerForm"]["idpassword"].value;
    if ((username === "") || (password === "")) {
        alert("Please fill out your username/password");
        return false;
    }
    var email = document.forms["registerForm"]["idemail"].value;
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(String(email))) {
        alert("Please correct your email");
        return false;
    }
}
