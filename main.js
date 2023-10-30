let passwordField = document.querySelector(".password-field");
let passwordInputBox = passwordField.querySelector("input");

passwordInputBox.addEventListener('focus', (e) => {
    passwordField.style.marginTop = '35px';
})

passwordInputBox.addEventListener('focusout', (e) => {
    if (passwordInputBox.value.length === 0) {
        passwordField.style.marginTop = '18px';
    }
})