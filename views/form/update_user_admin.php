<!-- update user admin view -->

<section class="session">
    <label for="session">Modification données utilisateur</label>
    <form 
        action="/PrevProject/manage_user/update/post/<?= $params['user']->id ?>" 
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
                <label for="role_id">Rôle</label>
                <input 
                    type="number" 
                    name="role_id" 
                    value="<?= $params['user']->role_id ?>"/> 
            </article>
            <?php if (isset($params['info'])) : ?>
                <article>
                    <?= $params['info'] ?>
                </article>
            <?php endif ?>
    </form>
</section> 
<section id="session_button">
    <button type="submit" form="session" class="button">Modifiez</button>
    <a href="/PrevProject/userslist/<?= $_SESSION['user_id'] ?>" class="button">Retour</a>
</section>