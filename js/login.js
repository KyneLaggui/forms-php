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

// For toggling show password
let toggleIcons = document.querySelectorAll('.toggle-password');
let showPasswordIcon = document.querySelector('.fa-eye');
let hidePassowrdIcon = document.querySelector('.fa-eye-slash');

toggleIcons.forEach((elem) => {
    elem.addEventListener('click', togglePassword);
})

function togglePassword() {
    console.log('okay');
    if (passwordInputBox.type === "password") {
        passwordInputBox.type = "text";
        showPasswordIcon.classList.add('active');
        hidePassowrdIcon.classList.remove('active');
    } else {
        passwordInputBox.type = "password";
        showPasswordIcon.classList.remove('active');
        hidePassowrdIcon.classList.add('active');
    }
}