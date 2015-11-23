<div class="chapter-container">
    <div class="text-container">
        <img class="chapter-image chapter-image-<?= $image_align; ?>" src="/<?= $image; ?>"/>
        <?php if (isset($link)): ?>
            <h2><a href="<?= $link ?>"><?= $title; ?></a></h2>
        <?php else: ?>
            <h2><?= $title; ?></h2>
        <?php endif; ?>
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