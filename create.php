<?php 
require_once './database/connection.php';
require_once './components/header.php';
require_once './components/nav.php';

session_start();

if (empty($_SESSION['id_email'])) {
    header('location: login.php');
}

$statement = $pdo->prepare("SELECT * FROM tipoapontamento");
$statement->execute();

$tipos = $statement->fetchAll(PDO::FETCH_ASSOC);

$id_tipoApontamento = '';
$descricao = '';
$informacao = '';
$dataCriacao = '';
$image_path = '';

$img_ready = false;
$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $id_tipoApontamento = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $informacao = $_POST['informacao'];
    $dataCriacao = $_POST['data'];

    if(isset($_FILES['image_file'])) {
      $img_name = $_FILES['image_file']['name'];
      $img_size = $_FILES['image_file']['size'];
      $tmp_name = $_FILES['image_file']['tmp_name'];
      $error = $_FILES['image_file']['error'];

      if($error === 0) {
          if ($img_size > 1000000) {
              $erros[] = 'A imagem não pode ter mais do que 1mb';
          } else {
              $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
              $img_ex_lc = strtolower($img_ex);

              $allowed_exs = array("jpg", "jpeg", "png");

              if (in_array($img_ex_lc, $allowed_exs)) {
                  $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                  $img_upload_path = 'uploads/'.$new_img_name;
                  $img_path = $img_upload_path;
                  $img_ready = true;
              } else {
                  $erros[] = 'Formato inválido';
              }
          }
      }

      if(empty($erros)){
        $statement = $pdo->prepare("INSERT INTO apontamento (id_email, id_tipoApontamento, descricao, informacao, data_criacao, image_path) 
        VALUES (:id_email,:id_tipoApontamento,:descricao,:informacao,:data_criacao,:image_path)");

        $statement->bindValue(':id_email', $_SESSION['id_email']);
        $statement->bindValue(':id_tipoApontamento', $id_tipoApontamento);
        $statement->bindValue(':descricao', $descricao);
        $statement->bindValue(':informacao', $informacao);
        if(!empty($dataCriacao)){
            $input_date=$_POST['data'];
            $date=date("Y-m-d H:i:s",strtotime($dataCriacao));
            $statement->bindValue(':data_criacao', $dataCriacao);
        } else {
            $statement->bindValue(':data_criacao', time());
        }
        $statement->bindValue(':image_path', $img_path);

        if($img_ready) {
            move_uploaded_file($tmp_name, $img_path);
        }
        $statement->execute();
        header('location: apontamentos.php');
       }
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
                        <form action="create.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <label for="">Tipo</label>
                            <br>
                            <?php if(!empty($tipos)){ ?>
                                <select style="width: 80%" name="tipo">
                                    <?php foreach($tipos as $tipo) { ?>
                                        <option value="<?php echo $tipo['id_tipoApontamento'] ?>"><?php echo $tipo['descricao']?></option>
                                    <?php } ?>
                                </select>
                            <?php } else
                                echo 'Recarregue a página';
                            ?>
                        </div>
                        <div>
                            <label for="">Descrição</label>
                            <br>
                            <input style="width: 80%" type="text" name="descricao" id="txt" placeholder="Descrição" value="<?php echo $descricao ?>" required>
                        </div>
                        <div>
                            <label for="">Informação</label>
                            <br>
                            <input style="width: 80%" type="text" name="informacao" id="txt" placeholder="Informação" value="<?php echo $informacao ?>" required>
                        </div>
                        <div>
                            <label for="">Data</label>
                            <br>
                            <input style="width: 80%" type="date" name="data" id="txt" value="<?php if(empty($dataCriacao)) echo (date('Y-m-d')); else echo($dataCriacao);  ?>" required>
                        </div>
                        <div>
                            <label for="">Imagem</label>
                            <br>
                            <input style="width: 80%" type="file" name="image_file" id="txt">
                        </div>
                        <button style="width: 80%" type="submit" class="createButton">Criar</button>
                        </form>
                        <?php if ($erros): foreach($erros as $err) { ?>
                        <div class="error">
                            <div><?php echo $err ?></div>
                        </div>
                        <?php } endif ?>
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