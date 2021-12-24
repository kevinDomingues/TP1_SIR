<?php 
require_once './components/header.php';
require_once './components/nav.php';

session_start();

if (empty($_SESSION['id_email'])) {
    header('location: login.php');
}
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
                    <button type="button" class="collapsible">Ordenar</button>
                    <div class="apontamentoscontent">
                        <ul class="no-bullets">
                            <li><a href="">Por nome</a></li>
                            <li><a href="">Por tipo</a></li>
                            <li><a href="">Por data</a></li>
                        </ul>
                    </div>
                    
                    <button type="button" class="collapsible">Mostrar apenas</button>
                    <div class="apontamentoscontent">
                        <ul class="no-bullets">
                            <li><a href="">Aniversários</a></li>
                            <li><a href="">Lembretes</a></li>
                            <li><a href="">Marcos</a></li>
                            <li><a href="">Localizar</a></li>
                            <li><a href="">Outros</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="apontamentoscard apontamentosfeed">
                <div class="apontamentoscardsFeed">
                    <div class="apontamentoscard-header">
                        <img src="./assets/ballons.png" alt="ballons" />
                    </div>
                    <div class="apontamentoscard-body">
                        <span class="apontamentostag apontamentostag-purple">Aniversário</span>
                        <h4>
                            O Kévin faz anos
                        </h4>
                        <p>
                            Aniversário do Kévin dia 15 de Novembro
                        </p>
                        <div class="apontamentosuser">
                            <small>22/12/2021 13:02</small>
                        </div>
                        
                    </div>
                    
                </div>

                <hr>

                <div class="apontamentoscardsFeed">
                    <div class="apontamentoscard-header">
                        <img src="./assets/ballons.png" alt="ballons" />
                    </div>
                    <div class="apontamentoscard-body">
                        <span class="apontamentostag apontamentostag-purple">Aniversário</span>
                        <h4>
                            O Kévin faz anos
                        </h4>
                        <p>
                            Aniversário do Kévin dia 15 de Novembro
                        </p>
                        <div class="apontamentosuser">
                            <small>22/12/2021 13:02</small>
                        </div>
                        
                    </div>
                    
                </div>

                <hr>
                <div class="apontamentoscardsFeed">
                    <div class="apontamentoscard-header">
                        <img src="./assets/ballons.png" alt="ballons" />
                    </div>
                    <div class="apontamentoscard-body">
                        <span class="apontamentostag apontamentostag-purple">Aniversário</span>
                        <h4>
                            O Kévin faz anos
                        </h4>
                        <p>
                            Aniversário do Kévin dia 15 de Novembro
                        </p>
                        <div class="apontamentosuser">
                            <small>22/12/2021 13:02</small>
                        </div>
                        
                    </div>
                    
                </div>

                <hr>
                <div class="apontamentoscardsFeed">
                    <div class="apontamentoscard-header">
                        <img src="./assets/ballons.png" alt="ballons" />
                    </div>
                    <div class="apontamentoscard-body">
                        <span class="apontamentostag apontamentostag-purple">Aniversário</span>
                        <h4>
                            O Kévin faz anos
                        </h4>
                        <p>
                            Aniversário do Kévin dia 15 de Novembro
                        </p>
                        <div class="apontamentosuser">
                            <small>22/12/2021 13:02</small>
                        </div>
                        
                    </div>
                    
                </div>

                <hr>
                <div class="apontamentoscardsFeed">
                    <div class="apontamentoscard-header">
                        <img src="./assets/ballons.png" alt="ballons" />
                    </div>
                    <div class="apontamentoscard-body">
                        <span class="apontamentostag apontamentostag-purple">Aniversário</span>
                        <h4>
                            O Kévin faz anos
                        </h4>
                        <p>
                            Aniversário do Kévin dia 15 de Novembro
                        </p>
                        <div class="apontamentosuser">
                            <small>22/12/2021 13:02</small>
                        </div>
                        
                    </div>
                    
                </div>

                <hr>

            </div>
        </div>
    </div>
    





<?php
require_once './components/scripts.php';
?>

</body>
</html>