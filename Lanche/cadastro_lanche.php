<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Lanche</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <h2>Cadastro de Lanches</h2>

    <?php require("../conexao.php"); ?>

    <div class="container">
        <form action="create_lanche.php" method="POST">
            <div class="form-group">
                <label>Nome do Lanche</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome do lanche">
                <label>Preço</label>
                <input type="number" required step="any" class="form-control" id="Preco" name="Preco" placeholder="Informe o preço do lanche">
                <label>Descrição</label>
                <input type="text" class="form-control" id="Descricao" name="Descricao" placeholder="Informe a descrição do lanche">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
