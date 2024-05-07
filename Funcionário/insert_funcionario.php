<?php
echo "Inserindo os dados no banco de dados...<br>";
require ('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Nome: ";
    echo $nome = $_POST["nome"];
    echo "<br>";
    echo "Email: ";
    echo $email = $_POST["email"];
    echo "<br>";
    echo "Senha: ";
    echo $senha = $_POST["senha"];
    echo "<hr>";

    // Função para inserir um novo registro no banco de dados
    function inserirRegistro($conexao, $nome, $email, $senha) {
        $sql = "INSERT INTO funcionario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        return $stmt->execute();
    }

    if (inserirRegistro($conexao, $nome, $email, $senha)) {
        echo "Registro inserido com sucesso!<br>";
    } else {
        echo 'Erro ao inserir o registro.';
    }
}

?>