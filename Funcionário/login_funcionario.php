<?php
session_start(); // Inicia a sessão para armazenar os dados do usuário logado

require('../conexao.php'); // Conecta ao banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOuNome = $_POST["emailOuNome"];
    $senha = $_POST["senha"];

    // Consulta para verificar se o email ou o nome estão no banco de dados
    $query = "SELECT * FROM funcionario WHERE email = :email OR nome = :nome";
    $statement = $conexao->prepare($query);
    $statement->bindParam(':email', $emailOuNome);
    $statement->bindParam(':nome', $emailOuNome);
    $statement->execute();
    $usuario = $statement->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verifica se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta, redireciona para a página home.php
            $_SESSION['usuario'] = $usuario; // Armazena os dados do usuário na sessão
            header("Location: ../home.php"); // Redireciona para a página home.php
            exit();
        } else {
            $erro = "Senha incorreta";
        }
    } else {
        $erro = "Email ou nome não encontrado!!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($erro)) echo "<div>$erro</div>"; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>Email ou Nome:</label>
        <input type="text" name="emailOuNome" required><br><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
