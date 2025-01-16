export const showError = (field, message) => {
    const errorElement = document.createElement('p');
    errorElement.className = 'text-red-500 text-sm mt-1';
    errorElement.textContent = message;

    field.parentNode.appendChild(errorElement);

    field.classList.add('border-red-500');
};

export const clearErrors = (form) => {
    const errorMessages = form.querySelectorAll('.text-red-500');
    errorMessages.forEach((error) => error.remove());

    const errorFields = form.querySelectorAll('.border-red-500');
    errorFields.forEach((field) => field.classList.remove('border-red-500'));
};