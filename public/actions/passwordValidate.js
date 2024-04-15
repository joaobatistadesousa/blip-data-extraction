document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('#registerForm');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const passwordAgain = document.querySelector('#passwordAgain');
    const show_password_strongness = document.querySelector('#passwordStrong');
    const message = document.querySelector('#message');
    const validatePassword = () => {

        const passwordValue = password.value;

        const has8characters = passwordValue.length >= 8;
        const hasUppercase = /[A-Z]/.test(passwordValue);
        const hasLowercase = /[a-z]/.test(passwordValue);
        const hasNumber = /[0-9]/.test(passwordValue);
        const hasSpecialCharacter = /[!@#$%^&*(),.?":{}|<>]/.test(passwordValue);
        if (has8characters==false){
            show_password_strongness.textContent = 'A senha deve ter pelo menos 8 caracteres';
            show_password_strongness.style.color = 'red';

        }else if (hasUppercase==false){
            show_password_strongness.textContent = 'A senha deve ter pelo menos uma letra maiúscula';
            show_password_strongness.style.color = 'red';

        }else if (hasLowercase==false){
            show_password_strongness.textContent = 'A senha deve ter pelo menos uma letra minúscula';
            show_password_strongness.style.color = 'red';

        }
        else if (hasNumber==false){

            show_password_strongness.textContent = 'A senha deve ter pelo menos um número';
            show_password_strongness.style.color = 'red';

        }else if (hasSpecialCharacter==false){
            show_password_strongness.textContent = 'A senha deve ter pelo menos um caractere especial';
            show_password_strongness.style.color = 'red';

        }else {
            show_password_strongness.textContent = 'Senha forte';
            show_password_strongness.style.color = 'green';
        }
    }
    const verifypasswordConfirmation = () => {

        if (password.value != passwordAgain.value) {
            message.textContent = 'As senhas devem ser iguais';
            message.style.color = 'red';
        } else {
            message.textContent = 'As senhas conferem';
            message.style.color = 'green';
        }
    }


    password.addEventListener('input', validatePassword);
    passwordAgain.addEventListener('input', verifypasswordConfirmation);

})
