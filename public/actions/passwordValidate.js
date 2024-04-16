document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('#registerForm');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const passwordAgain = document.querySelector('#passwordAgain');
    const show_password_strongness = document.querySelector('#passwordStrong');
    const registerButton = document.querySelector('#registerButton');
    const message = document.querySelector('#message');
    const validatePassword = () => {

        const passwordValue = password.value;

        const has8characters = passwordValue.length >= 8;
        const hasUppercase = /[A-Z]/.test(passwordValue);
        const hasLowercase = /[a-z]/.test(passwordValue);
        const hasNumber = /[0-9]/.test(passwordValue);
        const hasSpecialCharacter = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
        if (has8characters == false) {
            show_password_strongness.textContent = 'A senha deve ter pelo menos 8 caracteres';
            show_password_strongness.style.color = 'red';
            return false

        } else if (hasUppercase == false) {
            show_password_strongness.textContent = 'A senha deve ter pelo menos uma letra maiúscula';
            show_password_strongness.style.color = 'red';
            return false

        } else if (hasLowercase == false) {
            show_password_strongness.textContent = 'A senha deve ter pelo menos uma letra minúscula';
            show_password_strongness.style.color = 'red';
            return false

        } else if (hasNumber == false) {

            show_password_strongness.textContent = 'A senha deve ter pelo menos um número';
            show_password_strongness.style.color = 'red';
            return false
        } else if (hasSpecialCharacter == false) {
            show_password_strongness.textContent = 'A senha deve ter pelo menos um caractere especial';
            show_password_strongness.style.color = 'red';
            return false

        } else {
            show_password_strongness.textContent = 'Senha forte';
            show_password_strongness.style.color = 'green';
            return true
        }
    }
    const verifyPasswordConfirmation = () => {

        if (password.value != passwordAgain.value) {
            message.textContent = 'As senhas devem ser iguais';
            message.style.color = 'red';
            return false
        } else {
            message.textContent = 'As senhas conferem';
            message.style.color = 'green';
            return true
        }
    }

    form.addEventListener('submit', (event) => {
        if (validatePassword() && verifyPasswordConfirmation()) {
            return true; // Permite a submissão do formulário
        } else {
            event.preventDefault(); // Impede a submissão do formulário
            registerButton.setAttribute('disabled', 'disabled'); // Desabilita o botão de registro
            return false;
        }
    });

    password.addEventListener('input', () => {
        if (password.value === passwordAgain.value) {
            message.textContent = 'As senhas conferem';
            message.style.color = 'green';
            registerButton.removeAttribute('disabled');
        } else {
            message.textContent = '';
            registerButton.setAttribute('disabled', 'disabled');
        }
        validatePassword();
    });
    passwordAgain.addEventListener('input', () => {
        if (password.value === passwordAgain.value) {
            message.textContent = 'As senhas conferem';
            message.style.color = 'green';
            registerButton.removeAttribute('disabled');
        } else {
            message.textContent = '';
            registerButton.setAttribute('disabled', 'disabled');
        }
        verifyPasswordConfirmation();
    });

});
