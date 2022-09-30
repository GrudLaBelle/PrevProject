<!-- user update view -->

<section class="session">
    <label for="session">Modification données utilisateur</label>
    <form 
        action="/PrevProject/profile/update/post/<?= $params['user']->id ?>" 
        method="POST" 
        id="session" 
        name="UpdateUserForm" 
        class="form">
            <article class="article_session">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="<?= $params['user']->email ?>"/> 
            </article>
            <article class="article_session">
                <label for="role_id">Mot de passe</label>
                <input 
                    type="password" 
                    name="password" 
                    value="<?= $params['user']->password ?>"/> 
            </article>
            <?php if (isset($params['info'])) : ?>
                <article>
                    <?= $params['info'] ?>
                </article>
            <?php endif ?>
    </form>
</section> 
<section id="session_button">
    <button  type="submit" form="session" class="button">Modifiez</button>
    <a href="/PrevProject/profile/delete/post/<?= $_SESSION['user_id'] ?>" class="button" id="button_delete">Supprimez</a>
    <article>Supprimer votre compte utilisateur, supprimera également vos données d'entreprise et vous redirigera vers l'accueil du site.</article>
</section>