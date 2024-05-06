<?php
echo "Inserindo dados abaixo... <br>";
require("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $Nomelanche = htmlspecialchars($_POST["Nomelanche"]);
    $Preco = htmlspecialchars($_POST["Preco"]);
    $Descricao = htmlspecialchars($_POST["Descricao"]);

    if (empty($Nomelanche) || empty($Preco) || empty($Descricao)) {
        echo "Erro: Todos os campos são obrigatórios.";
    } elseif (!is_numeric($Preco)) {
        echo "Erro: O preço deve ser um valor numérico.";
    } else {
        if (inserirRegistro($conexao, $Nomelanche, $Preco, $Descricao)) {
            echo "Registro inserido com sucesso! <br><a href='cadastro.php'>Home</a> | <a href='index.php'>VER TABELA</a>";
        } else {
            echo "Erro ao inserir Registro";
        }
    }
} else {
    echo "Método HTTP inválido.";
}

// Função para inserir no banco
function inserirRegistro($conexao, $Nomelanche, $Preco, $Descricao)
{
    try {
        $conexao->beginTransaction();

        $sql = "INSERT INTO lanche (Nomelanche, Preco, Descricao) VALUES (:Nomelanche, :Preco, :Descricao)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':Nomelanche', $Nomelanche, PDO::PARAM_STR);
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

