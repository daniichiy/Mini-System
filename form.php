<?php
require_once "connect_db.php";

//função para imprimir uma mensagem, o tipo pode ser do primary até o dark(bootstrap)
function mensagem($texto, $tipo){
    echo "<div class='alert alert-$tipo' role'='alert'>$texto</div>";
}

if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $plano = $_POST['plano'];

    //insere no banco de dados
    $sql = "INSERT INTO `alunos` (`nome`, `telefone`, `email`, `planoId`)
            VALUES ('$nome', '$telefone', '$email', '$plano')";

    //confere se foi inserido no bd
    if(mysqli_query($connect, $sql)){
        mensagem("$nome cadastrado com sucesso", 'success');
    } else{
        mensagem("$nome NÃO cadastrado", 'danger');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="css/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <title>Inscrição</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Inscrição</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text"  name ="nome" class="form-control" required>
                    </div><br>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name ="telefone" class="form-control" required>
                    </div><br>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name ="email" class="form-control" required>
                    </div><br>
                    <div class="form-group">
                        <label for="plano">Planos</label>
                        <select class="form-control" name="plano" id="plano">
                            <option>Selecione</option>
                            <option value="1">Plano 1</option>
                            <option value="2">Plano 2</option>
                            <option value="3">Plano 3</option>
                            <option value="4">Plano 4</option>
                        </select>
                    </div><br>
                    <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>