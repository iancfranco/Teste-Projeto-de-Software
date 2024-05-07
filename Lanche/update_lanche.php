<?php
echo "Atualizando dados abaixo...  <br>";
require ('../conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    echo "<hr>";
 
    // Função para Atualizar o registro no banco de dados
    function atualizarRegistro($conexao, $id, $nome, $preco, $descricao) {
        $sql = "UPDATE lanche SET nome = '$nome', preco = '$preco', descricao = '$descricao' WHERE id = $id";
        $stmt = $conexao->prepare($sql);
        return $stmt->execute();
    }
}
if (atualizarRegistro($conexao, $id, $nome, $preco, $descricao)) {
    echo "Registro atualizado com sucesso!<br><br>" . "<a href='../home.php'>HOME<br><br></a>". "<a href='index_lanche.php'>Ver lanches adicionados</a>";
} else {
    echo 'Erro ao inserir o registro.';}
?>