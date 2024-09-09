document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#editNoticiaForm');
    const nameInput = document.querySelector('#name');
    const descriptionInput = document.querySelector('#description');
    const imageInput = document.querySelector('#noticia_image');

    const nameError = document.querySelector('#nameError');
    const descriptionError = document.querySelector('#descriptionError');
    const imageError = document.querySelector('#imageError');

    nameInput.addEventListener('input', validateName);
    descriptionInput.addEventListener('input', validateDescription);
    imageInput.addEventListener('change', validateImage);

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
    function validateDescription() {
        const description = descriptionInput.value.trim();
        if (description === '') {
            descriptionError.textContent = 'A descrição é obrigatória.';
            return false;
        } else if (description.length < 8) {
            descriptionError.textContent = 'A descrição deve conter pelo menos 8 dígitos.';
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