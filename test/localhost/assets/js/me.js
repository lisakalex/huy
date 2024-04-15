function checkPassword(str) {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}$/;
    return re.test(str);
}

function myFocusFunction(message) {
    document.getElementById(message).innerHTML = "";
}

const currentPassword = document.getElementById("currentPassword");
if (currentPassword) currentPassword.addEventListener("focus", myFocusFunction, true);

const newPassword = document.getElementById("newPassword");
if (newPassword) newPassword.addEventListener("focus", myFocusFunction, true);

const retypePassword = document.getElementById("retypePassword");
if (retypePassword) retypePassword.addEventListener("focus", myFocusFunction, true);

function validateFormPass() {
    var pw1 = document.getElementById("newPassword").value;
    var pw2 = document.getElementById("retypePassword").value;

    if (!checkPassword(pw1)) {
        document.getElementById("message1").innerHTML = "try again";
        return false;
    }

    if (pw1 !== pw2) {
        document.getElementById("message2").innerHTML = "try again";
        return false;
    } else {
        return true;
    }
}

$(document).on('keyup', '.password-strength', function (e) {
    var _this = $(e.currentTarget);
    var password = _this.val();
    var strength = 0;
    var lineBellow = _this.siblings('.line-strength');
    if (!$(lineBellow).hasClass('show')) {
        $(lineBellow).addClass('show');
    }
    if (password.length === 0 || password === "") {
        lineBellow.removeClass('show');
    }
    if (password.length <= 7) {
        lineBellow.removeClass('weak good strong');
        lineBellow.addClass('short');
        return 'Too short'
    }
    if (password.length > 7) strength += 1;
    if (password.match(/([a-z].)|(.[a-z])/)) strength += 1;
    if (password.match(/([A-Z].)|(.[A-Z])/)) strength += 1;
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1;
    if (password.match(/([^A-Za-z0-9])/)) strength += 1;

    if (strength < 4) {
        lineBellow.removeClass('short good strong');
        lineBellow.addClass('weak');
        return 'Weak'
    } else if (strength == 4) {
        lineBellow.removeClass('weak short strong');
        lineBellow.addClass('good');
        return 'Good'
    } else {
        lineBellow.removeClass('weak good short');
        lineBellow.addClass('strong');
        return 'Strong'
    }
});
