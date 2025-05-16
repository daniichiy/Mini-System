<?php
require_once "connect_db.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="css/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Tabela Alunos</title>
</head>
<body>
    <?php
        if(isset($_POST['busca'])){
            $pesquisa = $_POST['busca'];
        }else{
            $pesquisa = "";
        }

        $sql = "SELECT * FROM alunos WHERE nome LIKE '%$pesquisa%'";
        $dados = mysqli_query($connect, $sql);
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Pesquisar Alunos</h1>
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        <input class="form-control mr-sm-2" type="search" placeholder="Nome" aria-label="Pesquisar" name="busca" autofocus><br>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button><br><br>
                    </form>
                </nav>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Plano</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($linha = mysqli_fetch_assoc($dados)){
                            $id = $linha['id'];
                            $nome = $linha['nome'];
                            $telefone = $linha['telefone'];
                            $email = $linha['email'];
                            
                            $sql = "SELECT preco FROM planos WHERE id = (SELECT planoId FROM alunos WHERE id = $id)";
                            $resultado = mysqli_fetch_assoc( mysqli_query($connect, $sql));
                            $preco = $resultado ? $resultado['preco'] : ''; 

                            echo "<tr>
                                <th scope='row'>$nome</th>
                                <td>$telefone</td>
                                <td>$email</td>
                                <td>R$$preco</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
           </div> 
        </div>
    </div>
</body>
</html>