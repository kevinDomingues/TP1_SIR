<?php 
require_once './database/connection.php';
require_once './components/header.php';
require_once './components/nav.php';

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
<div class="bodyapontamentosforms">
    <div class="apontamentosformscontainer">     
        <div class="apontamentosformscard apontamentosformsfeed" style="min-width: 60%">
            <div class="apontamentosformscardsFeed">
                <div class="apontamentosformscard-body">
                    <div class="content" style="margin-bottom: 5%">
                        <h1>Criar Apontamento</h1>
                        <form action="login.php" action="login.php" method="POST">
                        <div>
                            <label for="">Tipo Lembrete</label>
                            <br>
                            <input style="width: 80%" type="email" name="lembrete" id="txt" aria-describedby="helpId" placeholder="Tipo" required>

                        </div>
                        <div>
                            <label for="">Descrição</label>
                            <br>
                            <input style="width: 80%" type="text" name="pass" id="txt" placeholder="Password" required>
                        </div>
                        <div>
                            <label for="">Informação</label>
                            <br>
                            <input style="width: 80%" type="text" name="pass" id="txt" placeholder="Password" required>
                        </div>
                        <div>
                            <label for="">Data</label>
                            <br>
                            <input style="width: 80%" type="text" name="pass" id="txt" placeholder="Password" required>
                        </div>
                        <div>
                            <label for="">Imagem</label>
                            <br>
                            <input style="width: 80%" type="file" name="image" id="txt" placeholder="Password" required>
                        </div>
                        <button style="width: 80%" type="submit" class="createButton">Login</button>
                        </form>
                        <?php if ($err): ?>
                        <div class="error">
                            <div><?php echo $err ?></div>
                        </div>
                        <?php endif ?>
                        <br>
                        <a class="btn" style="font-size: 16px" href="apontamentos.php">Voltar</a>
                    </div>                    
                </div>               
            </div>
        </div>
    </div>
</div>
</body>
</html>