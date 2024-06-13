function userValidate(event) {
    var email = document.getElementById('email').value;
    var password = document.getElementById('pass').value;
    var emailError = document.getElementById('emailError');
    var passError = document.getElementById('passError');

    var valid = true;

    if (email === "") {
        emailError.innerHTML = 'Email is empty';
        valid = false;
    }

    if (password === "") {
        passError.innerHTML = 'Password is empty';
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
        setTimeout(function() {
            emailError.innerHTML = "";
            passError.innerHTML = "";
        }, 2000);
    }

    return false;
}