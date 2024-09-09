import { Modal } from 'flowbite';

document.addEventListener('DOMContentLoaded', function () {
    const targetEl = document.getElementById('popup-modal');

    // Verifica se o elemento do modal existe
    if (targetEl) {
        const modal = new Modal(targetEl);

        // Adiciona eventos aos botões para abrir o modal
        const openButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                modal.show();
            });
        });

        // Adiciona eventos aos botões para fechar o modal
        const closeButtons = document.querySelectorAll('[data-modal-hide="popup-modal"]');
        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                modal.hide();
            });
        });
    } 

    // Validação do formulário
    const form = document.querySelector('form');
    if (form) {
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

        if (nameInput) {
            nameInput.addEventListener('input', validateName);
        }
        if (emailInput) {
            emailInput.addEventListener('input', validateEmail);
        }
        if (documentInput) {
            documentInput.addEventListener('input', validateDocument);
        }
        if (passwordInput) {
            passwordInput.addEventListener('input', validatePassword);
        }
        if (passwordConfirmationInput) {
            passwordConfirmationInput.addEventListener('input', validatePasswordConfirmation);
        }

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
    }
});
