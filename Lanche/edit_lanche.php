<?php
require('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Função para listar um registro específico do banco de dados
    function listarRegistro($conexao, $id) {
        $sql = "SELECT * FROM lanche WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar o registro do aluno
    $registro = listarRegistro($conexao, $id);

    // Verificar se o registro foi encontrado
    if ($registro) {
        $aux = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Lanche</title>
</head>
<body>
    <h1>Editar Lanche</h1>
    <?php if (isset($aux)) : ?>
        <form action="update_lanche.php" method="post">
            <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $registro['nome']; ?>" required>
            <br>
            <label>Preço:</label>
            <input type="number" required step="any" name="preco" value="<?php echo $registro['preco']; ?>" required>
            <br>
            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?php echo $registro['descricao']; ?>" required>
            <br>
            <input type="submit" value="Salvar">
        </form>
    <?php else : ?>
        <p>Lanche não encontrado.</p>
    <?php endif; ?>
</body>
</html>

