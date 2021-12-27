<?php 
require_once './database/connection.php';
require_once './components/header.php';
require_once './components/nav.php';

session_start();

if (empty($_SESSION['id_email'])) {
    header('location: login.php');
}

$statement = $pdo->prepare("SELECT * FROM apontamento WHERE id_email = :id_email AND ativo = 1 ORDER BY id DESC");
$statement->bindValue(':id_email', $_SESSION['id_email']);
$statement->execute();

$apontamentos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<body style="background-color:#f7f8fc;">
    

    <div class="bodyapontamentos">

        <div class="apontamentoscontainer">
            <div class="apontamentoscard apontamentosleft-menu">       
                <div class="apontamentoscard-left-menu-header">
                    <div style="padding: 30px; padding-top: 0px">
                        <a class="createButton" href="create.php">Criar</a>
                    </div>
                    <h1 class="titleFiltros">Filtros</h1>
                </div>

                <div class="apontamentoscard-body">
                    <input style="width: 100%; margin: 0;" type="text" id="txt" placeholder="Pesquisar" onkeyup="Pesquisar()"/>
                    <button type="button" class="collapsible">Mostrar apenas</button>
                    <div class="apontamentoscontent">
                        <ul class="no-bullets" id="btnContainer">
                            <li><button onclick="filterSelection('1')">Aniversários</button></li>
                            <li><button onclick="filterSelection('2')">Lembretes</button></li>
                            <li><button onclick="filterSelection('3')">Objetos</button></li>
                            <li><button onclick="filterSelection('4')">Marcos</button></li>                           
                            <li><button onclick="filterSelection('5')">Livros</button></li>
                            <li><button onclick="filterSelection('6')">Documentos</button></li>
                            <li><button onclick="filterSelection('all')">Todos</button></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="procurarAqui" class="apontamentoscard apontamentosfeed">
                <?php if(empty($apontamentos)) { ?>
                    <div class="apontamentoscardsFeed" style="height: 900px">
                    <div class="apontamentoscard-header">
                          
                        
                    </div>
                    <div class="apontamentoscard-body">
                        
                        <span class="apontamentostag apontamentostag-purple">Crie apontamentos</span>
                        <h4>
                            Não existe nenhum apontamento nesta conta
                        </h4>
                        <p>
                            Crie apontamentos para os visualizar aqui
                        </p>
                        <div class="apontamentosuser">
                            
                        </div>
                    </div>
                    <br>
                    
                </div>
                <?php } ?>
                <?php foreach($apontamentos as $apt) { ?>
                <div class="apontamentoscardsFeed <?php echo $apt['id_tipoApontamento'] ?>">
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
                            case 3:
                                $span = 'Objeto';
                                $color = 'yellow';
                                break;
                            case 4:
                                $span = 'Marco';
                                $color = 'green';
                                break;
                            case 5:
                                $span = 'Livro';
                                $color = 'orange';
                                break;
                            case 6:
                                $span = 'Documento';
                                $color = 'grey';
                                break;
                        }
                        ?>
                    <p style="display: none"><?php echo $apt['descricao']; echo $apt['informacao']; echo $span ?></p>
                    <div class="apontamentoscard-header">
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
                                case 5:
                                    echo '<img src="./assets/books.png" alt="Livro" />';
                                    break;
                                case 6:
                                    echo '<img src="./assets/file.png" alt="Documento" />';
                                    break;
                            }
                        } else { ?>             
                        <img style="border-radius: 15px" src="<?php echo $apt['image_path'] ?>" alt="<?php echo $apt['descricao'] ?>" />
                       <?php } ?>
                        
                    </div>
                    <div class="apontamentoscard-body">
                        <span class="apontamentostag apontamentostag-<?php echo $color ?>"><?php echo $span ?></span>
                        <h4>
                            <?php echo $apt['descricao'] ?>
                        </h4>
                        <p>
                            <?php echo $apt['informacao'] ?>
                        </p>
                        <div class="apontamentosuser">
                            <small><?php echo $apt['data_criacao'] ?></small>
                        </div>
                        <div class="buttons">
                            <a href="update.php?id=<?php echo $apt['id'] ?>" class="btn-apontamentos"><i class='fa fa-pencil'></i></a>
                            <form action="delete.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $apt['id'] ?>">
                                <button style="border: none" type=submit class="btn-apontamentos"><i class="fa fa-trash red-color"></i></button>
                            </form>
                        </div>
                    </div>
                    <br>
                    
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    





<?php
require_once './components/scripts.php';
?>

</body>
</html>