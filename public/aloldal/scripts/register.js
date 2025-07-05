const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('input[name="pw"]');

const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
const passwordConfirm = document.querySelector('input[name="pwConfirm"]');

togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    this.classList.toggle('bi-eye');
});

togglePasswordConfirm.addEventListener('click', function (e) {
    const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirm.setAttribute('type', type);

    this.classList.toggle('bi-eye');
});


