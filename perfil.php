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

$statement = $pdo->prepare("SELECT COUNT(id) FROM apontamento WHERE id_email = :id_email AND ativo = 1");
$statement->bindValue(':id_email', $_SESSION['id_email']);
$statement->execute();

$count = $statement->fetch();

$statement = $pdo->prepare("SELECT COUNT(id) FROM apontamento WHERE id_email = :id_email AND ativo = 0");
$statement->bindValue(':id_email', $_SESSION['id_email']);
$statement->execute();

$count_erased = $statement->fetch();
?>



<body style="background-color:#f7f8fc;">
    <div class="bodyPerfil" >
        <div class="perfil-card">
        
            <div class="perfil-card-header">
                
                <div class="perfil-img">
                <?php if (empty($utilizador['profile_pic'])) : ?>
                        <img src="./assets/blank_user.png" alt="rover" />
                    <?php endif ?>
                </div>
                <div class="perfil-nome"><?php echo $utilizador['nome'] ?></div>
                <div class="perfil-desc"><?php echo $utilizador['id_email'] ?></div>
                <a href="#" class="perfil-contact-btn"><i class='fa fa-pencil'></i></a>
            </div>
            <div class="perfil-card-footer">
                <div class="perfil-numbers">
                    <div class="perfil-item">
                        <span><?php echo $count['COUNT(id)']?></span>
                        Apontamentos
                    </div>
                    <div class="perfil-border"></div>
                    <div class="perfil-item">
                        <span><?php echo $count_erased['COUNT(id)']?></span>
                        Apontamentos apagados
                    </div>
            </div>
        </div>

    </div>
        

    <?php
    require_once './components/scripts.php';
    ?>

</body>
</html>