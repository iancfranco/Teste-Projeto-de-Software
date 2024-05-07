<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO FUNCIONÁRIO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<?php require ("../conexao.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmarSenha"];

    // Hash the password
    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    if ($senha != $confirmarSenha) {
        echo "<script>alert('A senha e a confirmação da senha não coincidem!');</script>";
    } else {
        try {
            $query = "INSERT INTO funcionario (nome, email, senha) VALUES (:nome, :email, :senha)";
            $statement = $conexao->prepare($query);
            $statement->bindParam(':nome', $nome);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':senha', $hashedSenha);

            if ($statement->execute()) {
                echo "<script>alert('Cadastro realizado com sucesso! Espere 5 segundos.');</script>";
                header("Location: ../home.php");
            } else {
                echo "<script>alert('Erro ao cadastrar usuário. Por favor, tente novamente mais tarde.');</script>";
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}
?>

<div class="container">
    <h2>CADASTRO DE FUNCIONÁRIO</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" placeholder="Informe o nome" required><br>
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Informe o email" required><br>
            <label>Insira a Senha</label>
            <input type="password" name="senha" class="form-control" placeholder="Informe a senha" required><br>
            <label>Confirme a Senha</label>
            <input type="password" name="confirmarSenha" class="form-control" placeholder="Confirme a senha" required><br>
        </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $senha != $confirmarSenha) {
                echo "<div class='alert alert-danger'>A senha e a confirmação da senha não coincidem!</div>";
            }
        ?>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
</body>
</html>