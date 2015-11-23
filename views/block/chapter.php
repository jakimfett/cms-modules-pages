<div class="single-chapter-container">
    <div class="text-container">
        <h2><?= $title; ?></h2>
        <img class="single-chapter-image" src="/<?= $image; ?>"/>

        <p>
            <?php if (isset($teaser)) : ?>
                <?= $teaser; ?>
            <?php elseif (isset($text)) : ?>
                <?= $text; ?>
            <?php endif; ?>
        </p>
    </div>
    <div class="clear"></div>
</div>