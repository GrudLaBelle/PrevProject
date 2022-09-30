<!-- enterprise view -->

<h1>Fiche entreprise</h1>
<?php if (isset($params['info'])) : ?>
    <article class="info">
        <?= $params['info'] ?>
    </article>
<?php endif ?>
<form action="/PrevProject/enterprise/post/<?= $params['user']->id ?>" method="POST" name="EnterpriseForm" id="user_enterprise_data" class="form"> 

    <article>
        <label for="enterprise_name">Nom de l'entreprise</label>
        <input 
            type="text" 
            id="enterprise_name" 
            value="<?=  $params['enterprise']->enterprise_name ?? '' ?>" 
            name="enterprise_name">
    </article>
    
    <article>
        <label for="siret">Numéro de SIRET</label>
        <input 
            type="string" 
            id="siret" 
            value="<?= $params['enterprise']->siret ?? '' ?>" 
            name="siret">
    </article>
    
    <article>
        <label for="ape_code">Code APE</label>
        <input 
            type="text" 
            id="ape_code" 
            value="<?= $params['enterprise_stat']->ape_code ?? '' ?>" 
            name="ape_code">
    </article>
    
    <article>
        <label for="ape_name">Intitulé code APE</label>
        <input 
            type="text" 
            id="ape_name" 
            value="<?= $params['enterprise_stat']->ape_name ?? '' ?>" 
            name="ape_name">
    </article>
    
    <article>
        <label for="workers_number">Nombre de salariés</label>
        <input 
            type="text" 
            id="workers_number" 
            value="<?= $params['enterprise_stat']->workers_number ?? '' ?>" 
            name="workers_number">
    </article>
    
    <article>
        <label for="accidents_number">Nombre d'accidents du travail</label>
        <input 
            type="text" 
            id="accidents_number" 
            value="<?= $params['enterprise_stat']->accidents_number ?? '' ?>" 
            name="accidents_number">
    </article>
    
    <article>
        <label for="index_of_frequency">Indice de fréquence</label>
        <input 
            type="text" 
            id="index_of_frequency" 
            value="<?= $params['enterprise_stat']->index_of_frequency ?? '' ?>" 
            name="index_of_frequency">
    </article>
    
    <article>
        <label for="year">Année</label>
        <input 
            type="text" 
            id="year" 
            value="<?= $params['enterprise_stat']->year ?? '' ?>" 
            name="year">
    </article>

    <h3>Nature de la lésion</h3>
         
        <?php foreach ($params['injury_nature_enterprise'] as $injuryNatureEnterprise) : ?>
                <article>
                    <label for="injuryNatureEnterprise_<?= $injuryNatureEnterprise->id ?>">
                        <?= $injuryNatureEnterprise->name ?>
                    </label>
                    <input 
                        type="number" 
                        id="injuryNatureEnterprise_<?= $injuryNatureEnterprise->id  ?>" 
                        name="injuryNatureEnterprise_<?= $injuryNatureEnterprise->id ?>" 
                        value="<?= $injuryNatureEnterprise->number ?>" 
                        min="0">
                </article>
       <?php endforeach ?>

    <h3>Localisation de la lésion</h3>
        
        <?php foreach ($params['injury_location_enterprise'] as $injuryLocationEnterprise) : ?>
            <article>
                <label for="injuryLocationEnterprise_<?= $injuryLocationEnterprise->id ?>">
                    <?= $injuryLocationEnterprise->name ?>
                </label>
                <input 
                    type="number" 
                    id="injuryLocationEnterprise_<?= $injuryLocationEnterprise->id ?>" 
                    name="injuryLocationEnterprise_<?= $injuryLocationEnterprise->id ?>" 
                    value="<?= $injuryLocationEnterprise->number ?>" 
                    min="0">
            </article>
        <?php endforeach ?>
    
    <h3>Nature du risque</h3>
        
        <?php foreach ($params['risk_enterprise'] as $riskEnterprise) : ?>
            <article>
                <label for="riskEnterprise_<?= $riskEnterprise->id ?>">
                    <?= $riskEnterprise->name ?>
                </label>
                <input 
                    type="number" 
                    id="riskEnterprise_<?= $riskEnterprise->id ?>" 
                    name="riskEnterprise_<?= $riskEnterprise->id ?>" 
                    value="<?= $riskEnterprise->number ?>" 
                    min="0">
            </article>
        <?php endforeach ?>


</form>

<section id="user_enterprise_data_button" class="session_button">
    
    <?php if (!isset($params['enterprise'])) : ?>
        <button 
            class="button" 
            type="submit" 
            form="user_enterprise_data" 
            class="bouton"
            name="btn"
            value="create">
                Enregistrez vos données d'entreprise
        </button>
    <?php endif ?>
    
    <?php if (isset($params['enterprise'])) : ?>
        <button 
            class="button" 
            type="submit" 
            form="user_enterprise_data" 
            class="bouton"
            name="btn"
            value="update">
                Modifiez vos données d’entreprise
        </button>
        <button 
            class="button" 
            type="submit" 
            form="user_enterprise_data" 
            class="bouton"
            id="user_enterprise_data_delete"
            name="btn"
            value="delete">
                Réinitialisez vos données d’entreprise
        </button>
        <a href="/PrevProject/compare_table/<?= $_SESSION['user_id'] ?>" class="button">Comparez vos données</a>
        
    <?php endif ?>
</section>