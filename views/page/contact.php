<div id="contact-maintext">
    <h1><?= $maintext; ?></h1>
</div>
<div id="contact-profiles">
    <?php foreach ($profiles as $profile) : ?>
        <?= $profile; ?>
    <?php endforeach; ?>
</div>
<div id="contact-address">
    <?= $address; ?>
</div>