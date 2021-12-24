<?php 

require_once './components/header.php';
require_once './database/connection.php';

session_start();

if (!empty($_SESSION['id_email'])) {
  header('location: dashboard.php');
}

$email = '';
$pass = '';

$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  $pass = hash('sha256', $pass);

  $statement = $pdo->prepare("SELECT * FROM utilizador WHERE id_email = :email");
  $statement->bindValue(':email', $email);
  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);

  if($user){
    if($user['password'] === $pass){
      $_SESSION['id_email']  = $user['id_email'];
      header('location: dashboard.php');
    } else {
      $err = 'Credenciais erradas';
    }
  } else {
    $err = 'Utilizador não existe';
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
                <h1>Login</h1>
                <form action="login.php" action="login.php" method="POST">
                  <div>
                      <label for="">Email</label>
                      <br>
                      <input type="email" name="email" id="txt" aria-describedby="helpId" placeholder="example@email.com" required>

                  </div>
                  <div>
                      <label for="">Password</label>
                      <br>
                      <input type="password" name="pass" id="txt" placeholder="Password" required>
                  </div>
                  <a class="fp" href="index.php">Recuperar conta</a>
                  <br>
                  <button type="submit" class="submit">Login</button>
                </form>
                <?php if ($err): ?>
                  <div class="error">
                      <div><?php echo $err ?></div>
                  </div>
                <?php endif ?>
                <br>
                <a class="btn" href="signUp.php">Criar Conta</a>
            </div>
        </div>
      </div>
    </div>

    
</body>
</html>