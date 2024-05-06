<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotemig_fit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <h2>Atualizar lanche</h2>

    <?php require("conexao.php"); ?>

    <div class="container">
        <form action="update.php" method="POST">
            <div class="form-group">
                <label>ID do Lanche:</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="Informe o ID do lanche a ser atualizado">
                <label>Nome do Lanche:</label>
                <input type="text" class="form-control" id="Nomelanche" name="Nomelanche" placeholder="Informe o nome do lanche">
                <label>Preço:</label>
                <input type="number" step="0.01" class="form-control" id="Preco" name="Preco" placeholder="Informe o preço do lanche">
                <label>Descrição:</label>
                <input type="text" class="form-control" id="Descricao" name="Descricao" placeholder="Informe a descrição do lanche">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Atualizando dados abaixo...  <br>";
        require ('conexao.php');

        $id = isset($_POST["id"]) ? $_POST["id"] : '';
        $nomeLanche = $_POST["Nomelanche"];
        $preco = $_POST["Preco"];
        $descricao = $_POST["Descricao"];
        echo "<hr>";
     
        // Função para Atualizar o registro no banco de dados
        function atualizarRegistro($conexao, $id, $nomeLanche, $preco, $descricao) {
            $sql = "UPDATE lanche SET NomeLanche = :nomeLanche, Preco = :preco, Descricao = :descricao WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nomeLanche', $nomeLanche, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            return $stmt->execute();
        }

        if (atualizarRegistro($conexao, $id, $nomeLanche, $preco, $descricao)) {
            echo "Registro atualizado com sucesso!<br>" . "<a href='cadastro.php'>HOME<br></a>". "<a href='index.php'>ver tabela</a>";
        } else {
            echo 'Erro ao atualizar o registro.';
        }
    }
    ?>
</body>
</html>




