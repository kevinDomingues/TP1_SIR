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

$statement = $pdo->prepare("SELECT * FROM apontamento WHERE id_email = :id_email AND id_tipoApontamento IN (1,2)");
$statement->bindValue(':id_email', $_SESSION['id_email']);
$statement->execute();

$apontamentos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<body style="background-color:#f7f8fc;">
    
    <div class="bodydashboard">

        <div class="dashboardcontainer">
            <div class="dashboardcard left-menu">
                <div class="dashboardcard-left-menu-header">
                    <?php if (empty($utilizador['profile_pic'])) : ?>
                        <img src="./assets/blank_user.png" alt="rover" />
                    <?php endif ?>
                    <h1><?php echo $utilizador['nome'] ?> </h1>
                    <h6><?php echo $utilizador['id_email'] ?></h6>
                </div>

                <div class="dashboardcard-body">
                    <p><h4>Próximo apontamento a expirar:</h4>Aniversário do Kévin</p>
                    <p><h4>Último apontamento registado:</h4>Aniversário do Kévin</p>
                </div>
            </div>

            <div class="dashboardcard feed">
            <?php foreach($apontamentos as $apt) { ?>
                <div class="cardsFeed">
                    <div class="dashboardcard-header">
                    <?php if(empty($apt['image_path'])) {
                            switch ($apt['id_tipoApontamento']) {
                                case 1:
                                    echo '<img src="./assets/ballons.png" alt="Aniversário" />';
                                    break;
                                case 2:
                                    echo '<img src="./assets/reminder.png" alt="Lembrete" />';
                                    break;
                                case 3:
                                    echo '<img src="./assets/object.png" alt="Objeto" />';
                                    break;
                                case 4:
                                    echo '<img src="./assets/marco.png" alt="Marco" />';
                                    break;
                            }
                        } else { ?>             
                        <img src="<?php echo $apt['image_path'] ?>" alt="<?php echo $apt['descricao'] ?>" />
                       <?php } ?>
                    </div>
                    <div class="dashboardcard-body">
                    <?php 
                        $span = '';
                        $color = '';
                        
                        switch($apt['id_tipoApontamento']) {
                            case 1:
                                $span = 'Aniversário';
                                $color = 'purple';
                                break;
                            case 2:
                                $span = 'Lembrete';
                                $color = 'blue';
                                break;
                            }
                        ?>
                        <span class="dashboardtag dashboardtag-<?php echo $color ?>"><?php echo $span ?></span>
                        <h4>
                            <?php echo $apt['descricao'] ?>
                        </h4>
                        <p>
                            <?php echo $apt['informacao'] ?>
                        </p>
                        <div class="dashboarduser">
                        <small><?php echo $apt['data_criacao'] ?></small>
                        </div>
                        
                    </div>
                    
                </div>

                <hr>

                <?php } ?>

            </div>

   
    </div>
</div>

<?php
require_once './components/scripts.php';
?>

</body>
</html>