<?php 
require_once './database/connection.php';
require_once './components/header.php';
require_once './components/nav.php';

session_start();

if (empty($_SESSION['id_email'])) {
    header('location: login.php');
}

$statement = $pdo->prepare("SELECT id_email, nome, profile_pic FROM utilizador WHERE id_email = :id_email");
$statement->bindValue(':id_email', $_SESSION['id_email']);
$statement->execute();

$utilizador = $statement->fetch(PDO::FETCH_UNIQUE);


$nome = '';
$profile_pic = '';


$img_ready = false;
$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
    $nome = $_POST['nome'];
    $apagar = $_POST['apagar'];

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
                  $img_upload_path = 'perfis/'.$new_img_name;
                  $img_path = $img_upload_path;
                  $img_ready = true;
              } else {
                  $erros[] = 'Formato inválido';
              }
          }
      }

      if(empty($erros)){
        if($apagar == 'true') {
            $img_path = '';
            $img_ready = true;
        }

        if($img_ready) {
            $statement = $pdo->prepare("UPDATE utilizador SET nome = :nome, profile_pic = :profile_pic WHERE id_email = :id_email");
        } else {
            $statement = $pdo->prepare("UPDATE utilizador SET nome = :nome WHERE id_email = :id_email");
        }

        $statement->bindValue(':nome', $nome);
        $statement->bindValue(':id_email', $_SESSION['id_email']);

        if($img_ready) {
            $statement->bindValue(':profile_pic', $img_path);
            move_uploaded_file($tmp_name, $img_path);
        }
        $statement->execute();
        header('location: perfil.php');
        exit;
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
                        <h1>Atualizar Apontamento</h1>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <div>
                            <label for="">Nome</label>
                            <br>
                            <input style="width: 80%" type="text" name="nome" id="txt" placeholder="Descrição" value="<?php echo $utilizador['nome'] ?>" required>
                        </div>
                        <div>
                            <label for="">Foto perfil</label>
                            <br>
                            <input style="width: 80%" type="file" name="image_file" id="txt">
                        </div>
                        <div>
                            <label for="">Apagar foto?</label>
                            <br>
                            <input type="checkbox" id="apagar" name="apagar" value="true">
                        </div>
                        <button style="width: 80%" type="submit" class="createButton">Atualizar</button>
                        </form>
                        <?php if ($erros): foreach($erros as $err) { ?>
                        <div class="error">
                            <div><?php echo $err ?></div>
                        </div>
                        <?php } endif ?>
                        <br>
                        <a class="btn" style="font-size: 16px" href="perfil.php">Voltar</a>
                    </div>                    
                </div>               
            </div>
        </div>
    </div>
</div>
</body>
</html>