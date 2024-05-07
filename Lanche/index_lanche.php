<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Lanche</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Lista de Lanches</h1>
    <a href="cadastro_lanche.php">Adicionar Novo Lanche</a>
    <?php
        require('../conexao.php');
        // Função para listar todos os registros do banco de dados
        function listarRegistros($conexao) {
            $sql = "SELECT * FROM lanche";
            $stmt = $conexao->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Listar registros
        $registros = listarRegistros($conexao);
        // Exibindo os dados em uma tabela
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Lanche</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>";
        foreach ($registros as $registro) {
            echo "<tr>
                    <td>{$registro['id']}</td>
                    <td>{$registro['nome']}</td>
                    <td>{$registro['preco']}</td>
                    <td>{$registro['descricao']}</td>
                    <td class='action-links'>
                        <a href='edit_lanche.php?id={$registro['id']}'>Editar</a>
                        <a href='delete_lanche.php?id={$registro['id']}'>Excluir</a>
                    </td>
                </tr>";
        }
        echo "</table>";
        echo "<br>";
        echo "Voltar para home: ";
        echo "<a href='../home.php'>Home</a>";
    ?>
</body>
</html>
