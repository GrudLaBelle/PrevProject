<?php if (isset($_SESSION['errors'])): ?>

    <?php foreach($_SESSION['errors'] as $errorsArray): ?>
        <?php foreach($errorsArray as $errors): ?>
            <div class="info">
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
<!-- login view -->

<?php endif ?>

<?php session_destroy(); ?>

<section class="session">
    <label for="session" >Se connecter</label>
    <form action="/PrevProject/login/post" method="post" id="session" name="UserForm" class="form">
        <article class="article_session">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email"/>
        </article>
        <article class="article_session">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Mot de passe"/>
        </article>
        <?php if (isset($params['info'])) : ?>
            <article>
                <?= $params['info'] ?>
            </article>
        <?php endif ?>
</section>
<section id="session_button">
    <button type="submit" form="session" class="button">Connexion</button>
    <p>En cas d'oubli de votre mot de passe, merci d'envoyer un mail à l'administrateur du site: <a href="mailto:ouioui@prevproject.fr" target="_blank">ouioui@prevproject.fr</a></p>
</section>