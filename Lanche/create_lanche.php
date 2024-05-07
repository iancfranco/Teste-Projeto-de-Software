<?php
echo "Inserindo dados abaixo... <br>";
require("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $Preco = htmlspecialchars($_POST["Preco"]);
    $Descricao = htmlspecialchars($_POST["Descricao"]);

    if (empty($nome) || empty($Preco) || empty($Descricao)) {
        echo "Erro: Todos os campos são obrigatórios.";
    } elseif (!is_numeric($Preco)) {
        echo "Erro: O preço deve ser um valor numérico.";
    } else {
        if (inserirRegistro($conexao, $nome, $Preco, $Descricao)) {
            echo "Registro inserido com sucesso! <br><a href='../home.php'>Home</a> | <a href='index_lanche.php'>Ver lanches no banco de dados</a>";
        } else {
            echo "Erro ao inserir Registro";
        }
    }
} else {
    echo "Método HTTP inválido.";
}

// Função para inserir no banco
function inserirRegistro($conexao, $nome, $Preco, $Descricao)
{
    try {
        $conexao->beginTransaction();

        $sql = "INSERT INTO lanche (nome, Preco, Descricao) VALUES (:nome, :Preco, :Descricao)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':Preco', $Preco, PDO::PARAM_STR);
        $stmt->bindParam(':Descricao', $Descricao, PDO::PARAM_STR);

        $stmt->execute();
        $conexao->commit();
        return true;
    } catch (PDOException $e) {
        $conexao->rollBack();
        echo "Erro ao inserir Registro: " . $e->getMessage();
        return false;
    }
}
?>

