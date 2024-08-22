document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const nameInput = document.querySelector('#name');
    const emailInput = document.querySelector('#email');
    const documentInput = document.querySelector('#document');
    const passwordInput = document.querySelector('#password');
    const passwordConfirmationInput = document.querySelector('#password_confirmation');

    const nameError = document.querySelector('#nameError');
    const emailError = document.querySelector('#emailError');
    const documentError = document.querySelector('#documentError');
    const passwordError = document.querySelector('#passwordError');
    const passwordConfirmationError = document.querySelector('#passwordConfirmationError');

    nameInput.addEventListener('input', function () {
        validateName();
    });

    emailInput.addEventListener('input', function () {
        validateEmail();
    });

    documentInput.addEventListener('input', function () {
        validateDocument();
    });

    passwordInput.addEventListener('input', function () {
        validatePassword();
    });

    passwordConfirmationInput.addEventListener('input', function () {
        validatePasswordConfirmation();
    });

    form.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateName() {
        const name = nameInput.value.trim();
        if (name === '') {
            nameError.textContent = 'O nome é obrigatório.';
            return false;
        } else if (name.length < 3) {
            nameError.textContent = 'O nome deve conter pelo menos 3 dígitos.';
            return false;
        } else {
            nameError.textContent = '';
            return true;
        }
    }

    function validateEmail() {
        const email = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            emailError.textContent = 'O e-mail é obrigatório.';
            return false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = 'O e-mail não é válido.';
            return false;
        } else {
            emailError.textContent = '';
            return true;
        }
    }

    function validateDocument() {
        documentInput.value = documentInput.value.replace(/\D/g, '').slice(0, 11);
        const document = documentInput.value.trim();
        if (document === '') {
            documentError.textContent = 'O documento é obrigatório.';
            return false;
        } else if (document.length !== 11) {
            documentError.textContent = 'O documento deve conter 11 dígitos.';
            return false;
        } else {
            documentError.textContent = '';
            return true;
        }
    }

    function validatePassword() {
        const password = passwordInput.value.trim();
        if (password === '') {
            passwordError.textContent = 'A senha é obrigatória.';
            return false;
        } else if (password.length < 8) {
            passwordError.textContent = 'A senha deve ter no mínimo 8 caracteres.';
            return false;
        } else {
            passwordError.textContent = '';
            return true;
        }
    }

    function validatePasswordConfirmation() {
        const password = passwordInput.value.trim();
        const passwordConfirmation = passwordConfirmationInput.value.trim();
        if (passwordConfirmation !== password) {
            passwordConfirmationError.textContent = 'As senhas não coincidem.';
            return false;
        } else {
            passwordConfirmationError.textContent = '';
            return true;
        }
    }

    function validateForm() {
        const isNameValid = validateName();
        const isEmailValid = validateEmail();
        const isDocumentValid = validateDocument();
        const isPasswordValid = validatePassword();
        const isPasswordConfirmationValid = validatePasswordConfirmation();

        return isNameValid && isEmailValid && isDocumentValid && isPasswordValid && isPasswordConfirmationValid;
    }
});
