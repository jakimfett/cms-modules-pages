<div id="tagline">
    <h1>
        <?php if (isset($pitchtitle)) : ?>
            <?= trim($pitchtitle); ?>
        <?php endif; ?>
    </h1>

    <?php if (isset($pitch)) : ?>
        <?= trim($pitch); ?>
    <?php endif; ?>
</div>
<div id="video-pitch">
    <?php if (isset($video)) : ?>
        <?= trim($video); ?>
    <?php endif; ?>
</div>

<div id="tagline">
    <h1>
        <?php if (isset($followuptitle)) : ?>
            <?= trim($followuptitle); ?>
        <?php endif; ?>
    </h1>
    <?php if (isset($followup)) : ?>
        <?= trim($followup); ?>
    <?php endif; ?>
</div>

<div id="rooms">

    <div>
        <img src="<?= trim($lroom_img); ?>"/>
        <?= trim($lroom); ?>
    </div>
    <div>
        <img src="<?= trim($rroom_img); ?>"/>
        <?= trim($rroom); ?>
    </div>
</div>
<div id="previous-chapters">
    <<<a href="/chapters">Previous Chapters</a>>>
</div>
<div id="blurbs">
    <div id="blurb-left">
        <div class="circle">
            <i class="fa fa-cogs"></i>
        </div>
        <?= trim($blurbleft); ?>
    </div>
    <div id="blurb-center">
        <div class="circle">
            <i class="fa fa-leanpub"></i>
        </div>
        <?= trim($blurbcenter); ?>
    </div>
    <div id="blurb-right">
        <div class="circle">
            <i class="fa fa-key"></i>
        </div>
        <?= trim($blurbright); ?>
    </div>
</div>
<div id="closing">
    <?= $closing; ?>

</div>
<div id="breakline"></div>