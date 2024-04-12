<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Criar Nova Senha</h2>
                <form action="createNewPasswordProcessa.php?id=<?php echo $_GET['id']; ?>" method="post">

                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div id="show_password_strongness"></div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Nova Senha:</label>
                        <input type="password" class="form-control" id="passwordAgain" name="passwordAgain" required>
                    </div>

                    <div id="message"></div>

                    <button type="submit" class="btn btn-primary">Salvar Nova Senha</button>
                </form>
            </div>
        </div>
    </div>
    <script src="./utilities/actions/validateFormRegister.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
