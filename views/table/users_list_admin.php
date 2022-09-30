<!-- users list admin view -->

<section>
    <?php if (isset($params['info'])) : ?>
        <article>
            <?= $params['info'] ?>
        </article>
    <?php endif ?>
    <table id="table_admin">
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($params['users'] as $user) : ?>
            <tr>
                <td>
                   <?= $user->role_id ?> 
                </td>
                <td>
                   <?= $user->email ?> 
                </td>
                <td>
                    <a 
                        href="/PrevProject/manage_user/update/<?= $user->id ?>" 
                        name="btn"
                        value="update"
                        class="button">
                            Modifiez
                    </a> 
                </td>
                <td>
                    <a 
                        href="/PrevProject/manage_user/delete/<?= $user->id ?>" 
                        name="btn"
                        value="delete"
                        class="button"
                        id="button_delete">
                            Supprimez
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>
