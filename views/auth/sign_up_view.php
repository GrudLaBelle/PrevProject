<!-- sign up view -->

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

<?php endif ?>

<?php session_destroy(); ?>


<section class="session">
    <label for="session">Formulaire d'inscription</label>
    <form action="/PrevProject/sign_up/post" method="POST" id="session" name="UserForm" class="form">
        <article class="article_session">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email"/> 
        </article>
        <article class="article_session">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Saisir un mot de passe"/>
            <p>8 à 15 caractères comprenant au moins une minuscule, une majuscule, un chiffre et un caractère spécial</p>
        </article>
        <article>
            Une fois votre compte enregistré, vous devrez vous connecter pour démarrer votre session. 
        </article>
        <?php if (isset($params['info'])) : ?>
            <article class="info">
                <?= $params['info'] ?>
            </article>
        <?php endif ?>
    </form>
</section> 
<section id="session_button">
    <button type="submit" form="session" class="button">Enregistrez</button>
    <button type="reset" form="session" class="button">Réinitialisez</button>
</section>