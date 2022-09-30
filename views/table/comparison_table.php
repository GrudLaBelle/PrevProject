<!-- comparison table view -->

<table>
    <thead>
        <tr>
            <th colspan="3">Votre comparatif</th>
        </tr>
        <tr class="color_row">
            <th>Détails des informations</th>
            <th>Votre entreprise</th>
            <th>Données nationales</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td data-value="ape_code">
                <label for="ape_code">Code APE</label>
            </td>
            <td colspan="2"><?= $params['national_stat']->ape_code ?></td>
        </tr>
        <tr class="color_row">
            <td data-value="ape_name">
                <label for="ape_name">Intitulé Code APE</label>
            </td>
            <td colspan="2"><?= $params['national_stat']->ape_name ?></td>
        </tr>
        <tr>
            <td data-value="workers_number">
                <label for="workers_number">Nombre de salariés</label>
            </td>
            <td><?= $params['enterprise_stat']->workers_number ?></td>
            <td><?= $params['national_stat']->workers_number ?></td>
        </tr>
        <tr class="color_row">
            <td data-value="accidents_number">
                <label for="accidents_number">Nombre d'accidents du travail</label>
            </td>
            <td><?= $params['enterprise_stat']->accidents_number ?></td>
            <td><?= $params['national_stat']->accidents_number ?></td>
        </tr>
        <tr>
            <td data-value="index_of_frequency">
                <label for="index_of_frequency">Indice de fréquence</label>
            </td>
            <td><?= $params['enterprise_stat']->index_of_frequency ?></td>
            <td><?= $params['national_stat']->index_of_frequency ?></td>
        </tr>
        <tr>
            <td data-value="year">
                <label for="year">Année</label>
            </td>
            <td><?= $params['enterprise_stat']->year ?></td>
            <td><?= $params['national_stat']->year ?></td>
        </tr>
         <?php foreach ($params['detail_stat'] as $k => $detail_stat) : ?>
        <tr>
            <td colspan="3"><?= $k ?></td>
        </tr> 
            <?php foreach ($detail_stat as $detail_stats_type) : ?>
                <tr class="color_row">
                    <td data-value="<?= $detail_stats_type['id'] ?>">
                        <label for="<?= $detail_stats_type['id']?>"><?= $detail_stats_type['name'] ?></label>
                    </td>
                    <td><?= $detail_stats_type['numberE'] ?></td>
                    <td><?= $detail_stats_type['numberN'] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endforeach ?>
    </tbody>
</table>