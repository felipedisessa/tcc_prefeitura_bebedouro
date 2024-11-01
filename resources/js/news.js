import { Modal } from 'flowbite';

document.addEventListener('DOMContentLoaded', function () {
    const targetEl = document.getElementById('popup-modal');

    if (targetEl) {
        const modal = new Modal(targetEl);

        const openButtons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');
        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                const noticiaId = this.getAttribute('data-id');

                const deleteForm = document.getElementById('delete-noticia-form');
                const formAction = deleteForm.getAttribute('action').replace(':id', noticiaId);
                deleteForm.setAttribute('action', formAction);

                modal.show();
            });
        });

        const closeButtons = document.querySelectorAll('[data-modal-hide="popup-modal"]');
        closeButtons.forEach(button => {
            button.addEventListener('click', function () {
                modal.hide();
            });
        });
    }

    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const nameInput = form.querySelector('#name');
        const descriptionInput = form.querySelector('#description');
        const imageInput = form.querySelector('#noticia_image');

        const nameError = form.querySelector('#nameError');
        const descriptionError = form.querySelector('#descriptionError');
        const imageError = form.querySelector('#imageError');

        if (nameInput) {
            nameInput.addEventListener('blur', validateName);
        }
        if (descriptionInput) {
            descriptionInput.addEventListener('blur', validateDescription);
        }
        if (imageInput) {
            imageInput.addEventListener('change', validateImage);
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
                nameError.textContent = 'O nome deve conter pelo menos 3 caracteres.';
                return false;
            } else {
                nameError.textContent = '';
                return true;
            }
        }

        function validateDescription() {
            const description = descriptionInput.value.trim();
            if (description === '') {
                descriptionError.textContent = 'A descrição é obrigatória.';
                return false;
            } else if (description.length < 8) {
                descriptionError.textContent = 'A descrição deve conter pelo menos 8 caracteres.';
                return false;
            } else {
                descriptionError.textContent = '';
                return true;
            }
        }

        function validateImage() {
            const files = imageInput.files;
            let isValid = true;
            imageError.textContent = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.name.match(/\.(jpg|jpeg|png|gif)$/i)) {
                    imageError.textContent = 'As imagens devem ser do tipo: jpeg, png, jpg, gif.';
                    isValid = false;
                } else if (file.size > 2048 * 1024) { // 2MB
                    imageError.textContent = 'Cada imagem deve ter no máximo 2MB.';
                    isValid = false;
                }
            }
            return isValid;
        }

        function validateForm() {
            const isNameValid = validateName();
            const isDescriptionValid = validateDescription();
            const isImageValid = validateImage();

            return isNameValid && isDescriptionValid && isImageValid;
        }
    });
});
