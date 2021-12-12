<?php 
  require_once './components/header.php';
  require_once './database/connection.php';

  if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header('location: login.php');
  } else {
    $email = $_POST['email'];
  }
  
?>

<header id="navbar">
  <nav class="navbar-container container">
    <a href="/TP1_SIR" class="home-link">
      <img class="navbar-logo" src="./assets/logo.png">
      221B
    </a>
    <div id="navbar-menu" aria-labelledby="navbar-toggle">
      <ul class="navbar-links">
        <li class="navbar-item"><a class="navbar-link" href="/about">Apontamentos</a></li>
     <!--   <li class="navbar-item"><a class="navbar-link" href="/blog">Blog</a></li>
        <li class="navbar-item"><a class="navbar-link" href="/careers">Careers</a></li>  -->
        <li class="navbar-item"><a class="navbar-link" href="/contact">Sair</a></li>
      </ul>
    </div>
  </nav>
</header>
    
</body>
</html>