<?php if (isset($chapters)) : ?>
    <div id="chapters-maintext">
        <h1><?= $maintext; ?></h1>
    </div>
    <br/>
    <div id="chapters-profiles">
        <?php foreach ($chapters as $chapter) : ?>
            <?= $chapter; ?>
        <?php endforeach; ?>

        <div id="closing">
            <?= $closing; ?>
        </div>
        <div id="breakline"></div>
    </div>
<?php elseif (isset($chapter)): ?>
    <?= $chapter; ?>
<?php endif; ?>