<?php
    require ('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    // Função para deletar o registro no banco de dados
    function excluirRegistro($conexao, $id) {
        $sql = "DELETE FROM lanche WHERE id = $id";
        $stmt = $conexao->prepare($sql);
        return $stmt->execute();
    }
}
if (excluirRegistro($conexao, $id)) {
    echo "Registro excluído com sucesso!<br>" . "<a href='index.php'>HOME</a>";
} else {
    echo 'Erro ao excluir o registro.';
}
?>