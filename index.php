
    <?php
        require('conexao.php');

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
                    <th>Nomelanche</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>";
        foreach ($registros as $registro) {
            echo "<tr>
                    <td>{$registro['id']}</td>
                    <td>{$registro['Nomelanche']}</td>
                    <td>R$ {$registro['Preco']}</td>
                    <td>{$registro['Descricao']}</td>
                    <td class='action-links'>
                        <a href='update.php?id={$registro['id']}'>Editar</a>
                        <a href='delete.php?id={$registro['id']}'>Excluir</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    ?>

