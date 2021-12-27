<?php 
require_once './components/header.php';
require_once './database/connection.php';

session_start();

$email = '';
$nome = '';
$pass = '';
$pass2 = '';

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
  $email = $_POST['email'];
  $nome = $_POST['nome'];
  $pass = $_POST['pass'];
  $pass2 = $_POST['pass2'];

  $find = $pdo->prepare("SELECT * FROM utilizador WHERE id_email = :email");
  $find->bindValue(':email', $email);
  $find->execute();

  $user = $find->fetch(PDO::FETCH_ASSOC);

  if(!$user) {

    if($pass === $pass2){
      $pass = hash('sha256', $pass);

      $statement = $pdo->prepare("INSERT INTO utilizador (id_email, nome, password, ativo) 
                  VALUES (:email, :nome, :pass, true)");

          $statement->bindValue(':email', $email);
          $statement->bindValue(':nome', $nome);
          $statement->bindValue(':pass', $pass);

          $statement->execute();

          $_SESSION['id_email']  = $email;
          header('location: dashboard.php');

    } else {
      $err = 'Palavra passe diferente!';
    }

  } else {
    $err = 'Utilizador já existe!';
  }
  
}

?>

  <div class="backgroundColor">
    <div class="center-container">  
      <div class="login-container">
            <div class="image">
              <img class="center-container" style="left: 25%; transform: translate(-75%, -50%);" src="./assets/logo_transparent.png" alt="logo">
            </div>
            <div class="content">
                <h1>Criar Conta</h1>
                <form action="signUp.php" method="POST">
                  <div>
                      <label for="">Email</label>
                      <br>
                      <input type="email" name="email" id="txt" aria-describedby="helpId" placeholder="example@email.com" value="<?php echo $email ?>" required>
                  </div>
                  <div>
                      <label for="">Nome Completo</label>
                      <br>
                      <input type="text" name="nome" id="txt" aria-describedby="helpId" placeholder="Nome completo" value="<?php echo $nome ?>" required>
                  </div>
                  <div>
                      <label for="">Password</label>
                      <br>
                      <input type="password" name="pass" id="txt" placeholder="Password" required>
                  </div>
                  <div>
                      <label for="">Confirmar Password</label>
                      <br>
                      <input type="password" name="pass2" id="txt" placeholder="Password" required>
                      <?php if ($err): ?>
                      <div class="error">
                          <div><?php echo $err ?></div>
                      </div>
                      <?php endif ?>
                  </div>
                  <br>
                  <button type="submit" class="submit">Criar Conta</button>
                </form>
                <br>
                <a class="btn" href="login.php">Voltar</a>
            </div>
        </div>
      </div>
    </div>

    
</body>
</html>