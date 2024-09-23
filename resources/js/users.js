import { Modal } from 'flowbite';

document.addEventListener('DOMContentLoaded', function () {
    const targetEl = document.getElementById('popup-modal');

    // Verifica se o modal existe
    if (targetEl) {
        const modal = new Modal(targetEl);

        // Adiciona eventos aos botões para abrir o modal
        const openButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                // Atualiza o action do formulário com o ID correto
                const deleteForm = document.getElementById('delete-user-form');
                const formAction = deleteForm.getAttribute('action').replace(':id', userId);
                deleteForm.setAttribute('action', formAction);

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

    const forms = document.querySelectorAll('form'); // Mudando para querySelectorAll para lidar com todos os forms
    forms.forEach(form => {
        const nameInput = form.querySelector('#name');
        const emailInput = form.querySelector('#email');
        const documentInput = form.querySelector('#document');
        const passwordInput = form.querySelector('#password');
        const passwordConfirmationInput = form.querySelector('#password_confirmation');

        const nameError = form.querySelector('#nameError');
        const emailError = form.querySelector('#emailError');
        const documentError = form.querySelector('#documentError');
        const passwordError = form.querySelector('#passwordError');
        const passwordConfirmationError = form.querySelector('#passwordConfirmationError');

        if (nameInput) {
            nameInput.addEventListener('blur', validateName);
        }
        if (emailInput) {
            emailInput.addEventListener('blur', validateEmail);
        }
        if (documentInput) {
            documentInput.addEventListener('input', validateDocument);
        }
        if (passwordInput) {
            passwordInput.addEventListener('blur', validatePassword);
        }
        if (passwordConfirmationInput) {
            passwordConfirmationInput.addEventListener('blur', validatePasswordConfirmation);
        }

        form.addEventListener('submit', function (event) {
            const isValid = validateForm();

            if (!isValid) {
                event.preventDefault(); // Impede o envio do formulário se houver erros
                showErrors(); // Exibe os erros imediatamente
            }
        });

        function validateName() {
            const name = nameInput.value.trim();
            if (name === '') {
                nameError.textContent = 'O nome é obrigatório.';
                nameError.style.display = 'block';
                return false;
            } else if (name.length < 3) {
                nameError.textContent = 'O nome deve conter pelo menos 3 dígitos.';
                nameError.style.display = 'block';
                return false;
            } else {
                nameError.textContent = '';
                nameError.style.display = 'none';
                return true;
            }
        }

        function validateEmail() {
            const email = emailInput.value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '') {
                emailError.textContent = 'O e-mail é obrigatório.';
                emailError.style.display = 'block';
                return false;
            } else if (!emailPattern.test(email)) {
                emailError.textContent = 'O e-mail não é válido.';
                emailError.style.display = 'block';
                return false;
            } else {
                emailError.textContent = '';
                emailError.style.display = 'none';
                return true;
            }
        }

        function validateDocument() {
            documentInput.value = documentInput.value.replace(/\D/g, '').slice(0, 11);
            const document = documentInput.value.trim();
            if (document === '') {
                documentError.textContent = 'O documento é obrigatório.';
                documentError.style.display = 'block';
                return false;
            } else if (document.length !== 11) {
                documentError.textContent = 'O documento deve conter 11 dígitos.';
                documentError.style.display = 'block';
                return false;
            } else {
                documentError.textContent = '';
                documentError.style.display = 'none';
                return true;
            }
        }

        function validatePassword() {
            const password = passwordInput.value.trim();
            if (password === '') {
                passwordError.textContent = 'A senha é obrigatória.';
                passwordError.style.display = 'block';
                return false;
            } else if (password.length < 8) {
                passwordError.textContent = 'A senha deve ter no mínimo 8 caracteres.';
                passwordError.style.display = 'block';
                return false;
            } else {
                passwordError.textContent = '';
                passwordError.style.display = 'none';
                return true;
            }
        }

        function validatePasswordConfirmation() {
            const password = passwordInput.value.trim();
            const passwordConfirmation = passwordConfirmationInput.value.trim();
            if (passwordConfirmation !== password) {
                passwordConfirmationError.textContent = 'As senhas não coincidem.';
                passwordConfirmationError.style.display = 'block';
                return false;
            } else {
                passwordConfirmationError.textContent = '';
                passwordConfirmationError.style.display = 'none';
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

        function showErrors() {
            validateName();
            validateEmail();
            validateDocument();
            validatePassword();
            validatePasswordConfirmation();
        }
    });
});
