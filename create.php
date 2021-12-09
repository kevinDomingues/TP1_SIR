<?php 
require_once './database/connection.php';

$nome = '';
$desc = '';
$preco = '';

$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $nome = $_POST['nome'];
    $desc = $_POST['desc'];
    $preco = $_POST['preco'];

    if(!$nome) {
        $erros[] = 'O nome é obrigatório';
    }

    if(!$preco) {
        $erros[] = 'O preco é obrigatório';
    }

    if(empty($erros)){
        $statement = $pdo->prepare("INSERT INTO produto (nome, descricao, preco) 
                VALUES (:nome, :desc, :preco)");

        $statement->bindValue(':nome', $nome);
        $statement->bindValue(':desc', $desc);
        $statement->bindValue(':preco', $preco);

        $statement->execute();
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Criar Produto</h1>

        <?php if (!empty($erros)): ?>
        <div class="alert alert-danger">
            <?php foreach ($erros as $err) : ?>
               <div><?php echo $err ?></div>
            <?php endforeach ?> 
        </div>
        <?php endif ?>

        <a href="index.php" class="btn btn-outline-success mt-3">Ver produtos</a>

        <form class="mt-5" action="create.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nome ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descricao</label>
                <textarea id="desc" name="desc" class="form-control" value="<?php echo $desc ?>"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="number" id="preco" name="preco" step=".01" class="form-control" value="<?php echo $preco ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cria produto</button>
        </form>
    </div>
</body>
</html>