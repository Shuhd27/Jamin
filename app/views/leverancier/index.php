<h1><?php echo $data['title']; ?></h1>

<?php if ($data['messageVisibility'] == 'flex') : ?>
    <div class="alert alert-<?php echo $data['messageColor']; ?>" style="display: <?php echo $data['messageVisibility']; ?>;">
        <?php echo $data['message']; ?>
    </div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Naam</th>
            <th>Adres</th>
            <th>Contact</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['dataRows'] as $row) : ?>
            <tr>
                <td><?php echo $row->naam; ?></td>
                <td><?php echo $row->adres; ?></td>
                <td><?php echo $row->contact; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php echo $data['pagination']->getLinks(); ?>
