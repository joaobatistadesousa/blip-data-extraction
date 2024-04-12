<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Cadastro Administrativo</h2>
                <form id="registerForm" method="post" action="registerUserProcessa.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" placeholder="Seu nome" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Seu email"  name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" placeholder="Digite Uma senha" name="password" required>
                    </div>
                    <div id="show_password_strongness"></div>
                    <div class="mb-3">
                        <label for="password" class="form-label">digite novamente a senha</label>
                        <input type="password" class="form-control" id="passwordAgain" placeholder="Digite novamente a sua senha" name="passwordAgain" required>
                    </div>
                    <div id="message"></div>
                    <p class="mt-3">Ja possui uma conta? <a href="login.php">Login</a></p>
                    <button class=btn-primary>criar Conta</button>  
                    
                </form>
            </div>
        </div>
    </div>
    <script src="./utilities/actions/validateFormRegister.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
