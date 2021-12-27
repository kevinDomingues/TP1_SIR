<?php 
  require_once './components/header.php';
  require_once './components/scripts.php';  
?>

<header id="navbar">
  <nav class="navbar-container container">
    <a href="/TP1_SIR" class="home-link">
      <img class="navbar-logo" src="./assets/logo.png">
      221B
    </a>
    <button type="button" id="navbar-toggle" aria-controls="navbar-menu" aria-label="Toggle menu" aria-expanded="false">
      <ul style="position: relative; box-shadow: none" class="navbar-links" id="dropdown">
        <li class="navbar-item"><a class="navbar-link" href="login.php">Entrar</a></li>
      </ul>
    </button>
    <div id="navbar-menu" aria-labelledby="navbar-toggle">
      <ul class="navbar-links" id="dropdown">
        <li class="navbar-item"><a class="navbar-link" href="login.php">Entrar</a></li>
      </ul>
    </div>
  </nav>
</header>

<main class="landing">
  <div class="home-wrap">
    <div class="home-inner">
    </div>
  </div>
</main>

<div class="caption">
  <div class="titulocontainer">
      <h1 class="titulo">Remind Everything</h1>
  </div>
</div>




    
</body>
</html>