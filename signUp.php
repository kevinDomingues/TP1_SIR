<?php require_once './components/header.php' ?>

  <div class="backgroundColor">
    <div class="center-container">  
      <div class="login-container">
            <div class="image">
              <img class="center-container" style="left: 25%; transform: translate(-75%, -50%);" src="./assets/logo_transparent.png" alt="logo">
            </div>
            <div class="content">
                <h1>Criar Conta</h1>
                <div>
                    <label for="">Email</label>
                    <br>
                    <input type="email" name="" id="txt" aria-describedby="helpId" placeholder="example@email.com">
                </div>
                <div>
                    <label for="">Nome Completo</label>
                    <br>
                    <input type="text" name="" id="txt" aria-describedby="helpId" placeholder="Nome completo">
                </div>
                <div>
                    <label for="">Password</label>
                    <br>
                    <input type="password" name="" id="txt" placeholder="Password">
                </div>
                <div>
                    <label for="">Confirmar Password</label>
                    <br>
                    <input type="password" name="" id="txt" placeholder="Password">
                </div>
                <br>
                <button type="button"><a href="signUp.php">Criar Conta</a></button>
                <br>
                <a class="btn" href="login.php">Voltar</a>
            </div>
        </div>
      </div>
    </div>

    
</body>
</html>