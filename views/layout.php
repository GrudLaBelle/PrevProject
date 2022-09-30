<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PrevProject</title>
        <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'style.css' ?>">
    </head>
    
    <!-- layout view -->
    <body onload="setMobileTable('#table_admin')">
        
        <!-- header -->
        <header>
            <div class="logo">
                <!-- logo -->        
                <a href="/PrevProject/" class="logo">PrevPro</a>
            </div>
            <!-- navigation menu -->
            <nav class="navigation">
                <!-- links -->
                <ul>
                    <li>
                        <a href="/PrevProject/about">A propos</a>
                    </li>
                    <li>
                        <a href="/PrevProject/process">La démarche</a>
                    </li>
                    
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <?php if ($_SESSION['auth'] !== 3) : ?>
                            <li>
                                <a href="/PrevProject/enterprise/<?= $_SESSION['user_id'] ?>">Mon entreprise</a>
                            </li>
                            <li>
                                <a href="/PrevProject/profile/<?= $_SESSION['user_id'] ?>">Mon profil</a>
                            </li>
                        <?php endif ?>
        
                        <?php if ($_SESSION['auth'] == 3) : ?>
                            <li>
                                <a href="/PrevProject/userslist/<?= $_SESSION['user_id'] ?>">Liste utilisateurs</a>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                
                    <?php if (!isset($_SESSION['auth'])) : ?>
                        <li>
                            <a href="/PrevProject/login">Se connecter</a>
                        </li>
                        <li>
                            <a href="/PrevProject/sign_up">S'inscrire</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['auth'])) : ?>
                        <li>
                            <a href="/PrevProject/logout">Se déconnecter</a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
            <div class="toggleBox">
                <!-- menu button -->
                <a onclick="showMenu()">
                    <img src="/PrevProject/public/img/menu-btn.png" alt="button menu" class="menu"></img>
                    <img src="/PrevProject/public/img/close-btn.png" alt="close button menu" class="close"></img>
                </a>
            </div>
        </header>
        
        <!-- main view -->
        <section class="main">
            <?= $content ?>
        </section>
    
        <!-- footer -->
        <?php if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 3) : ?>
        <footer>
                <a href="/PrevProject/legal_notice">Informations légales</a>
                <a href="https://www.ameli.fr/gironde/entreprise/sante-travail/risques" target="_blank">Assurance Maladie - Risques Professionnels</a>
                <a href="https://www.inrs.fr/risques.html" target="_blank">INRS - Risques Professionnels</a>
                <a href="https://travail-emploi.gouv.fr/sante-au-travail/prevention-des-risques-pour-la-sante-au-travail/" target="_blank">Ministère du travail, du plein emploi et de l'insertion</a>
                <a href="https://www.fonction-publique.gouv.fr/la-prevention-des-risques-professionnels" target="_blank">Ministère de la transformation et de la fonction publiques</a>
        </footer>
        <?php endif ?>
        <script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'script.js' ?>" type="text/javascript"></script>
    </body>
</html>